INSERT INTO admin (nom, mdp) VALUES
('mirenty', '0000'),
('admin1', '1234'),
('admin2', 'mdp');

INSERT INTO proprietaire (nom, contact) VALUES
('alex', '0344856489'),
('paul', '0335590166'),
('kevin', '0327589425');

INSERT INTO locataire (nom, email) VALUES
('locataire1', 'locataire1@example.com'),
('locataire2', 'locataire2@example.com'),
('locataire3', 'locataire3@example.com');

INSERT INTO type_bien (type_bien, commission) VALUES 
('Maison', 0.50),
('Appartement', 0.35),
('Villa', 0.60),
('Immeuble', 0.40);

INSERT INTO biens (reference_bien,nom_bien, description_bien, region, loyer_par_mois, id_proprietaire, type_bien_id) VALUES 
('A1','Appartement 1 piece', 'Petit appartement d une piece situé en centre-ville.', 'Ile-de-France', 800.00, 1, 2),
('A2','Appartement 2 pieces', 'Appartement spacieux de deux pieces avec vue sur la ville.', 'Ile-de-France', 1200.00, 1, 2),
('I1','Immeuble 5 pieces 5 etages', 'Immeuble moderne avec 5 pieces et 5 etages, ideal pour bureaux.', 'Provence-Alpes-Cote d Azur', 5000.00, 2, 4),
('I2','Immeuble 8 pieces 3 etages', 'Immeuble avec 8 pieces reparties sur 3 etages, proche des commodites.', 'Provence-Alpes-Cote d Azur', 7000.00, 2, 4),
('M1','Maison à la campagne', 'Charmante maison situee à la campagne, ideale pour les familles.', 'Provence-Alpes-Cote d Azur', 1500.00, 2, 1),
('M2','Maison aux bords de la route', 'Maison confortable situee aux bords de la route principale.', 'Provence-Alpes-Cote d Azur', 1600.00, 2, 1),
('M3','Maison jaune', 'Maison lumineuse avec une belle façade jaune, proche de toutes commodites.', 'Provence-Alpes-Cote d Azur', 1700.00, 2, 1),
('V1','Villa avec piscine', 'Luxueuse villa avec piscine et jardin spacieux.', 'Provence-Alpes-Cote d Azur', 2500.00, 2, 3),
('V2','Villa moderne 2 etages', 'Villa moderne avec deux etages, equipée de toutes les commodités.', 'Provence-Alpes-Cote d Azur', 3000.00, 2, 3);


INSERT INTO location_bien (id_locataire,reference_location_bien,bien_id, duree_mois, date_debut) VALUES 
(1, 'locA1', 1, 1, '2024-01-15'),
(2, 'locA2',2, 2, '2024-02-01'),
(1, 'locI1',3, 1, '2024-03-01'),
(2, 'locI2',4, 3, '2024-01-01');

