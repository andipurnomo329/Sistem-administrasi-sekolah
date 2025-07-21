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
            padding: 0;
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
    </style>
</head>
<body>

<h1><?= $nama ?></h1>

<table>
    <tr>
        <td class="text-center">
            <strong>Telepon:</strong> <?= $no_telp ?> | 
            <strong>Email:</strong> username@gmail.com
        </td>
        <td width="30%" class="right"><img src="<?= base_url('files/guru/' . $foto) ?>" class="profile-photo" width="80" height="100"/></td>
    </tr>
</table>

<h2>Work Experiences</h2>
<table cellpadding="5">
    <tr>
        <td width="70%"><strong>SMP Negeri 1 Jakarta - Guru Bahasa Indonesia</strong></td>
        <td width="30%" class="right">2018 s/d Sekarang</td>
    </tr>
    <tr>
        <td colspan="2">- Mengajar mata pelajaran Bahasa Indonesia untuk kelas 7 hingga 9</td>
    </tr>
    <tr>
        <td colspan="2">- Membantu dalam pengembangan kurikulum berbasis kompetensi</td>
    </tr>
</table>

<h2>Education Level</h2>
<table cellpadding="5">
    <tr>
        <td width="70%"><strong>Universitas Negeri Jakarta, Pendidikan Bahasa Indonesia</strong></td>
        <td width="30%" class="right">2010 s/d 2014</td>
    </tr>
    <tr>
        <td><strong>SMA Negeri 1 Jakarta</strong></td>
        <td class="right">2007 s/d 2010</td>
    </tr>
</table>

</body>
</html>
