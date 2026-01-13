<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Analytics;
class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $visitorsAndPageViews       = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $totalVisitorsAndPageViews  = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $mostVisitedPages           = Analytics::fetchMostVisitedPages(Period::days(7));
        $topReferrers               = Analytics::fetchTopReferrers(Period::days(7));
        $userTypes                  = Analytics::fetchUserTypes(Period::days(7));
        $topBrowsers                = Analytics::fetchTopBrowsers(Period::days(7));
        
        return view('pageAnalytic', compact('visitorsAndPageViews', 'totalVisitorsAndPageViews', 'mostVisitedPages', 'topReferrers', 'userTypes', 'topBrowsers'));
    }
}