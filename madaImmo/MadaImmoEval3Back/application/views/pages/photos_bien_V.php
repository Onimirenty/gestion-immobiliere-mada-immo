<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: center;
            color: #007BFF;
        }

        .photos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .photo {
            margin: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .photo:hover {
            transform: scale(1.05);
        }

        .photo img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .photo {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?php echo $titre_page; ?></h1>
        <h2>Informations sur la location</h2>
        <?php if (!empty($bien)) : ?>
            <?php foreach ($bien as $location) : ?>
                <div class="location-info">
                    <p><strong>Nom du bien :</strong> <?php echo $location['nom_bien']; ?></p>
                    <p><strong>Region :</strong> <?php echo $location['region']; ?></p>
                    <p><strong>Description :</strong> <?php echo $location['description_bien']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucune information disponible pour cette location.</p>
        <?php endif; ?>

        <h2>Photos du bien</h2>
        <div class="photos">
            <?php if (!empty($photos)) : ?>
                <?php foreach ($photos as $photo) : ?>
                    <div class="photo">
                        <?php 
                        // echo FCPATH;
                        ?>
                        <img src="<?php echo base_url($photo['url']); ?>" alt="<?= $bien[0]['nom_bien']; ?>">
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune photo disponible pour ce bien.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>