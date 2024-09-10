<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image"></div>
                <div class="sidebar-profile-name"></div>
            </div>
            <!-- barre de recherche -->
            <!-- <div class="nav-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                    <div class="input-group-append">
                        <span class="input-group-text" id="search">
                            <i class="typcn typcn-zoom"></i>
                        </span>
                    </div>
                </div>
            </div> -->
            <!-- barre de recherche -->
            <p class="sidebar-menu-title">Dash menu</p>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("Test_C/"); ?>">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Test <span class="badge badge-primary ml-3">New</span></span>
            </a>
        </li> -->

        <?php
        if (isset($_SESSION['LocataireInfo'])) {
        ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("InformationLocation_C/"); ?>">
                    <i class="typcn typcn-book menu-icon"></i>
                    <span class="menu-title">voir le bilan des loyes</span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['ProprietaireInfo'])) {
        ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#crud-section" aria-expanded="false" aria-controls="crud-section">
                    <i class="typcn typcn-briefcase menu-icon"></i>
                    <span class="menu-title">Mes information prorpietaires</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>
                <div class="collapse" id="crud-section">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("Proprietaire_C/listeBiens"); ?>">voir la liste des biens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("Proprietaire_C/chiffreAffaires"); ?>">voir mon chiffre d'affaire </a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>