<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use App\Models\Job;
use App\Models\Projek;
use App\Models\UserAdmin;
use App\Models\UserMenu;
use App\Models\UserNotif;
use App\Models\UserProjek;
use App\Models\Rumah;
use App\Models\Subkon;
use App\Models\JobList;
use App\Models\Checklist;

class C_Checklist extends Controller
{
    public $userAdmin;
    public $userNotif;
    public $userProjek;
    public $rumah;
    public $projek;
    public $userMenu;
    public $job;
    public $checklist;
    public $subkon;
    public $joblist;
    public function __construct()
    {
        $this->job = new Job();
        $this->userAdmin = new UserAdmin();
        $this->userNotif = new UserNotif();
        $this->userProjek = new UserProjek();
        $this->projek = new Projek();
        $this->userMenu = new UserMenu();
        $this->rumah = new Rumah();
        $this->subkon = new Subkon();
        $this->joblist = new JobList();
        $this->checklist = new Checklist();
    }

    public function getChecklist($projek)
    {

        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);
        //
        $getJob = $this->job->getJobWhereGroupBy(
            '*',
            ['id_projek' => $getProjek->id_projek],
            'termin_job',
            'termin_job',
            'asc'
        )->collect();

        
        // $getJob = $getJob->where('id_projek',$getProjek->id_projek)->groupBy('termin_job')->sortBy('termin_job');
        if (session()->has('user')) {

            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;

            $getChecklist = "";

            if ($user->kategori == "Pengawas") {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("SUM(a.subbobot) as percentase,  a.*, r.*, jl.*, sub.*, clus.*,
        IF(a.id_pengawas1 IS NULL,'N/A',c.nama_ua) as pengawas1,
        IF(a.id_pengawas2 IS NULL,'N/A',b.nama_ua) as pengawas2")
                    ->where([
                        ['r.id_projek', '=', $getProjek->id_projek],

                        ['a.id_pengawas1', '=', $user->id_user_admin],

                    ])
                    ->orWhere(
                        [
                            ['r.id_projek', '=', $getProjek->id_projek],
                            ['a.id_pengawas2', '=', $user->id_user_admin],
                        ]
                    ) // Add this condition
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')

                    ->orderByRaw('jl.termin_jl AND a.id_checklist DESC')
                    ->groupBy('r.id_rumah')
                    ->get();
                
            } else {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("SUM(subbobot) as percentase,  a.*, r.*, jl.*, sub.*, clus.*,
                        IF(a.id_pengawas1 IS NULL,'N/A',c.nama_ua) as pengawas1,
                        IF(a.id_pengawas2 IS NULL,'N/A',b.nama_ua) as pengawas2")
                    ->where([
                        'r.id_projek' => $getProjek->id_projek,
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')

                    ->orderByRaw('jl.termin_jl AND a.id_checklist DESC')
                    ->groupBy('r.id_rumah')
                    ->get();
            }

            $getRumah = $this->rumah->getRumahProjekWhereAll('status', '=', 'Sold');
            $getSubkon = $this->subkon->getSubkon();
            $getPengawas = $this->userAdmin->getUserAdminWhere('*', ['ktgr_admin.kategori' => "Pengawas"]);

            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }
            if (!$foundMatchingMenu) {
                return redirect('/login')->with('danger', 'anda tidak dapat mengakses halaman ini');
            }

            return view(
                'V_Admin.checklist',
                compact(
                    'user',
                    'projekUser',
                    'getJob',
                    'getProjek',
                    'getUserMenu',
                    'getChecklist',
                    'getRumah',
                    'getSubkon',
                    'getPengawas',
                )
            );
        } else {
            return redirect('/login');
        }
    }

    function addChecklistAction(Request $request, $projek)
    {
        $getChecklist = $this->checklist->getChecklistWhere(['checklist.id_rumah' => $request->rumah]);
        
        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);
        
        if ($getChecklist->isEmpty()) {
            // $getChecklist is empty
        } else {
            return redirect()->back()->with('error', 'Checklist sudah ada!');
        }
        $getJoblist = $this->joblist->getJoblistWhere([
            'joblist.lantai_jl' => $request->lantai,
            'joblist.status_jl' => "Aktif"
        ]);
        $nextMonth = "";
        if ($request->lantai == 1) {
            $nextMonth = date("Y-m-d", strtotime("+1 month"));
        }
        if ($request->lantai == 2) {
            $nextMonth = date("Y-m-d", strtotime("+2 month"));
        }
        $dataInput = [];
        foreach ($getJoblist as $joblist) {
            $data = [
                'id_rumah' => $request->rumah,
                'id_subkon' => $request->subkon,
                'id_joblist' => $joblist->id_joblist,
                'id_pengawas1' => $request->pengawas1,
                'id_pengawas2' => $request->pengawas2,
                'tgl_deadline' => $nextMonth,
                'status_checklist' => ($joblist->termin_jl == 1) ? "progress" : "terkunci"
            ];

            // Push $data into $dataInput array
            $dataInput[] = $data;
        }

        $this->checklist->insertChecklist($dataInput);
        return redirect()->back()->with('success', 'Checklist berhasil ditambahkan!');
    }

     public function nextTermin($projek, $id_rumah)
    {
        $decryptedID = Crypt::decrypt($id_rumah);

        $lantai = DB::table('checklist')
            ->join('joblist', 'checklist.id_joblist', 'joblist.id_joblist')
            ->join('job', 'job.id_job', 'joblist.id_job')
            ->where([
                'checklist.id_rumah' => $decryptedID,
                'checklist.status_checklist' => "selesai"
            ])
            ->orderByDesc('id_checklist')
            ->first();
        if (!$lantai) {
            return redirect()->back()->with('error', 'Termin sebelumnya belum selesai!');
        }
        $setTermin = $lantai->termin_job + 1;
        if ($lantai->termin_job == 5) {
            return redirect()->back()->with('error', 'Termin sudah selesai!');
        }

        $monthsToAdd = $lantai->lantai_jl == 1 ? 1 : 2;
        $nextMonth = date("Y-m-d", strtotime("+{$monthsToAdd} month"));

        // 1. Find checklist IDs & joblist IDs that match the criteria
        $records = DB::table('checklist')
            ->join('joblist', 'checklist.id_joblist', '=', 'joblist.id_joblist')
            ->join('job', 'job.id_job', 'joblist.id_job')
            ->where('checklist.id_rumah', $decryptedID)
            ->where('job.termin_job', $setTermin)
            ->where('checklist.status_checklist', 'terkunci')
            ->select('checklist.id_checklist', 'joblist.id_joblist')
            ->get();

        $checklistIds = $records->pluck('id_checklist');
        // $joblistIds = $records->pluck('id_joblist');

        // 2. Update checklist table
        if ($checklistIds->isNotEmpty()) {
            DB::table('checklist')
                ->whereIn('id_checklist', $checklistIds)
                ->update([
                    'status_checklist' => 'progress',
                    'tgl_deadline' => $nextMonth
                ]);
        }
        // 3. Increment termin_jl in joblist table
        // if ($joblistIds->isNotEmpty()) {
        //     DB::table('joblist')
        //         ->whereIn('id_joblist', $joblistIds)
        //         ->increment('termin_jl', 1);
        // }
        return redirect()->back()->with('success', 'Termin sudah menjadi termin ' . $setTermin);
    }
    public function customTermin(Request $request, $projek, $id_rumah)
    {
        $decryptedID = Crypt::decrypt($id_rumah);
        $lantai = DB::table('checklist')
            ->join('joblist', 'checklist.id_joblist', 'joblist.id_joblist')
            ->where([
                'checklist.id_rumah' => $decryptedID,
                'checklist.status_checklist' => "selesai"
            ])
            ->orderByDesc('id_checklist')
            ->first();

        $setTermin = $lantai->termin_jl + 1;
        if ($lantai->termin_jl == 5) {
            return redirect()->back()->with('error', 'Termin sudah selesai!');
        }



        if ($lantai->lantai_jl == 1) {
            DB::table('checklist')
                ->join('joblist', 'checklist.id_joblist', 'joblist.id_joblist')
                ->where([
                    'checklist.id_rumah' => $decryptedID,
                    'joblist.termin_jl' =>  $setTermin,
                    'checklist.status_checklist' => "terkunci"
                ])
                ->update([
                    'checklist.status_checklist' => "progress",
                    'checklist.tgl_deadline' => $request->tanggalTermin,
                ]);
        }
        if ($lantai->lantai_jl == 2) {
            $nextMonth = date("Y-m-d", strtotime("+2 month"));
            DB::table('checklist')
                ->join('joblist', 'checklist.id_joblist', 'joblist.id_joblist')
                ->where([
                    'checklist.id_rumah' => $decryptedID,
                    'joblist.termin_jl' =>  $setTermin,
                    'checklist.status_checklist' => "terkunci"
                ])
                ->update([
                    'checklist.status_checklist' => "progress",
                    'checklist.tgl_deadline' => $request->tanggalTermin,
                ]);
        }


        return redirect()->back()->with('success', 'Termin sudah menjadi termin ' . $setTermin);
    }

    public function getTerminChecklist($projek, $id_rumah)
    {
        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);


        $decryptedID = Crypt::decrypt($id_rumah);
        $getRumah = $this->rumah->firstRumahWhereJoinCluster('*', 'rumah.id_rumah', '=', $decryptedID);

        if (session()->has('user')) {
            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;


            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }
            $getChecklist = "";

            if ($user->kategori == "Pengawas") {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("SUM(subbobot) as percentase,  a.*, r.*, jl.*, sub.*, clus.*, j.*,
                    IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
                    IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
                    ->where([
                        ['a.id_rumah', '=', $decryptedID],
                        ['a.id_pengawas1', '=', $user->id_user_admin],
                    ])
                    ->orWhere([
                        ['a.id_rumah', '=', $decryptedID],
                        ['a.id_pengawas2', '=', $user->id_user_admin],
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')
                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->groupBy('j.termin_job')
                    ->orderByRaw('jl.sort_jl ASC')
                    ->get();
                $getCountChecklist = DB::table('checklist as a')
                    ->selectRaw("  a.*, r.*, jl.*, sub.*, clus.*, j.*,
                        COUNT(a.status_cek_pengawas1) as countCekPengawas1,
                        COUNT(a.status_cek_pengawas2) as countCekPengawas2,
                        SUM(CASE WHEN a.status_cek_pengawas1 = 'selesai' THEN 1 ELSE 0 END) as countSelesaiPengawas1,
                        SUM(CASE WHEN a.status_cek_pengawas2 = 'selesai' THEN 1 ELSE 0 END) as countSelesaiPengawas2
                        ")
                    ->where([
                        ['a.id_rumah', '=', $decryptedID],
                        ['a.id_pengawas1', '=', $user->id_user_admin],
                    ])
                    ->orWhere([
                        ['a.id_rumah', '=', $decryptedID],
                        ['a.id_pengawas2', '=', $user->id_user_admin],
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')
                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->groupBy('j.termin_job')
                    ->orderByRaw('jl.sort_jl ASC')
                    ->get();
            } else {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("SUM(subbobot) as percentase,  a.*, r.*, jl.*, sub.*, clus.*, j.*,
                    IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
                    IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
                    ->where([
                        'r.id_projek' => $getProjek->id_projek,
                        'r.id_rumah' => $decryptedID
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')
                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->groupBy('j.termin_job')
                    ->orderByRaw('j.termin_job ASC')
                    ->get();
                $getCountChecklist = DB::table('checklist as a')
                    ->selectRaw("  a.*, r.*, jl.*, sub.*, clus.*, j.*,
                        COUNT(a.status_cek_pengawas1) as countCekPengawas1,
                        COUNT(a.status_cek_pengawas2) as countCekPengawas2,
                        SUM(CASE WHEN a.status_cek_pengawas1 = 'selesai' THEN 1 ELSE 0 END) as countSelesaiPengawas1,
                        SUM(CASE WHEN a.status_cek_pengawas2 = 'selesai' THEN 1 ELSE 0 END) as countSelesaiPengawas2
                        ")
                    ->where([
                        'r.id_projek' => $getProjek->id_projek,
                        'r.id_rumah' => $decryptedID
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
                    ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
                    ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
                    ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')
                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->groupBy('j.termin_job')
                    ->orderByRaw('j.termin_job ASC')
                    ->get();
            }


            return view(
                'V_Admin.terminChecklist',
                compact(
                    'user',
                    'projekUser',
                    'getRumah',
                    'getProjek',
                    'getUserMenu',
                    'getChecklist',
                    'getCountChecklist'

                )
            );
        } else {
            return redirect('/login');
        }
    }

    public function printChecklist($projek, $id_rumah)
    {
        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);

        $decryptedID = Crypt::decrypt($id_rumah);
        $getRumah = $this->rumah->getRumahWhere('id_rumah', '=', $decryptedID);
        $getChecklist = $this->checklist->getChecklistJoinJoblistJob(['checklist.id_rumah' => $decryptedID])->collect();
        $getTermin = $getChecklist->groupBy('termin_job');
        $getLantai = $getChecklist->pluck('lantai_jl')->first();
        // $getJob = $getTermin->groupBy('id_job');

        $getPengawas = DB::table('checklist as a')
            ->selectRaw("SUM(subbobot) as percentase,  a.*, r.*, jl.*, sub.*, clus.*, j.*,
        IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
        IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
            ->where([
                'r.id_projek' => $getProjek->id_projek,
                'r.id_rumah' => $decryptedID
            ])
            ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
            ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
            ->leftJoin('rumah as r', 'r.id_rumah', '=', 'a.id_rumah')
            ->leftJoin('cluster as clus', 'r.codecluster', 'clus.codecluster')
            ->leftJoin('joblist as jl', 'jl.id_joblist', '=', 'a.id_joblist')
            ->leftJoin('subkon as sub', 'sub.id_subkon', '=', 'a.id_subkon')
            ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
            ->groupBy('j.termin_job')
            ->orderByRaw('j.termin_job ASC')
            ->get();
        $getSPK = DB::table('spk')
            ->where('id_rumah', '=', $decryptedID)
            ->first();

        $getJob = $this->job->getJob('*');

        if (session()->has('user')) {
            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;


            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }



            return view(
                'V_Admin.printChecklist',
                compact(
                    'user',
                    'projekUser',
                    'getProjek',
                    'getUserMenu',
                    'getChecklist',
                    'getTermin',
                    'getRumah',
                    'getJob',
                    'getLantai',
                    'getPengawas',
                    'getSPK',
                )
            );
        } else {
            return redirect('/login');
        }
    }

    public function getListChecklist($projek, $id_rumah, $termin)
    {
        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);


        $decryptedID = Crypt::decrypt($id_rumah);
        
        $decryptedTermin = Crypt::decrypt($termin);
        $getRumah = $this->rumah->firstRumahWhereJoinCluster('*', 'rumah.id_rumah', '=', $decryptedID);

        if (session()->has('user')) {
            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;


            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }

            $getChecklist = "";
            if ($user->kategori == "Pengawas") {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("a.*, jl.*, j.*,IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
                    IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
                    ->where([
                        ['a.id_rumah', '=', $decryptedID],
                        ['j.termin_job', '=', $decryptedTermin],
                        ['a.id_pengawas1', '=', $user->id_user_admin],
                    ])
                    ->orWhere([
                        ['a.id_rumah', '=', $decryptedID],
                        ['j.termin_job', '=', $decryptedTermin],
                        ['a.id_pengawas2', '=', $user->id_user_admin],
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->Join('joblist as jl', 'a.id_joblist', '=', 'jl.id_joblist')
                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->orderByRaw('jl.sort_jl ASC')
                    ->get();
                
            } else {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("a.*, jl.*, j.*,IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
                    IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
                    ->where([
                        'a.id_rumah'   => $decryptedID,
                        'j.termin_job' => $decryptedTermin,
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->Join('joblist as jl', 'a.id_joblist', '=', 'jl.id_joblist')

                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')

                    ->orderByRaw('jl.sort_jl ASC')
                    ->get();
                
            }

            return view(
                'V_Admin.listChecklist',
                compact(
                    'user',
                    'projekUser',
                    'getRumah',
                    'getProjek',
                    'getUserMenu',
                    'getChecklist'

                )
            );
        } else {
            return redirect('/login');
        }
    }

    function editChecklist($projek, $id_rumah, $termin, $id_checklist)
    {
        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);


        $decryptedID = Crypt::decrypt($id_rumah);
        $decryptedTermin = Crypt::decrypt($termin);
        $decryptedIdChecklist = Crypt::decrypt($id_checklist);

        $getRumah = $this->rumah->firstRumahWhereJoinCluster('*', 'rumah.id_rumah', '=', $decryptedID);

        if (session()->has('user')) {
            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;


            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }

            $getChecklist = "";
            if ($user->kategori == "Pengawas") {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("a.*, jl.*, j.*, IF(a.id_pengawas1 IS NULL,'N/A',b.nama_ua) as pengawas1,
                    IF(a.id_pengawas2 IS NULL,'N/A',c.nama_ua) as pengawas2")
                    ->where([
                        ['a.id_rumah', '=', $decryptedID],
                        ['j.termin_job', '=', $decryptedTermin],
                        ['a.id_pengawas1', '=', $user->id_user_admin],
                        ['a.id_checklist', '=', $decryptedIdChecklist]
                    ])
                    ->orWhere([
                        ['a.id_rumah', '=', $decryptedID],
                        ['j.termin_job', '=', $decryptedTermin],
                        ['a.id_pengawas2', '=', $user->id_user_admin],
                        ['a.id_checklist', '=', $decryptedIdChecklist]
                    ])
                    ->leftJoin('user_admin as b', 'b.id_user_admin', '=', 'a.id_pengawas1')
                    ->leftJoin('user_admin as c', 'c.id_user_admin', '=', 'a.id_pengawas2')
                    ->Join('joblist as jl', 'a.id_joblist', '=', 'jl.id_joblist')

                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->first();
                
            } else {
                $getChecklist = DB::table('checklist as a')
                    ->selectRaw("a.*, jl.*, j.*")
                    ->where([
                        'a.id_rumah'        => $decryptedID,
                        'j.termin_job'      => $decryptedTermin,
                        'a.id_checklist'    => $decryptedIdChecklist,
                    ])

                    ->Join('joblist as jl', 'a.id_joblist', '=', 'jl.id_joblist')

                    ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
                    ->first();
            }
            

            return view(
                'V_Admin.editChecklist',
                compact(
                    'user',
                    'projekUser',
                    'getRumah',
                    'getProjek',
                    'getUserMenu',
                    'getChecklist'

                )
            );
        } else {
            return redirect('/login');
        }
    }

    function editChecklistAction(Request $request, $projek, $id_rumah, $termin, $id_checklist)
    {
        // Prevent direct URL open on action endpoint (GET) and send user back to edit form.
        if ($request->isMethod('get')) {
            return redirect()->route('editChecklist.admin', [$projek, $id_rumah, $termin, $id_checklist])
                ->with('error', 'Aksi ubah checklist harus melalui submit form.');
        }

        $getProjek = $this->projek->firstProjek('*', 'nama_projek', '=', $projek);

        $decryptedID = Crypt::decrypt($id_rumah);
        $decryptedTermin = Crypt::decrypt($termin);
        $decryptedIdChecklist = Crypt::decrypt($id_checklist);

        $getChecklist = DB::table('checklist as a')
            ->selectRaw("a.*, jl.*, j.*")
            ->where([

                'a.id_checklist'    => $decryptedIdChecklist,
            ])
            ->Join('joblist as jl', 'a.id_joblist', '=', 'jl.id_joblist')

            ->Join('job as j', 'jl.id_job', '=', 'j.id_job')
            ->first();

        $getRumah = $this->rumah->firstRumahWhereJoinCluster('*', 'rumah.id_rumah', '=', $decryptedID);
        
        if (session()->has('user')) {
            $user = $this->userAdmin->getUserKategoriWhere('user_admin.id_user_admin', '=', Session::get('user'));

            $projekUser = $this->userProjek->getProjectUserWhere('user_admin.id_user_admin', '=', session::get('user'));
            $getUserMenu = $this->userMenu->getUserMenuWhereArr('*', [
                'user_menu.status_um' => 'aktif',
                'user_menu.id_kategori' => $user->id_kategori
            ])->collect();
            $foundMatchingMenu = false;


            foreach ($getUserMenu as $menu) {
                if ($menu->url_menu == request()->segment(1)) {
                    $foundMatchingMenu = true;
                    break;
                }
            }
            $dataInput = "";
            $foto = $request->file('foto');
            $checklist = $getChecklist->status_checklist;
            if($request->status_cek_pengawas1 === 'selesai' &&  $request->status_cek_pengawas2 === 'selesai') {
                $checklist = 'selesai';
            }
            if (empty($foto)) {
                // Compress the uploaded image
                $dataInput = [
                    'foto'                 => $getChecklist->foto,
                    'status_cek_pengawas1' => $request->status_cek_pengawas1,
                    'status_cek_pengawas2' => $request->status_cek_pengawas2,
                    'status_checklist'     => $checklist,
                    'subbobot'             => $request->bobot,
                    'lat_checklist'        => $request->lat_checklist,
                    'long_checklist'       => $request->long_checklist,
                    'keterangan'           => $request->keterangan,
                    'tgl_update'           =>  date("Y-m-d")
                ];
            } else {
                $compressedImage = Image::make($foto)->encode('jpg', 50); // Adjust the quality as needed

                // Generate a unique filename
                $fileName = uniqid() . '.' . 'jpg'; // You can use any logic to generate a unique filename here

                // Move the compressed image to the public directory
                $compressedImage->save(public_path('Home/images/termin/' . $fileName));
                // Store the compressed image in storage and get its path

                // Get the filename from the $fotoPath

                $dataInput = [
                    'foto' => $fileName,
                    'status_cek_pengawas1' => $request->status_cek_pengawas1,
                    'status_cek_pengawas2' => $request->status_cek_pengawas2,
                    'status_checklist'     => $checklist,
                    'subbobot'             => $request->bobot,
                    'lat_checklist'        => $request->lat_checklist,
                    'long_checklist'       => $request->long_checklist,
                    'keterangan'           => $request->keterangan,
                    'tgl_update'           =>  date("Y-m-d")
                    // 'ada'                   =>"foto",
                ];
                // Update the database record with the new photo path

            }
            if ($request->status_checklist == "selesai") {
                $dataInput = array(
                    'id_pelanggan' => $getChecklist->id_pelanggan,
                    'from_pelanggan_notif' => "Teknik",
                    'icon_pelanggan_notif' => "fa fa-building",
                    'title_pelanggan_notif' => "Pembangunan Rumah " .$getRumah->blok.' - '.$getRumah->nomor,
                    'msg_notif' => "Pekerjaan pembangunan untuk proyek ".$getChecklist->nama_jl." di ".$getRumah->blok.' - '.$getRumah->nomor." telah mencapai Termin ".$getChecklist->termin_jl.". Pengawas proyek kami baru saja mengupdate statusnya. Mohon cek dashboard Anda untuk informasi lebih lanjut.",
                    'tgl_notif' => Carbon::now(), // Set tanggal sekarang
                    'status_notif' => 'unread',
                );

                // Insert ke database menggunakan DB facade
                DB::table('pelanggan_notif')->insert($dataInput);
            }

            // dd($dataInput);
            DB::table('checklist')
                ->where('id_checklist', $decryptedIdChecklist)
                ->update($dataInput);
            return redirect()->route('getListChecklist.admin', [$getProjek->nama_projek, Crypt::encrypt($decryptedID), Crypt::encrypt($decryptedTermin)])->with('success', 'data termin telah diubah!');
        } else {
            return redirect('/login');
        }
    }

    public function EditPengawas(Request $request, $projek, $id_rumah)
    {
        $decryptedID = Crypt::decrypt($id_rumah);
        if (!empty($request)) {
            $dataInput = [

                'id_pengawas1' => $request->pengawas1,
                'id_pengawas2' => $request->pengawas2,
            ];
            DB::table('checklist')
                ->where('id_rumah', $decryptedID)
                ->where('status_checklist', "progress")

                ->orWhere('status_checklist', "terkunci")
                ->update($dataInput);
            return redirect()->back()->with('success', 'Success change pengawas');
        } else {
            return redirect('/login');
        }
    }

    public function checkPinPendamping(Request $request,  $projek, $id_rumah, $termin, $id_checklist)
    {
        $user = $this->userAdmin->firstUserAdminWhere(
            '*',
            [
                'ktgr_admin.kategori' => "Pendamping",
                'user_admin.pin_ua'   => $request->input('pin')
            ]
        );
        // Perform your PIN validation logic here


        // Example validation logic
        if ($user) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
