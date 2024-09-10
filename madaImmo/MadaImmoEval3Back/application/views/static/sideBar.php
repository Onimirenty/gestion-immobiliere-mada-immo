<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image"></div>
                <div class="sidebar-profile-name"></div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
        </li>
        <?php
        if (isset($_SESSION['AdminInfo'])) {
        ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("chiffre-affaire"); ?>">
                    <i class="typcn typcn-book menu-icon"></i>
                    <span class="menu-title">voir les chiffres d'affaires</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("gain-administrateur"); ?>">
                    <i class="typcn typcn-book menu-icon"></i>
                    <span class="menu-title">voir les gains</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("ajout-nouvelle-location"); ?>">
                    <i class="typcn typcn-book menu-icon"></i>
                    <span class="menu-title">aloue une maison</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("liste-location"); ?>">
                    <i class="typcn typcn-book menu-icon"></i>
                    <span class="menu-title">voir liste location</span>
                </a>
            </li>

            
        <?php
        }
        ?>
        <!-- side menu item -->
    </ul>
</nav>