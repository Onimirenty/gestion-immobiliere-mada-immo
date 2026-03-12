CREATE OR REPLACE VIEW v_chiffre_affaires_proprietaires AS
SELECT 
    p.nom AS proprietaire,
    tb.type_bien,
    tb.id_type_bien,
    SUM(
        CASE 
            WHEN l.duree_mois > 1 THEN
                b.loyer_par_mois + ( (l.duree_mois - 1) * (b.loyer_par_mois - (b.loyer_par_mois * tb.commission)) )
            ELSE 
                loyer_par_mois
        END
    ) AS chiffre_affaires,
    count(id_type_bien) as nombre_type_bien_possede
FROM 
    location_bien l
JOIN 
    biens b ON l.bien_id = b.id_bien
JOIN 
    proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN 
    type_bien tb ON b.type_bien_id = tb.id_type_bien
GROUP BY 
    p.nom,
    tb.type_bien,
    tb.id_type_bien  
    ;


SELECT * FROM f_get_chiffre_affaires_proprietaires('2024-01-01', '2024-12-31');
CREATE OR REPLACE FUNCTION f_get_chiffre_affaires_proprietaires(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(contact VARCHAR, type_bien VARCHAR, id_type_bien INT, chiffre_affaires NUMERIC, nombre_type_bien_possede BIGINT) AS $$
BEGIN
    RETURN QUERY
        SELECT 
            p.contact AS contact,
            tb.type_bien,
            tb.id_type_bien,
            SUM(
                CASE 
                    WHEN l.duree_mois > 1 THEN
                        b.loyer_par_mois + ( (l.duree_mois - 1) * (b.loyer_par_mois - (b.loyer_par_mois * tb.commission)) )
                    ELSE     
                        b.loyer_par_mois
                END
            ) AS chiffre_affaires,
            COUNT(tb.id_type_bien) AS nombre_type_bien_possede
        FROM 
            biens b
        JOIN 
            proprietaire p ON b.id_proprietaire = p.id_proprietaire
        JOIN 
            type_bien tb ON b.type_bien_id = tb.id_type_bien
        JOIN 
            location_bien l ON b.id_bien = l.bien_id
        WHERE 
            l.date_debut BETWEEN date_debut_param AND date_fin_param
        GROUP BY 
            p.contact, tb.type_bien, tb.id_type_bien;
END; $$
LANGUAGE plpgsql;






CREATE OR REPLACE VIEW v_gains_mensuels_mada_immo AS
SELECT 
    EXTRACT(YEAR FROM l.date_debut) AS annee,
    EXTRACT(MONTH FROM l.date_debut) AS mois,
    SUM(b.loyer_par_mois * tb.commission) AS gains
FROM 
    location_bien l
JOIN 
    biens b ON l.bien_id = b.id_bien
JOIN 
    type_bien tb ON b.type_bien_id = tb.id_type_bien
GROUP BY 
    annee, mois
ORDER BY 
    annee, mois;


CREATE OR REPLACE VIEW v_loyer_locataire AS
SELECT 
    l.email AS locataire,
    SUM(b.loyer_par_mois ) AS loyer_total
FROM 
    locataire l
JOIN 
    location_bien lb ON l.id_locataire = lb.id_locataire
JOIN 
    biens b ON lb.bien_id = b.id_bien
GROUP BY 
    l.email;



CREATE OR REPLACE VIEW v_chiffre_affaires_mada_immo AS
SELECT 
    SUM(CASE 
        WHEN l.duree_mois > 1 THEN
            b.loyer_par_mois + (b.loyer_par_mois * (tb.commission) * (l.duree_mois-1) )
        ELSE 
            b.loyer_par_mois 
        END) AS chiffre_affaires,
    tb.type_bien,
    tb.id_type_bien
FROM 
    location_bien l
JOIN 
    biens b ON l.bien_id = b.id_bien
JOIN 
    type_bien tb ON b.type_bien_id = tb.id_type_bien
GROUP BY 
    tb.type_bien,
    tb.id_type_bien
;


SELECT * FROM f_get_chiffre_affaires_mada_immo('2024-01-01', '2024-12-31');
CREATE OR REPLACE FUNCTION f_get_chiffre_affaires_mada_immo(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(chiffre_affaires NUMERIC,type_bien VARCHAR, id_type_bien INT) AS $$
BEGIN
    RETURN QUERY
        SELECT 
            SUM(
                CASE 
                    WHEN l.duree_mois > 1 THEN 
                    b.loyer_par_mois + (b.loyer_par_mois * (tb.commission) * (l.duree_mois-1))
                ELSE 
                    b.loyer_par_mois 
                END
                ) 
            AS chiffre_affaires,
        tb.type_bien,
        tb.id_type_bien
        FROM 
            location_bien l
        JOIN 
            biens b ON l.bien_id = b.id_bien
        JOIN 
            type_bien tb ON b.type_bien_id = tb.id_type_bien
        WHERE 
            l.date_debut BETWEEN date_debut_param AND date_fin_param
        GROUP BY 
            tb.type_bien,
            tb.id_type_bien;
END; $$
LANGUAGE plpgsql;



CREATE OR REPLACE VIEW v_biens_disponibles_avec_dates AS
SELECT 
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    -- b.description_bien,
    b.region,
    b.loyer_par_mois,
    b.id_proprietaire,
    b.id_type_bien,
    COALESCE(MAX(l.date_debut + INTERVAL '1 month' * l.duree_mois), CURRENT_DATE) AS date_disponibilite
FROM 
    biens b
LEFT JOIN 
    location_bien l ON b.id_bien = l.id_bien
GROUP BY 
    b.id_bien,
    b.reference_bien,
    b.nom_bien,
    b.description_bien,
    b.region,
    b.loyer_par_mois,
    b.id_proprietaire,
    b.id_type_bien;


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