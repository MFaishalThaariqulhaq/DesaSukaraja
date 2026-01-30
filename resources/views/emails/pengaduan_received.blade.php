<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #059669; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .tracking { background-color: #f0fdf4; padding: 15px; border-left: 4px solid #059669; margin: 20px 0; }
        .tracking-number { font-size: 18px; font-weight: bold; color: #059669; }
        .footer { background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #6b7280; border-radius: 0 0 5px 5px; }
        a { color: #059669; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pengaduan Anda Telah Diterima</h2>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $nama }}</strong>,</p>
            
            <p>Terima kasih telah mengirimkan pengaduan Anda kepada Pemerintah Desa Sukaraja. Kami berkomitmen untuk memberikan respons yang cepat dan transparan.</p>
            
            <div class="tracking">
                <p style="margin: 0 0 10px 0; font-size: 12px; color: #6b7280;">Nomor Tracking Pengaduan Anda:</p>
                <div class="tracking-number">{{ $tracking_number }}</div>
            </div>
            
            <p>Gunakan nomor tracking ini untuk memantau status pengaduan Anda. Anda akan menerima notifikasi email setiap kali ada pembaruan status.</p>
            
            <h4 style="color: #059669; margin-top: 30px;">Langkah Selanjutnya:</h4>
            <ol>
                <li>Kami akan meninjau pengaduan Anda</li>
                <li>Tim kami akan menghubungi Anda jika diperlukan informasi tambahan</li>
                <li>Anda akan menerima notifikasi email saat ada perkembangan</li>
            </ol>
            
            <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
                <strong>Pertanyaan?</strong> Hubungi kami di kantor desa atau balas email ini.
            </p>
        </div>
        <div class="footer">
            <p>{{ config('app.name') }} &copy; {{ date('Y') }} | Pemerintah Desa Sukaraja</p>
        </div>
    </div>
</body>
</html>
