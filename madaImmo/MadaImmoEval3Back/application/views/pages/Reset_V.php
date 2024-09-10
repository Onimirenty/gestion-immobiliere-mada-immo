<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                </div>
                <div class="row">
                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-9">
                        <h1>Réinitialisation de la Base de Données</h1>

                        <?php if ($this->session->flashdata('message')) : ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('message'); ?></p>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')) : ?>
                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                        <?php endif; ?>

                        <form action="<?php echo base_url('ResetDatabase_C/execute'); ?>" method="post">
                            <p>Êtes-vous sûr de vouloir réinitialiser la base de données ? Cette action est irréversible.</p>
                            <button type="submit">Oui, réinitialiser</button>
                        </form>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>