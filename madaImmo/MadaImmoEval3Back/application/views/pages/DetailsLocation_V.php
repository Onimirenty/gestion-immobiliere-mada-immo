<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                </div>
                <div class="row">


                    <div class="col-lg-12">
                        <h1 class="mb-4">Détails de la Location</h1>
                        <?php if (!empty($information_locations)) {
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reference Bien</th>
                                        <th>Type Bien</th>
                                        <th>Durée (mois)</th>
                                        <th>Contact Propriétaire</th>
                                        <th>Loyer Locataire</th>
                                        <th>Date Fin</th>
                                        <th>Mois</th>
                                        <th>Année</th>
                                        <th>Numéro Mois</th>
                                        <th>Email Locataire</th>
                                        <th>Statut Payement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $reference = "i109";
                                    foreach ($information_locations as $information_location) {
                                        $reference = $information_location['reference_bien'];
                                    ?>
                                        <tr <?php
                                            // if ($information_location['statu_payement'] == "paye" || $information_location['statu_payement'] == "payé")
                                            //     echo "style= 'color:green'";
                                            // else {
                                            //     echo "style= 'color:yellow'";
                                            // }
                                            $color = $this->Comparaison_M->ColorizeIfInRange($information_location['loyer_locataire'], 'red');

                                            ?>>
                                            <td <?php
                                                echo "style= 'color:{$color}'";
                                                ?>>
                                                <?php echo $reference; ?></td>
                                            <td><?php echo $information_location['type_bien']; ?></td>
                                            <td><?php echo $information_location['duree_mois']; ?></td>
                                            <td><?php echo $information_location['contact_proprietaire']; ?></td>
                                            <td <?php
                                                echo "style= 'color:{$color}'";
                                                ?>><?php echo $information_location['loyer_locataire']; ?></td>
                                            <td><?php echo $information_location['date_fin']; ?></td>
                                            <td><?php echo $information_location['mois']; ?></td>
                                            <td><?php echo $information_location['annee']; ?></td>
                                            <td><?php echo $information_location['numero_mois']; ?></td>
                                            <td><?php echo $information_location['email_locataire']; ?></td>
                                            <td><?php echo $information_location['statu_payement']; ?></td>
                                            <td>
                                                <a href="#" class="voirPhotos" data-url="<?php echo base_url('InformationLocation_C/voirPhotos') . '?var=' . $reference; ?>">voir les photos</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                        <!-- Modal pour afficher les photos et descriptions -->
                        <div class="modal fade" id="photosModal" tabindex="-1" role="dialog" aria-labelledby="photosModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photosModalLabel">Photos et descriptions du bien</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenu chargé dynamiquement -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="col-lg-1">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.voirPhotos').on('click', function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#photosModal .modal-body').html(response);
                    $('#photosModal').modal('show');
                },
                error: function(xhr, status, error) {
                    alert('Une erreur s\'est produite : ' + error);
                }
            });
        });
    });
</script>