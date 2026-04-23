<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fp;
    public $level;

    public function __construct($fp, $level)
    {
        $this->fp = $fp;
        $this->level = $level;
    }

    public function build()
    {
        return $this->subject('Pending Approval - Surat Pemesanan Rumah')
            ->view('mail.pending_approval');
    }
}