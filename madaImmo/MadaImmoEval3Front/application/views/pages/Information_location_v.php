<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                </div>
                <div class="row">
                    <div class="col-lg-11">
                        <div class="container mt-5">
                            <h1 class="mb-4">Information Location</h1>
                            <?php
                            if (isset($chiffre_d_affaires)) {
                                echo $chiffre_d_affaires;
                            }
                            ?>
                            </h1>
                            <form action="<?php echo site_url('InformationLocation_C/'); ?>" method="post">
                                <div class="form-group">
                                    <label for="date_debut">Date de début :</label>
                                    <input type="date" id="date_debut" name="date_debut" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_fin">Date de fin :</label>
                                    <input type="date" id="date_fin" name="date_fin" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Voir les information des loyes</button>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>ID Information Location</th> -->
                                        <!-- <th>Reference Bien</th> -->
                                        <th>Type Bien</th>
                                        <!-- <th>Loyer Mensuel</th> -->
                                        <!-- <th>Commission</th> -->
                                        <th>Date Début</th>
                                        <th>Durée (mois)</th>
                                        <th>Contact Propriétaire</th>
                                        <!-- <th>ID Location Bien</th> -->
                                        <!-- <th>Gain Proprio</th> -->
                                        <!-- <th>Gain Mada Immo</th> -->
                                        <th>Loyer Locataire</th>
                                        <th>Date Fin</th>
                                        <th>Mois</th>
                                        <th>Année</th>
                                        <th>Numéro Mois</th>
                                        <th>Statut Payement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($information_location as $info) : ?>
                                        <tr>
                                            <!-- <td><?php /*echo $info->id_information_location */; ?></td> -->
                                            <!-- <td><?php /*echo $info->id_location_bien */; ?></td> -->
                                            <!-- <td><?php /*echo $info->gain_proprio */; ?></td> -->
                                            <!-- <td><?php /*echo $info->gain_mada_immo */; ?></td> -->
                                            <!-- <td><?php /* echo $info['reference_bien']*/; ?></td> -->
                                            <!-- <td><?php /* echo $info['loyer_mensuel']*/; ?></td> -->
                                            <!-- <td><?php /* echo $info['commission']*/; ?></td> -->

                                            <td><?php echo $info['type_bien']; ?></td>
                                            <td><?php echo $info['date_debut']; ?></td>
                                            <td><?php echo $info['duree_mois']; ?></td>
                                            <td><?php echo $info['contact_proprietaire']; ?></td>

                                            <td><?php echo $info['loyer_locataire']; ?></td>
                                            <td><?php echo $info['date_fin']; ?></td>
                                            <td><?php echo $info['mois']; ?></td>
                                            <td><?php echo $info['annee']; ?></td>
                                            <td><?php echo $info['numero_mois']; ?></td>
                                            <td><?php echo $info['statu_payement']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>