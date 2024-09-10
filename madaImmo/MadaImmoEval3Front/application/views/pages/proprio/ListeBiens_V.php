<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title">Liste des biens</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>Propriétaire</th>
                                <th>Contact</th> -->
                                <th>reference</th>
                                <th>nom</th>
                                <th>Région</th>
                                <th>Loyer par mois</th>
                                <th>type</th>
                                <th>disponibilite</th>
                                <th>date disponibilite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($biens as $bien) : ?>
                                <tr>

                                    <td>
                                        <?= htmlspecialchars($bien['reference_bien']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bien['nom_bien']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($bien['region']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bien['loyer_par_mois']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bien['nom_type_bien']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($bien['disponibilite']) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $date_disponibilite = htmlspecialchars($bien['date_debut_disponibilite']);
                                        if ($bien['date_debut_disponibilite'] == null || empty($bien['date_debut_disponibilite'])) {
                                            $date_disponibilite = "disponible";
                                        }
                                        ?>
                                        <?= $date_disponibilite; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>