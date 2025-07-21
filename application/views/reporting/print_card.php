<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Kartu Nama </title>
    <style>
        .card-container {
            color: #1ab2d9;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            page-break-after: always; /* Mencegah pemotongan antara halaman */
        }

        .card {
            background: linear-gradient(115deg, #fff, #f0f0f0);
            width: 8.5cm;
            height: 5cm;
            border: 1px solid #ddd;
            margin: 0.4cm;
            text-align: left;
            box-sizing: border-box;
            position: relative;
            page-break-inside: avoid; /* Menghindari pemotongan di dalam kartu */
            display: flex; /* Menggunakan flex untuk tata letak */
            align-items: center;
        }

        .card-header {
            /* padding: 0.2cm; */
            /* border: 1px solid #ddd; */
            font-size: 16px;
            font-weight: bold;
        }

        .card-body {
            font-size: 14px;
        }

        .profile-photo {
            border: 1px solid #ddd;
            padding: 2px;
            width: 50px;
            height: 50px;
            border-radius: 15%;
            position: absolute; /* Posisikan absolut untuk ditempatkan di kanan atas */
            top: 25px;
            right: 10px;
        }
        
        .card-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: absolute;
            bottom: 10px;
            left: 10px;
        }

        .footer {
            width: 8.5cm;
            position: absolute;
            bottom: 0px;
            background: #1ab2d9;
        }

        .header {
            width: 8.5cm;
            position: absolute;
            top: 0px;
            background: #1ab2d9;
        }
        .qrcode {
            position: absolute;
            bottom: 20px;
            right: 10px;
        }

        @media print {
            #printButton {
                display: none; /* Sembunyikan tombol print saat mencetak */
            }
            body {
                margin: 0;
                padding: 0;
            }
            .card-container {
                page-break-after: always;
            }
            .card {
                page-break-inside: avoid;
                page-break-after: auto;
                margin: 0.5cm; /* Margin kecil untuk cetakan */
            }
        }
    </style>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/jquery/jquery.qrcode.min.js"></script>
</head>
<body>
    <button id="printButton">Print Kartu Nama</button>
    <div id="printArea" class="card-container">
        <?php $i = 0; foreach ($people as $person) { ?>
        <div class="card">
            <img src="<?= base_url('assets/sb2/img/User-Pict-Profil.svg.png'); ?>" alt="Foto Profil" class="profile-photo">
            <div class="card-content">
                <div class="card-header">
                    <?= htmlspecialchars(strtoupper($person->nama)); ?>
                </div>
                <div class="card-body">
                    <p>ID : <?= htmlspecialchars($person->peopleCode); ?></p>
                </div>
            </div>
            <div class="qrcode" id="qrcode<?= $i; ?>"></div>
            <div class='footer'>&nbsp;</div>
            <div class='header'>&nbsp;</div>
        </div>
        <?php $i++; } ?>
    </div>

    <script>
        $(document).ready(function(){
            $('.card').each(function(index){
                var name = $(this).find('.card-header').text().trim();
                var jobTitle = $(this).find('.card-body p:nth-child(1)').text().replace('ID : ', '').trim();
                console.log(jobTitle);
                var vCardData = "BEGIN:VCARD\nVERSION:3.0\nN:" + name + "\nId:" + jobTitle + "\nEND:VCARD";

                $('#qrcode'+(index)).qrcode({
                    text: jobTitle,
                    width: 55,
                    height: 55
                });
            });

            $("#printButton").on("click", function(){
                window.print();
            });
        });
    </script>
</body>
</html>