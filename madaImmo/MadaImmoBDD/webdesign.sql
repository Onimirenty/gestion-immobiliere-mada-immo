DROP table pages cascade;
DROP table metadata cascade;
DROP table metadata_pages cascade;
DROP table html_url cascade;

CREATE TABLE pages (
    id_page SERIAL PRIMARY KEY,
    titre varchar(250),
    nom_controleur varchar(250),
    description text
);

CREATE TABLE metadata (
    id_metadata SERIAL PRIMARY KEY,
    attribut varchar(250),
    valeur varchar(250)
);

CREATE TABLE metadata_pages (
    id_metadata_pages SERIAL PRIMARY KEY,
    id_page INTEGER REFERENCES pages (id_page) ON DELETE CASCADE,
    id_metadata INTEGER REFERENCES metadata (id_metadata) ON DELETE CASCADE
);

CREATE TABLE html_url(
    id_html_url serial PRIMARY KEY,
    nom_methode varchar(250),
    id_page INTEGER REFERENCES pages (id_page) ON DELETE CASCADE,
    url_rewrite TEXT
);

CREATE VIEW v_page_metadata AS
SELECT
    p.id_page,
    p.titre,
    p.nom_controleur,
    m.attribut,
    m.valeur
FROM
    pages p
JOIN
    metadata_pages mp ON p.id_page = mp.id_page
JOIN
    metadata m ON mp.id_metadata = m.id_metadata;

CREATE VIEW v_page_urls AS
SELECT
    p.id_page,
    p.titre,
    p.nom_controleur,
    hu.nom_methode,
    hu.url_rewrite
FROM
    pages p
JOIN
    html_url hu ON p.id_page = hu.id_page;



INSERT INTO pages (titre, nom_controleur, description)
VALUES
    ('Login des administrateur', 'Login_C', 'Page de connexion des utilisateurs.'),
    ('Accueil', 'Accueil_C', 'Page d''accueil du site.'),
    ('Chiffre d''affaire de Mada Immo', 'AdminStat_C', 'Affichage du chiffre d''affaire de Mada Immo.'),
    ('Détails sur les habitations', 'ListeLocation_C', 'Affichage des détails sur les habitations.'),
    ('Le gain d''argent des administrateurs', 'AdminStat_C', 'Affichage du gain d''argent des administrateurs.'),
    ('Importation des données depuis des CSV', 'DataImport_C', 'Importation des données depuis des fichiers CSV.'),
    ('Formulaire d''insertion de nouvelle location', 'Location_C', 'Inscription de client à une habitation.'),
    ('Affichage de photos et description des habitations', 'InformationLocation_C', 'Affichage des photos et description des habitations.');


INSERT INTO metadata (attribut, valeur)
VALUES
    ('description', 'Page de connexion des utilisateurs.'),
    ('description', 'Page d''accueil du site.'),
    ('description', 'Affichage du chiffre d''affaire de Mada Immo.'),
    ('description', 'Affichage des détails sur les habitations.'),
    ('description', 'Affichage du gain d''argent des administrateurs.'),
    ('description', 'Importation des données depuis des fichiers CSV.'),
    ('description', 'Inscription de client à une habitation.'),
    ('description', 'Affichage des photos et description des habitations.');

INSERT INTO metadata (attribut, valeur)
VALUES
    ('author', 'RATSIMBAZAFY Onimirenty Yvannio');
INSERT INTO metadata_pages (id_page, id_metadata)
VALUES
    ((SELECT id_page FROM pages WHERE 1=1), (SELECT id_metadata FROM metadata WHERE valeur = 'RATSIMBAZAFY Onimirenty Yvannio'))
;
INSERT INTO html_url (nom_methode, id_page, url_rewrite)
VALUES
    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'Login_C'), '/login'),
    ('adminSignIn', (SELECT id_page FROM pages WHERE nom_controleur = 'Login_C'), '/login/admin-sign-in'),
    ('userSignIn', (SELECT id_page FROM pages WHERE nom_controleur = 'Login_C'), '/login/user-sign-in'),
    ('deconnexion', (SELECT id_page FROM pages WHERE nom_controleur = 'Login_C'), '/logout'),

    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'Accueil_C'), '/accueil'),

    ('chiffreAffaire', (SELECT id_page FROM pages WHERE nom_controleur = 'AdminStat_C' AND titre = 'Chiffre d''affaire de Mada Immo'), '/admin/chiffre-affaire'),
    ('gainAdmin', (SELECT id_page FROM pages WHERE nom_controleur = 'AdminStat_C' AND titre = 'Le gain d''argent des administrateurs'), '/admin/gain-argent'),

    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'DataImport_C'), '/data-import'),
    ('importCSV', (SELECT id_page FROM pages WHERE nom_controleur = 'DataImport_C'), '/data-import/csv'),

    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'ExportPdf_C'), '/export-pdf'),

    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'InformationLocation_C'), '/location/information'),
    ('voirPhotos', (SELECT id_page FROM pages WHERE nom_controleur = 'InformationLocation_C'), '/location/photos'),

    ('index', (SELECT id_page FROM pages WHERE nom_controleur = 'ListeLocation_C'), '/locations'),
    ('detailsLocation', (SELECT id_page FROM pages WHERE nom_controleur = 'ListeLocation_C'), '/locations/details'),

    ('create', (SELECT id_page FROM pages WHERE nom_controleur = 'Location_C'), '/location/create'),
    ('store_ajax', (SELECT id_page FROM pages WHERE nom_controleur = 'Location_C'), '/location/store'),
    ('success', (SELECT id_page FROM pages WHERE nom_controleur = 'Location_C'), '/location/success');


INSERT INTO metadata_pages (id_page, id_metadata)
VALUES
    ((SELECT id_page FROM pages WHERE titre = 'Login des administrateur'), (SELECT id_metadata FROM metadata WHERE valeur = 'Page de connexion des utilisateurs.')),
    ((SELECT id_page FROM pages WHERE titre = 'Accueil'), (SELECT id_metadata FROM metadata WHERE valeur = 'Page d''accueil du site.')),
    ((SELECT id_page FROM pages WHERE titre = 'Chiffre d''affaire de Mada Immo'), (SELECT id_metadata FROM metadata WHERE valeur = 'Affichage du chiffre d''affaire de Mada Immo.')),
    ((SELECT id_page FROM pages WHERE titre = 'Détails sur les habitations'), (SELECT id_metadata FROM metadata WHERE valeur = 'Affichage des détails sur les habitations.')),
    ((SELECT id_page FROM pages WHERE titre = 'Le gain d''argent des administrateurs'), (SELECT id_metadata FROM metadata WHERE valeur = 'Affichage du gain d''argent des administrateurs.')),
    ((SELECT id_page FROM pages WHERE titre = 'Importation des données depuis des CSV'), (SELECT id_metadata FROM metadata WHERE valeur = 'Importation des données depuis des fichiers CSV.')),
    ((SELECT id_page FROM pages WHERE titre = 'Formulaire d''insertion de nouvelle location'), (SELECT id_metadata FROM metadata WHERE valeur = 'Inscription de client à une habitation.')),
    ((SELECT id_page FROM pages WHERE titre = 'Affichage de photos et description des habitations'), (SELECT id_metadata FROM metadata WHERE valeur = 'Affichage des photos et description des habitations.'));
