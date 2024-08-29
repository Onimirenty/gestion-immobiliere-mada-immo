Drop table proprietaire  CASCADE;
Drop table locataire  CASCADE;
Drop table type_bien CASCADE;
Drop table biens CASCADE;
Drop table photos CASCADE;
Drop table location_bien CASCADE;
Drop table information_location CASCADE;

CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    Unique(nom)
);

CREATE TABLE proprietaire(
    id_proprietaire SERIAL PRIMARY KEY,
    contact VARCHAR(100) NOT NULL,
    Unique(contact)
);
CREATE TABLE locataire(
    id_locataire SERIAL PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    Unique(email)
);

CREATE TABLE type_bien (
    id_type_bien SERIAL PRIMARY KEY,
    nom_type_bien VARCHAR(50) NOT NULL,
    commission DECIMAL(8, 4) NOT NULL,
    Unique(nom_type_bien)
);

CREATE TABLE biens (
    id_bien SERIAL PRIMARY KEY,
    reference_bien VARCHAR(255) NOT NULL Unique,
    nom_bien VARCHAR(100) NOT NULL,
    description_bien TEXT NOT NULL,
    region VARCHAR(100) NOT NULL,
    loyer_par_mois DECIMAL(10, 2) NOT NULL check(loyer_par_mois >0),
    id_proprietaire INTEGER REFERENCES proprietaire(id_proprietaire),
    id_type_bien INT REFERENCES type_bien(id_type_bien)
);

CREATE TABLE photos (
    id_photo SERIAL PRIMARY KEY,
    url TEXT NOT NULL,
    id_bien INT REFERENCES biens(id_bien) ON DELETE CASCADE
);

CREATE TABLE photos_bien(
    id_photos_bien SERIAL PRIMARY KEY,
    id_photo INT REFERENCES photos(id_photo) ON DELETE CASCADE,
    id_bien INT REFERENCES biens(id_bien) ON DELETE CASCADE
);
CREATE TABLE location_bien (
    id_location_bien SERIAL PRIMARY KEY,
    id_locataire INTEGER REFERENCES locataire(id_locataire),
    id_bien INT REFERENCES biens(id_bien),
    reference_bien VARCHAR(255) NOT NULL,
    duree_mois INT NOT NULL,
    date_debut DATE NOT NULL,
    Unique(reference_bien,date_debut),
    Unique(id_bien,date_debut)
);

CREATE TABLE information_location (
    id_information_location SERIAL PRIMARY KEY,
    reference_bien VARCHAR(255) NOT NULL,
    type_bien VARCHAR(50) NOT NULL,
    loyer_mensuel DECIMAL(10, 2) NOT NULL CHECK(loyer_mensuel > 0),
    commission DECIMAL(8, 4) NOT NULL CHECK(commission >= 0 AND commission <= 1),
    date_debut DATE NOT NULL,
    duree_mois INT NOT NULL CHECK(duree_mois > 0),
    contact_proprietaire VARCHAR(100) NOT NULL,
    id_location_bien INT REFERENCES location_bien(id_location_bien) ON DELETE CASCADE,
    
    gain_proprio DECIMAL(10, 2) NOT NULL,
    gain_mada_immo DECIMAL(10, 2) NOT NULL,
    loyer_locataire  DECIMAL(10, 2) NOT NULL,
    date_fin DATE NOT NULL,
    mois INT NOT NULL CHECK(mois >= 1 AND mois <= 12),
    annee INT NOT NULL CHECK(annee >= 1900 AND annee <= 2100),
    numero_mois INT NOT NULL CHECK(numero_mois > 0),
    email_locataire VARCHAR(200) NOT NULL
);
