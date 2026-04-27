<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval - SPR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Logo Section */
        .logo-container {
            text-align: center;
            padding: 24px 0;
            background-color: #ffffff;
        }

        .logo-container img {
            max-height: 50px;
            width: auto;
        }

        .header {
            background-color: #a47449;
            padding: 32px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header p {
            color: #fdf2e9;
            font-size: 12px;
            margin-top: 4px;
            opacity: 0.9;
        }

        .badge {
            display: inline-block;
            background-color: #f59e0b;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 12px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .body {
            padding: 36px 40px;
        }

        .greeting {
            font-size: 15px;
            font-weight: 600;
            color: #a47449;
            margin-bottom: 8px;
        }

        .description {
            color: #555;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #999;
            margin-bottom: 12px;
        }

        .info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 28px;
        }

        .info-row {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 40%;
            padding: 12px 16px;
            background-color: #f1f5f9;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .info-value {
            width: 60%;
            padding: 12px 16px;
            color: #1e293b;
            font-size: 13px;
        }

        .timeline {
            margin-bottom: 28px;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .timeline-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 4px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .dot-done {
            background-color: #22c55e;
        }

        .dot-active {
            background-color: #f59e0b;
        }

        .dot-pending {
            background-color: #cbd5e1;
        }

        .timeline-text {
            font-size: 13px;
            color: #475569;
        }

        .timeline-text.active {
            font-weight: 700;
            color: #a47449;
        }

        .cta {
            text-align: center;
            margin-bottom: 32px;
        }

        .btn {
            display: inline-block;
            background-color: #a47449;
            color: #ffffff;
            text-decoration: none;
            padding: 13px 32px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 0 40px;
        }

        .footer {
            padding: 24px 40px;
            text-align: center;
        }

        .footer p {
            font-size: 11px;
            color: #aaa;
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div class="logo-container">
            <img src="{{ url('/images/logo-forms-living1.png') }}" alt="Company Logo">
        </div>

        <div class="header">
            <h1>Surat Pemesanan Rumah</h1>
            <p>Sistem Manajemen Properti</p>
            <span class="badge">Menunggu Persetujuan</span>
        </div>

        <div class="body">
            <p class="greeting">Yth. Tim {{ $level }},</p>
            <p class="description">
                Terdapat Surat Pemesanan Rumah yang telah disetujui oleh level sebelumnya
                dan kini memerlukan persetujuan dari Anda. Harap segera tindak lanjuti.
            </p>

            <p class="section-title">Detail Pemesanan</p>
            <div class="info-card">
                <div class="info-row">
                    <div class="info-label">No. Formulir</div>
                    <div class="info-value">{{ $fp->no_fp ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Blok / Nomor</div>
                    <div class="info-value">{{ $fp->blok }} / {{ $fp->nomor }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Pelanggan</div>
                    <div class="info-value">{{ $fp->nama_plgn ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status Saat Ini</div>
                    <div class="info-value">Menunggu Approval {{ $level }}</div>
                </div>
            </div>

            <p class="section-title">Alur Persetujuan</p>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot dot-done"></div>
                    <div class="timeline-text">Lead Sales</div>
                </div>

                <div class="timeline-item">
                    <div
                        class="timeline-dot {{ $level === 'Admin Accounting' ? 'dot-active' : ($fp->status_approval >= 2 ? 'dot-done' : 'dot-pending') }}">
                    </div>
                    <div class="timeline-text {{ $level === 'Admin Accounting' ? 'active' : '' }}">Admin Accounting
                    </div>
                </div>

                <div class="timeline-item">
                    <div
                        class="timeline-dot {{ $level === 'Head Accounting' ? 'dot-active' : ($fp->status_approval >= 3 ? 'dot-done' : 'dot-pending') }}">
                    </div>
                    <div class="timeline-text {{ $level === 'Head Accounting' ? 'active' : '' }}">Head Accounting</div>
                </div>

                <div class="timeline-item">
                    <div
                        class="timeline-dot {{ $level === 'Admin Legal' ? 'dot-active' : ($fp->status_approval >= 4 ? 'dot-done' : 'dot-pending') }}">
                    </div>
                    <div class="timeline-text {{ $level === 'Admin Legal' ? 'active' : '' }}">Admin Legal</div>
                </div>

                <div class="timeline-item">
                    <div
                        class="timeline-dot {{ $level === 'Manager Legal' ? 'dot-active' : ($fp->status_approval >= 5 ? 'dot-done' : 'dot-pending') }}">
                    </div>
                    <div class="timeline-text {{ $level === 'Manager Legal' ? 'active' : '' }}">Manager Legal</div>
                </div>

                <div class="timeline-item">
                    <div
                        class="timeline-dot {{ $level === 'CEO' ? 'dot-active' : ($fp->status_approval >= 6 ? 'dot-done' : 'dot-pending') }}">
                    </div>
                    <div class="timeline-text {{ $level === 'CEO' ? 'active' : '' }}">CEO</div>
                </div>
            </div>

            <div class="cta">
                <a href="{{ url('/login') }}" class="btn"
                    style="display: inline-block; background-color: #a47449; color: #ffffff; text-decoration: none; padding: 13px 32px; border-radius: 6px; font-size: 14px; font-weight: 600; letter-spacing: 0.3px;">
                    <span style="color: #ffffff; text-decoration: none;">Buka Sistem & Approve</span>
                </a>
            </div>
        </div>

        <hr class="divider">

        <div class="footer">
            <p>
                Email ini dikirim otomatis oleh sistem.<br>
                Mohon tidak membalas email ini.<br>
                &copy; {{ date('Y') }} Forms Living. All rights reserved.
            </p>
        </div>

    </div>
</body>

</html>