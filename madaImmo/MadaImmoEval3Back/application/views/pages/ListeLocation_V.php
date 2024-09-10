<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                </div>
                <div class="row">
                    <div class="col-lg-1">
                    </div>

                    <div class="col-lg-11">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reference Bien</th>
                                    <th>Type Bien</th>
                                    <th>Loyer Mensuel</th>
                                    <th>Commission</th>
                                    <th>Date Début</th>
                                    <th>Durée (mois)</th>
                                    <th>Contact Propriétaire</th>
                                    <th>email locataire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listeLocation as $info) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url("liste-habitations/details-location-") . "" . $info['reference_bien']; ?>">
                                                <?php echo $info['reference_bien']; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $info['type_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['loyer_mensuel']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['commission']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['date_debut']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['duree_mois']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['contact_proprietaire']; ?>
                                        </td>
                                        <td>
                                            <?php echo $info['email_locataire']; ?>
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
</div>

<!-- Script JavaScript -->
<script>
const dbName = 'locationsDB';
const dbVersion = 1;
let db;

const request = indexedDB.open(dbName, dbVersion);

request.onerror = function(event) {
    console.error("Erreur lors de l'ouverture de la base de données IndexDB:", event.target.errorCode);
};

request.onsuccess = function(event) {
    console.log("Base de données IndexDB ouverte avec succès");
    db = event.target.result;
    afficherDonnees(); // Appel à la fonction d'affichage après l'ouverture
};

request.onupgradeneeded = function(event) {
    db = event.target.result;

    if (!db.objectStoreNames.contains('locations')) {
        const store = db.createObjectStore('locations', { keyPath: 'id', autoIncrement: true });
        store.createIndex('reference_bien', 'reference_bien', { unique: true });
        store.createIndex('email_locataire', 'email_locataire', { unique: false });
        console.log("Base de données IndexDB prête à l'emploi");
    }
};

function ajouterLocationDansIndexDB(info) {
    const transaction = db.transaction(['locations'], 'readwrite');
    const store = transaction.objectStore('locations');
    const request = store.add(info);

    request.onsuccess = function(event) {
        console.log("Nouvelle location ajoutée à IndexDB");
    };

    request.onerror = function(event) {
        console.error("Erreur lors de l'ajout de la location à IndexDB:", event.target.errorCode);
    };
}

function afficherDonnees() {
    const transaction = db.transaction(['locations'], 'readonly');
    const store = transaction.objectStore('locations');
    const request = store.getAll();

    request.onsuccess = function(event) {
        const locations = event.target.result;
        const tbody = document.querySelector('#table-locations tbody');
        tbody.innerHTML = ''; // Efface le contenu existant du tbody

        locations.forEach(function(location) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${location.reference_bien}</td>
                <td>${location.type_bien}</td>
                <td>${location.loyer_mensuel}</td>
                <td>${location.commission}</td>
                <td>${location.date_debut}</td>
                <td>${location.duree_mois}</td>
                <td>${location.contact_proprietaire}</td>
                <td>${location.email_locataire}</td>
            `;
            tbody.appendChild(row);
        });
    };

    request.onerror = function(event) {
        console.error("Erreur lors de la récupération des locations depuis IndexDB:", event.target.errorCode);
    };
}
const cacheName = 'my-site-cache-v1';
const urlsToCache = [
    '/assets/css/vertical-layout-light/style.css',
    '/assets/vendors/js/vendor.bundle.base.js'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(cacheName)
            .then(cache => cache.addAll(urlsToCache))
    );
});
</script>