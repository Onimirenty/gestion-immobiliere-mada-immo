
Drop function f_get_info_location;

CREATE OR REPLACE FUNCTION f_get_info_location(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(
    date_debut DATE, 
    duree_mois INT,
    contact_proprietaire VARCHAR, 
    loyer_locataire NUMERIC, 
    date_fin DATE, 
    mois INT, 
    annee INT, 
    numero_mois INT, 
    statu_payement TEXT, 
    email_locataire TEXT,
    type_bien varchar
) 
AS $$
BEGIN
    RETURN QUERY
        SELECT
            il.date_debut,
            il.duree_mois,
            il.contact_proprietaire,
            il.loyer_locataire,
            il.date_fin,
            il.mois,
            il.annee,
            il.numero_mois,
            CASE 
                WHEN DATE_TRUNC('month', CURRENT_DATE) < DATE_TRUNC('month', il.date_debut) THEN 'a paye'
                WHEN DATE_TRUNC('month', CURRENT_DATE) > DATE_TRUNC('month', il.date_debut) THEN 'paye'
                ELSE 'payé'
            END AS statu_payement,
            il.email_locataire::TEXT,
            il.type_bien
        FROM
            information_Location il
        WHERE
            DATE_TRUNC('month',il.date_debut) BETWEEN DATE_TRUNC('month',date_debut_param) AND DATE_TRUNC('month',date_fin_param);
END; 
$$ LANGUAGE plpgsql;



SELECT * FROM f_get_info_location('2023-01-01', '2023-05-01');
