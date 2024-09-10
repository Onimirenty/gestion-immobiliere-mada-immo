<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/typicons.font/font/typicons.css'); ?> ">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?> ">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css'); ?> ">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/personnalizedCss/login.css'); ?> ">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?> " />

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('<?php echo base_url("assets/images/bgImmo.jpg"); ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .container-scroller {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .brand-logo img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="form-container">
            <div class="brand-logo">
                <img src="<?php echo base_url('assets/images/immo_logo.svg'); ?>" alt="logo">
            </div>
            <h4>Welcome to <strong>Mada Immo</strong></h4>
            <form action="<?php echo base_url('Login_C/clientRedirection'); ?>" method="post">
                <div class="form-group">
                    <label for="typeClient">Êtes-vous un :</label>
                    <select name="typeClient">
                        <option value="locataire">Locataire</option>
                        <option value="proprietaire">Propriétaire</option>
                    </select>
                </div>
                <div class="mt-3">
                    <input type="submit" class="btn btn-primary" value="SIGN IN" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>