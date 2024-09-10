<style>
    /* Style pour la section de l'en-tête */
    .section-header {
        padding: 50px 0;
        text-align: center;
    }

    .section-header img {
        max-width: 100%;
        height: auto;
    }

    .section-header h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .section-header p {
        font-size: 1.2rem;
        color: #666;
    }

    /* Style pour la section des services */
    .section-services {
        padding: 50px 0;
    }

    .section-services h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
    }

    .service-item {
        text-align: center;
        margin-bottom: 30px;
    }

    .service-item i {
        font-size: 3rem;
        color: #007bff;
        /* Couleur bleue par défaut de Bootstrap */
    }

    .service-item h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .service-item p {
        font-size: 1.1rem;
        color: #666;
    }

    /* Style pour la section des biens en vedette */
    .section-featured-properties {
        padding: 50px 0;
    }

    .section-featured-properties h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
    }

    .property-card {
        margin-bottom: 30px;
        text-align: center;
    }

    .property-card img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .property-card h3 {
        font-size: 1.5rem;
        margin-top: 15px;
    }

    .property-card .btn-primary {
        margin-top: 15px;
    }

    /* Style pour la section des témoignages */
    .section-testimonials {
        padding: 50px 0;
    }

    .section-testimonials h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
    }

    .testimonial {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
    }

    .testimonial p {
        font-style: italic;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .testimonial span {
        font-weight: bold;
        display: block;
    }

    /* Responsive pour les colonnes */
    @media (max-width: 767.98px) {
        .section-header img {
            width: 100%;
        }
    }
</style>

<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <!-- En-tête de la page -->
                <section class="section-header">
                    <div class="row">
                        <div class="col-md-12">
                            <img style="width: 40%;" src="<?php echo base_url("assets/images/immo_logo.svg") ?>" alt="Logo Mada Immo" class="img-fluid">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Bienvenue dans l'Espace Administrateur de Mada Immo</h1>
                            <p>Gérez les biens immobiliers, consultez les statistiques et plus encore.</p>
                        </div>
                    </div>
                </section>

                <!-- Section sur les services (pour admin) -->
                <section class="section-services">
                    <h2>Fonctionnalités Administratives</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="service-item">
                                <i class="fas fa-home"></i>
                                <h3>Gestion des biens</h3>
                                <p>Ajoutez, modifiez ou supprimez des biens immobiliers.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-item">
                                <i class="fas fa-handshake"></i>
                                <h3>Transactions</h3>
                                <p>Visualisez les transactions récentes et historiques.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-item">
                                <i class="fas fa-chart-line"></i>
                                <h3>Statistiques</h3>
                                <p>Consultez les chiffres d'affaires, les gains et autres statistiques.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section des biens en vedette (simulé pour admin) -->
                <section class="section-featured-properties">
                    <h2>Biens en Vedette </h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="property-card">
                                <img src="<?= base_url("assets/images/houseImages/a209-appartement-moderne-en-centre-ville-1.jpg"); ?>" alt="Propriété 1" class="img-fluid">
                                <a href="<?php echo base_url("liste-habitations/details-location-") ."a209"; ?>" class="btn btn-primary">
                                    Détails
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="property-card">
                                <img src="<?= base_url("assets/images/houseImages/a209-appartement-moderne-en-centre-ville-2.jpg"); ?>" alt="Propriété 2" class="img-fluid">
                                <a href="<?php echo base_url("liste-habitations/details-location-") ."a209"; ?>" class="btn btn-primary">
                                    Détails
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="property-card">
                                <img src="<?= base_url("assets/images/houseImages/m340-maison-contemporaine-en-ville.jpg"); ?>" alt="Propriété 3" class="img-fluid">
                                <a href="<?php echo base_url("liste-habitations/details-location-") ."m340"; ?>" class="btn btn-primary">
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Témoignages (simulé pour admin) -->
                <section class="section-testimonials">
                    <h2>Témoignages Clients </h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="testimonial">
                                <p>"Mada Immo a su répondre rapidement à nos besoins en termes de gestion immobilière."</p>
                                <span>- Marc et Sophie R., Mahajanga</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="testimonial">
                                <p>"Nous sommes satisfaits des services professionnels et transparents de Mada Immo."</p>
                                <span>- Thomas B., Tamatave</span>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>