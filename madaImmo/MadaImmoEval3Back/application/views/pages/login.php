<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion administrateur</title>
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
                                welcome to '<strong>Mada Immo</strong>'
                            </h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form action="<?php echo base_url("connexion-profil-administrateur"); ?>" method="post" class="pt-3">
                                <div class="form-group">
                                    <input type="text" name="userName" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" value="mirenty">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="mdp" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" value="0000">
                                </div>
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