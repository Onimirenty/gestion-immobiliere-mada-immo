CREATE OR REPLACE VIEW v_liste_location_details AS
SELECT 
    lb.reference_bien,
    tb.nom_type_bien AS type_bien,
    b.loyer_par_mois AS loyer_mensuel,
    tb.commission,
    lb.date_debut,
    lb.duree_mois,
    p.contact AS contact_proprietaire,
    lb.id_location_bien,
    loc.email as email_locataire,
    EXTRACT(YEAR FROM lb.date_debut) AS annee,
    EXTRACT(MONTH FROM lb.date_debut) AS mois
FROM 
    location_bien lb
JOIN 
    biens b ON lb.id_bien = b.id_bien
JOIN 
    type_bien tb ON b.id_type_bien = tb.id_type_bien
JOIN 
    proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN 
    locataire loc ON loc.id_locataire = lb.id_locataire
;

CREATE OR REPLACE VIEW v_biens_disponibles AS
SELECT 
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    -- b.description_bien,
    b.region,
    b.loyer_par_mois,
    b.id_proprietaire,
    b.id_type_bien
FROM 
    biens b
LEFT JOIN 
    location_bien lb ON b.id_bien = lb.id_bien
WHERE 
    lb.id_bien IS NULL;


CREATE OR REPLACE VIEW v_information_Location AS
SELECT
    *,
    CASE 
        WHEN DATE_TRUNC('month', CURRENT_DATE) < DATE_TRUNC('month', il.date_debut) THEN 'a paye'
        WHEN DATE_TRUNC('month', CURRENT_DATE) > DATE_TRUNC('month', il.date_debut) THEN 'paye'
        ELSE 'payé'
    END AS statu_payement
FROM
    information_Location il
;


CREATE OR REPLACE VIEW v_type_bien_biens AS
SELECT
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    -- b.description_bien,
    -- b.region,
    -- b.loyer_par_mois,
    b.id_proprietaire,
    b.id_type_bien,
    tb.nom_type_bien,
    tb.commission
FROM
    biens b
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
ORDER BY 
    b.id_bien
;
CREATE OR REPLACE VIEW v_photos_biens AS
SELECT
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    b.region,
    b.id_proprietaire,
    b.id_type_bien,
    p.id_photo,
    p.url,
    b.description_bien
FROM
    biens b
JOIN 
    photos_bien pb ON b.id_bien = pb.id_bien
JOIN
    photos p ON p.id_photo = pb.id_photo
;