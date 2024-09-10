<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Triomphe</title>
    <link href="https://fonts.googleapis.com/css2?family=Georgia:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Georgia', serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .corps {
            margin-left: 40px;
            position: relative;
            width: 10.5in;
            height: 8.0in;
            color: whitesmoke;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Georgia', serif;
            font-size: 24px;
            text-align: center;
            background-image: url("<?php echo base_url('assets/images/trophy/Tmessage.jpg'); ?>");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .container {
            border: 20px solid tan;
            padding: 40px;
            width: 92%;
            height: 92%;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .logo {
            color: tan;
            font-weight: bold;
            font-size: 32px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }

        .marquee {
            color: tan;
            font-size: 48px;
            margin: 20px;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }

        .assignment {
            margin: 20px;
            font-style: italic;
            font-size: 28px;
            color: black;
        }

        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 20px auto;
            width: 200px;
            text-transform: uppercase;
            color: darkslategray;
        }

        .score {
            font-size: 28px;
            color: darkslategray;
            margin: 20px auto;
            text-transform: uppercase;
        }

        .reason {
            margin: 20px;
            font-size: 24px;
            line-height: 1.5;
            color: darkslategray;
        }

        .button-row {
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-2,
        .col-1,
        .col-3 {
            flex: 1;
        }

        .col-3 {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <center>
        <div id="corps" class="corps">
            <div class="container">
                <div class="logo">
                    Ultimate Team Race
                </div>

                <div class="marquee">
                    Certificat de Triomphe
                </div>

                <div class="assignment">
                    Ce certificat honore l'équipe
                </div>

                <div class="person">
                    <?php echo strtoupper($classement['nom_equipe']); ?>
                </div>
                <div class="score">
                    AVEC LE SCORE HONORABLE DE <?php echo strtoupper($classement['point_equipe']); ?>
                </div>

                <div class="reason">
                    pour avoir remporté la Compétition de <i>Ultimate Team Race</i> 2024, en reconnaissance de leur
                    performance exceptionnelle, de leur esprit d'équipe et de leur détermination inébranlable.
                </div>
            </div>
        </div>
        <div class="row button-row">
            <div class="col-2"></div>
            <div class="col-3">
                <div class="text-center">
                    <button onclick="exportp()" class="btn btn-primary">Valider</button>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="text-center">
                    <a class="btn btn-primary" href="<?= site_url('ToAccueilAdmin/classementGeneral'); ?>">Annuler</a>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </center>

    <script>
        function exportp() {
            var element = document.getElementById('corps');
            var opt = {
                margin: 0.1,
                filename: 'certificat_triomphe.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    logging: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>

</html>
