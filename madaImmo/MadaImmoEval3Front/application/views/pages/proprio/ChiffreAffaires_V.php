<style>
    .container {
        margin: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        margin: 5px 0 10px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007BFF;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
</style>
<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                </div>
                <div class="row">
                    <div class="col-lg-1">
                    </div>

                    <div class="col-lg-10">
                        <h1>Chiffre d'Affaires :
                            <?php
                            if (isset($chiffre_d_affaires)) {
                                echo $chiffre_d_affaires;
                            }
                            ?>
                        </h1>
                        <form action="<?php echo site_url('Proprietaire_C/chiffreAffaires'); ?>" method="post">
                            <div class="form-group">

                                <label for="date_debut">Date de début :</label>

                                <input type="date" id="date_debut" name="date_debut" class="form-control" required>
                            </div>
                            <div class="form-group">

                                <label for="date_fin">Date de fin :</label>

                                <input type="date" id="date_fin" name="date_fin" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Voir le chiffre d'affaires</button>
                        </form>
                        <?php if (isset($chiffre_affaires)) : ?>
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <!-- <th>Chiffre d'Affaires</th> -->
                                        <th>
                                            reference bien
                                        </th>
                                        <th>
                                            type bien
                                        </th>
                                        <th>
                                            loyer mensuel
                                        </th>
                                        <th>
                                            commission
                                        </th>
                                        <th>
                                            date debut
                                        </th>
                                        <th>
                                            duree mois
                                        </th>
                                        <!-- <th>
                        contact proprietaire
                    </th> -->
                                        <th>
                                            gain
                                        </th>
                                        <!-- <th>
                                            gain mada immo
                                        </th>
                                        <th>
                                            loyer locataire
                                        </th> -->
                                        <th>
                                            date fin
                                        </th>
                                        <th>
                                            mois
                                        </th>
                                        <th>
                                            anne
                                        </th>
                                        <th>
                                            numero mois
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($chiffre_affaires as $ca) : ?>
                                        <tr>
                                            <td><?php echo $ca['reference_bien'] ?> </td>
                                            <td><?php echo $ca['type_bien'] ?> </td>
                                            <td><?php echo number_format($ca['loyer_mensuel'], 2, ',', ' '); ?> </td>
                                            <td><?php echo number_format($ca['commission'], 4, ',', ' '); ?> </td>
                                            <td><?php echo $ca['date_debut'] ?> </td>
                                            <td><?php echo $ca['duree_mois'] ?> </td>
                                            <!-- <td><?php echo $ca['contact_proprietaire'] ?> </td> -->
                                            <td><?php echo number_format($ca['gain_proprio'], 2, ',', ' '); ?> </td>
                                            <!-- <td><?php echo number_format($ca['gain_mada_immo'], 2, ',', ' '); ?> </td>
                                            <td><?php echo number_format($ca['loyer_locataire'], 2, ',', ' '); ?> </td> -->
                                            <td><?php echo $ca['date_fin'] ?> </td>
                                            <td><?php echo $ca['mois'] ?> </td>
                                            <td><?php echo $ca['annee'] ?> </td>
                                            <td><?php echo $ca['numero_mois'] ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-1">
                </div>
            </div>
        </div>
    </div>
</div>