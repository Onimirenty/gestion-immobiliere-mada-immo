<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ultimate race admin</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/typicons.font/font/typicons.css"); ?> ">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/css/vendor.bundle.base.css"); ?> ">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/vertical-layout-light/style.css"); ?> ">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/personnalizedCss/login.css"); ?> ">
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?> " />

    <style>
        .container-scroller {
            position: relative;
            height: 100vh;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: url("<?php echo base_url('assets/images/background.jpg'); ?>") no-repeat center center fixed; */
            background-size: cover;
            z-index: -1;
        }

        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Semi-transparent background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .brand-logo img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<!-- <img src="<?php echo base_url('assets/images/background.jpg'); ?>" alt="Background Image" class="imagelolo"> -->

<body class="logBody">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="personnalizedForm auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <center>
                                    <img src="<?php echo base_url('assets/images/immo_logo.svg'); ?>" alt="logo">
                                </center>   
                            </div>
                            <h4>
                                Bienvenue chez '<strong>Mada Immo</strong>'
                            </h4>
                            <h6 class="font-weight-light">Connecter-vous pour continue.</h6>
                            <form action="<?php echo base_url("Login_C/proprietaireLogin"); ?>" method="post" class="pt-3">
                                <div class="form-group">
                                    <label for="email"> saisissez votre numero :</label>
                                    <input type="number" name="contact" class="form-control form-control-lg" id="numero_telephone" placeholder="numero de telephone" value="0340089076">
                                    <!-- <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required> -->
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value=" SIGN IN" />
                                    <?php if (isset($_GET['var']) && $_GET['var']) {
                                        echo "<center style='color:red'>connexion échouée</center>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>