CREATE OR REPLACE VIEW v_liste_biens_proprietaires AS
SELECT
    p.id_proprietaire,
    p.contact,
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    b.description_bien,
    b.region,
    b.loyer_par_mois,
    b.id_type_bien
FROM
    biens b
JOIN
    proprietaire p ON b.id_proprietaire = p.id_proprietaire;



Drop function f_get_chiffre_affaires_proprietaires;
CREATE OR REPLACE FUNCTION f_get_chiffre_affaires_proprietaires(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(contact_proprietaire VARCHAR, chiffre_affaires NUMERIC) AS $$
BEGIN
    RETURN QUERY
        SELECT 
            il.contact_proprietaire,
            -- il.type_bien,
            SUM(il.gain_proprio) AS chiffre_affaires
        FROM 
            information_location il
        WHERE 
            DATE_TRUNC('month', il.date_debut) BETWEEN DATE_TRUNC('month', date_debut_param::date) AND DATE_TRUNC('month', date_fin_param::date)
        GROUP BY 
            il.contact_proprietaire
            -- ,il.type_bien
            ;
END; $$
LANGUAGE plpgsql;

SELECT * FROM f_get_chiffre_affaires_proprietaires('2024-01-01', '2025-01-01');

CREATE OR REPLACE VIEW v_biens_proprietaire_disponibilite AS
SELECT 
    p.contact AS contact_proprietaire,
    b.reference_bien,
    b.nom_bien,
    b.description_bien,
    b.region,
    b.loyer_par_mois,
    tb.nom_type_bien,
    CASE 
        WHEN lb.id_bien IS NOT NULL THEN 'Loué'
        ELSE 'Disponible'
    END AS disponibilite,
    lb.date_debut,
    lb.duree_mois,
    (lb.date_debut + INTERVAL '1 month' * lb.duree_mois) AS date_fin
FROM 
    biens b
JOIN 
    proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN 
    type_bien tb ON b.id_type_bien = tb.id_type_bien
LEFT JOIN 
    location_bien lb ON b.id_bien = lb.id_bien
ORDER BY 
    contact_proprietaire, b.reference_bien;

CREATE OR REPLACE VIEW v_liste_biens_proprietaires_avec_disponibilite AS
SELECT 
    contact_proprietaire,
    reference_bien,
    nom_bien,
    -- description_bien,
    region,
    loyer_par_mois,
    nom_type_bien,
    disponibilite,
    date_debut,
    duree_mois,
    date_fin,
    date_debut_disponibilite
FROM (
    SELECT 
        p.contact AS contact_proprietaire,
        b.reference_bien,
        b.nom_bien,
        -- b.description_bien,
        b.region,
        b.loyer_par_mois,
        tb.nom_type_bien,
        CASE 
            WHEN lb.id_bien IS NOT NULL THEN 'Loué'
            ELSE 'Disponible'
        END AS disponibilite,
        lb.date_debut,
        lb.duree_mois,
        -- Date fin comme la fin du mois
        (date_trunc('month', lb.date_debut) + INTERVAL '1 month' * lb.duree_mois - INTERVAL '1 day') AS date_fin,
        -- Date début disponibilité comme le premier du mois suivant la date_fin
        (date_trunc('month', lb.date_debut) + INTERVAL '1 month' * lb.duree_mois) AS date_debut_disponibilite,
        ROW_NUMBER() OVER (PARTITION BY b.id_bien ORDER BY lb.date_debut DESC) AS row_num
    FROM 
        biens b
    JOIN 
        proprietaire p ON b.id_proprietaire = p.id_proprietaire
    JOIN 
        type_bien tb ON b.id_type_bien = tb.id_type_bien
    LEFT JOIN 
        location_bien lb ON b.id_bien = lb.id_bien
) AS subquery
WHERE 
    row_num = 1
ORDER BY 
    contact_proprietaire, reference_bien;
