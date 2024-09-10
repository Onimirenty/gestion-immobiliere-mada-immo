<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mb-2 text-center">Import des fichiers CSV</h3class>
                            <?php if (isset($error)) : ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                            <?php endif; ?>
                            <?php echo form_open_multipart('DataImport_C/importCSV'); ?>
                            <p>
                                <label for="typeBien">Sélectionnez un fichier pour introduire les part de commision par type de maison :</label>
                                <br>
                                <center>
                                    <input type="file" id="typeBien" name="typeBien" required />
                                </center>
                            </p>
                            <br>
                            <p>
                                <label for="biens">Sélectionnez un fichier de Biens :</label>
                                <br>
                                <center>
                                    <input type="file" id="biens" name="biens" required />
                                </center>
                            </p>
                            <br>
                            <p>
                                <label for="locations">Sélectionnez un fichier pour les location :</label>
                                <br>
                                <center>
                                    <input type="file" id="locations" name="locations" required />
                                </center>
                            </p>
                            <input type="submit" value="Importer" class="btn btn-dark btn-rounded btn-fw" />
                            <?php echo form_close(); ?>
                    </div>
                    <div class="col-lg-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>