<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            padding: 25px;
            color: #333;
        }

        .card {
            border: 2px solid #4A148C;
            padding: 25px 30px;
            border-radius: 10px;
        }

        .divider {
            border-bottom: 1.8px solid #4A148C;
            margin: 12px 0 18px 0;
        }

        .title {
            text-align: center;
            color: #4A148C;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
            margin-top: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            margin-bottom: 8px;
            color: #4A148C;
        }

        .section-title {
            font-weight: bold;
            color: #4A148C;
            margin-top: 18px;
            margin-bottom: 5px;
            font-size: 15px;
        }

        table td {
            padding: 3px 0;
        }

        .content-divider {
            border-bottom: 1px dashed #B088D9; /* ungu soft */
            margin: 15px 0;
        }
    </style>

</head>

<body>

<div class="card">

    <!-- HEADER -->
    <table width="100%">
        <tr>
            <!-- Logo -->
            <td width="25%" align="left">
                <img src="{{ public_path('logo/logo-politeknik-gorontalo.png') }}" width="90">
            </td>

            <!-- Title -->
            <td width="50%" align="center">
                <div class="title">KARTU REGISTRASI PMB</div>
                <div class="subtitle">Politeknik Gorontalo</div>
            </td>

            <!-- QR -->
            <td width="25%" align="right">
                <img src="{{ $qrBase64 }}" width="90">
            </td>
        </tr>
    </table>

    <!-- Garis pembatas modern -->
    <div class="divider"></div>

    <!-- DATA PENDAFTAR -->
    <div class="section-title">Data Pendaftar</div>

    <table width="100%">
    <tr><td width="35%">Nama Lengkap</td><td width="5%">:</td><td>{{ $pendaftar->nama }}</td></tr>
    <tr><td>NIK</td><td>:</td><td>{{ $pendaftar->nik }}</td></tr>
    <tr><td>Email</td><td>:</td><td>{{ $pendaftar->email }}</td></tr>
    <tr><td>No. Telepon</td><td>:</td><td>{{ $pendaftar->no_hp }}</td></tr>

    <tr>
        <td>Program Studi Pilihan 1</td>
        <td>:</td>
        <td>{{ $pendaftar->program->name ?? '-' }}</td>
    </tr>

    <tr>
        <td>Program Studi Pilihan 2</td>
        <td>:</td>
        <td>{{ $pendaftar->program2->name ?? '-' }}</td>
    </tr>

    <tr>
        <td>Status Pembayaran Awal</td>
        <td>:</td>
        <td><strong>{{ ucfirst($payment->status) }}</strong></td>
    </tr>
</table>


    <!-- Pemisah section -->
    <div class="content-divider"></div>

    <!-- INFORMASI PENTING -->
    <div class="section-title">Informasi Penting</div>

    <p style="text-align: justify; line-height: 1.4;">
        Simpan kartu registrasi ini sebagai bukti bahwa Anda telah resmi terdaftar sebagai
        Calon Mahasiswa Politeknik Gorontalo. Informasi lebih lanjut mengenai jadwal ujian,
        verifikasi berkas, dan tahapan seleksi akan dikirimkan melalui email atau diumumkan
        di website resmi PMB.
    </p>

    <!-- Footer -->
    <div class="content-divider"></div>

    <div style="text-align: center; margin-top: 10px; font-size: 11px; color: #555;">
        Dicetak otomatis oleh sistem PMB {{ date('Y') }} — Politeknik Gorontalo.
    </div>

</div>

</body>
</html>
