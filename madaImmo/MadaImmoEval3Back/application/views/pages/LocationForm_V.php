<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
</style>
<div class="container">
    <h2>Ajouter une nouvelle location</h2>
    <div id="validation-errors"></div>
    <form id="location-form">
        <div class="form-group">
            <label for="id_bien">Bien disponible</label>
            <select name="id_bien" id="id_bien" class="form-control">
                <?php foreach ($biens as $bien) : ?>
                    <option value="<?php echo $bien->id_bien; ?>"><?php echo $bien->nom_bien; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_locataire">Locataire</label>
            <select name="id_locataire" id="id_locataire" class="form-control">
                <?php foreach ($locataires as $locataire) : ?>
                    <option value="<?php echo $locataire->id_locataire; ?>"><?php echo $locataire->email; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="2022-02-02">
        </div>
        <div class="form-group">
            <label for="duree_mois">Durée (mois)</label>
            <input type="number" name="duree_mois" id="duree_mois" class="form-control" value="10">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#location-form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url('Location_C/store_ajax'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json', // Attend un retour JSON
                error: function(response, jqXHR, textStatus, errorThrown) {
                    if (textStatus === 'Internal Server Error') {
                        // $('#validation-errors').html('Une erreur s\'est produite : ' + textStatus + ' - ' + errorThrown + '\n Échec de l\'ajout de la location.').removeClass('alert-success').addClass('alert alert-danger');
                        $('#validation-errors').html('Une erreur s\'est produite : \n Échec de l\'ajout de la location.').removeClass('alert-success').addClass('alert alert-danger');
                    } else {
                        $('#validation-errors').html('Location ajoutée avec succès.').removeClass('alert-danger').addClass('alert alert-success');
                    }
                }
            });
        });
    });
</script>