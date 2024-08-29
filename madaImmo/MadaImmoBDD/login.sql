CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    Unique(nom)
);

CREATE TABLE proprietaire(
    id_proprietaire SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    contact VARCHAR(100) NOT NULL,
    Unique(contact)
);
CREATE TABLE locataire(
    id_locataire SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    Unique(email)
);