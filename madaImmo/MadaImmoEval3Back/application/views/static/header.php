<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?php
        if (isset($titre_page)) {
            echo $titre_page;
        } else {
            echo "ImmoMada";
        }
        ?>
    </title>
    <!-- style global -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/vertical-layout-light/style.css") ?> ">
    <!-- iconne -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/typicons.font/font/typicons.css") ?> ">
    <!-- bouton flottant -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/css/vendor.bundle.base.css") ?> ">
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png") ?> " />
    <!-- <script src="<?php echo site_url('assets/js/html2pdf.bundle.js') ?>"></script> -->


    <?php if (isset($script)) {
        echo $script;
    }
    ?>

    <?php if (isset($meta)) {
        echo $meta;
    }
    ?>
</head>

<body>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch(error => {
                    console.log('Service Worker registration failed:', error);
                });
        }
    </script>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- ///// logo \\\\\ -->
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?php echo base_url("Accueil-profil-administrateur") ?>">
                    <img src="<?php echo base_url("assets/images/immo_logo.svg") ?>" alt="logo" />
                </a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"> </span>
                </button>
            </div>
            <!-- ///// logo \\\\\ -->

            <!-- //// banner \\\-->

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item  d-none d-lg-flex">
                        <?php if (isset($_SESSION['AdminInfo'])) {
                        ?>
                            <a class="nav-link" href="<?php echo base_url("reinitialisation-des-donnees-de-la-base") ?> ">
                                reset database
                            </a>
                        <?php } else {
                        ?>
                            <a class="nav-link" href="#">
                                do nothing
                            </a>
                        <? }
                        ?>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <?php if (isset($_SESSION['AdminInfo']) && isset($_SESSION['LogInfo'])) {
                        ?>
                            <a class="nav-link" href="<?php echo base_url("import-de-donnees") ?> ">
                                import data
                            </a>
                        <?php } else {
                        ?>
                            <a class="nav-link" href="#">
                                hi there UwO ! gambate UwU
                            </a>
                        <? }
                        ?>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle  pl-0 pr-0" href="templateStyleAndEffects/pages/" data-toggle="dropdown" id="profileDropdown">
                            <i class="typcn typcn-user-outline mr-0"></i>
                            <span class="nav-profile-name">logout and setting</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                            <a class="dropdown-item" href="<?php echo base_url('Deconnexion') ?>">
                                <i class="typcn typcn-power text-primary"></i>
                                log out
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>

            <!-- //// banner \\\-->

        </nav>
        <div class="container-fluid page-body-wrapper">
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close typcn typcn-delete-outline"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>
                        Light
                    </div>
                    <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                        Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles primary"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default border"></div>
                    </div>
                </div>
            </div>

            <?php
            include("sideBar.php");
            ?>
            <div class="main-panel">
                <div class="content-wrapper">