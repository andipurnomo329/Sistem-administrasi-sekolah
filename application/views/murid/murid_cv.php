<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 1px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 16px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            font-size: 12px;
            padding: 5px;
            vertical-align: top;
            border: none; /* Hapus border */
        }

        .text-center {
            text-align: center;
            display: block;
        }

        .right {
            text-align: right;
        }
        .left {
            text-align: left;
        }
        .timeStamp{
            font-size: 8px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<h1>Daftar Riwayat Siswa</h1>
<table>
    <tr>
        <td class="left" width="80%">
            <table cellpadding="3">
                <tr>
                    <td width="28%">Nama</td>
                    <td width="70%">: <?= strtoupper($nama) ?></td>
                </tr>
                <tr>
                    <td width="28%">Nis</td>
                    <td>: <?= $nis ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: <?= $agama ?></td>
                </tr>
                <tr>
                    <td>Tempat, Tgl Lahir</td>
                    <td>: <?= $tempat_lahir.', '.$tanggal_lahir ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= $alamat ?></td>
                </tr>
            </table>
        </td>
        <td width="20%" class="right"><img src="<?= base_url('files/murid/' . $foto) ?>" class="profile-photo" width="80" height="100"/></td>
    </tr>
</table>

<h2>History Kelas</h2>
<table cellpadding="3">
    <tr>
        <th width="7%">No.</th>
        <th width="70%">Nama Kelas</th>
        <th width="23%" class="right">Tahun Ajaran</th>
    </tr>
    <tr>
        <td class="text-center">1</td>
        <td>VII B</td>
        <td class="right">2024/2025</td>
    </tr>
    <tr>
        <td class="text-center">2</td>
        <td>VIII C</td>
        <td class="right">2025/2026</td>
    </tr>
    <tr>
        <td class="text-center">3</td>
        <td>IX A</td>
        <td class="right">2026/2027</td>
    </tr>
</table>

<h2>Prestasi</h2>
<table cellpadding="3">
    <tr>
        <th width="7%">No.</th>
        <td width="70%"></td>
        <th width="23%" class="right">Tahun</th>
    </tr>
    <tr>
        <td class="text-center">1</td>
        <td>Juara 1 Debat Bhs. Inggris </td>
        <td class="right">2024</td>
    </tr>
    <tr>
        <td class="text-center">2</td>
        <td>Peringkat 2 Festifal Seni Budaya Jakarta</td>
        <td class="right">2025</td>
    </tr>
    <tr>
        <td class="text-center">3</td>
        <td>Peringkat 3 Festifal Seni Budaya Jakarta</td>
        <td class="right">2024</td>
    </tr>
</table>

</body>
</html>
