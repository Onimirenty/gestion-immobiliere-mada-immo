</div>
<style>
    /* Style pour le footer */
    .footer {
        background-color: #f8f9fa;
        padding: 40px 0;
        text-align: center;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .footer .footer-logo {
        margin-bottom: 20px;
    }

    .footer .footer-logo img {
        max-width: 150px;
        height: auto;
    }

    .footer .footer-nav {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .footer .footer-nav a {
        color: #007bff;
        text-decoration: none;
        margin: 0 10px;
    }

    .footer .footer-nav a:hover {
        text-decoration: underline;
    }

    .footer .footer-social {
        margin-bottom: 20px;
    }

    .footer .footer-social a {
        color: #007bff;
        text-decoration: none;
        margin: 0 10px;
        font-size: 1.2rem;
    }

    .footer .footer-social a:hover {
        color: #0056b3;
    }

    .footer .footer-credits {
        font-size: 0.8rem;
        color: #6c757d;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Responsive pour les colonnes */
    @media (max-width: 767.98px) {
        .footer .footer-nav {
            flex-direction: column;
        }

        .footer .footer-credits {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
<footer class="footer">
    <div class="footer-logo">
        <img src="<?php echo base_url('assets/images/immo_logo.svg'); ?>" alt="Logo Mada Immo">
    </div>
    <div class="footer-nav">
        <a href="#">Accueil</a>
        <a href="#">Services</a>
        <a href="#">Biens en Vedette</a>
        <a href="#">Témoignages</a>
        <a href="#">Contact</a>
    </div>
    <div class="footer-credits">
        <p>
            &copy; 2024 Mada Immo. Tous droits réservés.
        </p>
        <p>
            Author: RATSIMBAZAFY Onimirenty 1890.
        </p>
    </div>
</footer>
</div>
</div>
</div>
<span class="d-flex align-items-center purchase-popup" style="display: none;z-index:1">
    <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
    <a href="https://www.bootstrapdash.com/product/celestial-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
    <i class="typcn typcn-delete-outline" id="bannerClose"></i>
</span>
<!-- setting sy loug out-->
<script src="<?php echo base_url("assets/vendors/js/vendor.bundle.base.js") ?> "> </script>
<!-- side bar -->
<script src="<?php echo base_url("assets/js/template.js") ?>"></script>
<!-- theme -->
<script src="<?php echo base_url("assets/js/settings.js") ?>"></script>
<!-- ???-->
<!-- <script src="<?php echo base_url("assets/js/off-canvas.js") ?> "></script> -->
<!-- ??? -->
<!-- <script src="<?php echo base_url("assets/js/hoverable-collapse.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/js/todolist.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/vendors/progressbar.js/progressbar.min.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/vendors/chart.js/Chart.min.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/js/dashboard.js") ?>"></script>  -->
</body>

</html>