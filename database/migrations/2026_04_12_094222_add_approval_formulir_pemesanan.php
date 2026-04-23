<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('formulir_pesanan', function (Blueprint $table) {
            $table->integer('status_approval')->default(0)->after('id_formulir');

            // Kolom Audit Trail (Timestamp)
            $table->datetime('approved_lead_sales_at')->nullable();
            $table->datetime('approved_admin_acc_at')->nullable();
            $table->datetime('approved_head_acc_at')->nullable();
            $table->datetime('approved_admin_legal_at')->nullable();
            $table->datetime('approved_head_legal_at')->nullable();
            $table->datetime('approved_ceo_at')->nullable();

            // Opsional: Catatan jika ditolak
            $table->text('rejection_note')->nullable();
        });
    }

    public function down()
    {
        Schema::table('formulir_pesanan', function (Blueprint $table) {
            $table->dropColumn([
                'status_approval',
                'approved_lead_sales_at',
                'approved_admin_acc_at',
                'approved_head_acc_at',
                'approved_admin_legal_at',
                'approved_head_legal_at',
                'approved_ceo_at',
                'rejection_note'
            ]);
        });
    }
};