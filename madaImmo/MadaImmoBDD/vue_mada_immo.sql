Drop function f_get_gain_admin;
CREATE OR REPLACE FUNCTION f_get_gain_admin(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(
    -- contact_proprietaire VARCHAR, 
    gain_admin NUMERIC) AS $$
BEGIN
    RETURN QUERY
        SELECT 
            -- il.contact_proprietaire,
            -- il.type_bien,
            SUM(il.gain_mada_immo) AS gain_admin
        FROM 
            information_location il
        WHERE 
            DATE_TRUNC('month', il.date_debut) BETWEEN DATE_TRUNC('month', date_debut_param::date) AND DATE_TRUNC('month', date_fin_param::date)
        -- GROUP BY 
            -- il.contact_proprietaire
            -- ,il.type_bien
            ;
END; $$
LANGUAGE plpgsql;
SELECT * FROM f_get_gain_admin('2020-01-01', '2029-01-01');


Drop function f_get_chiffre_affaire_total;
CREATE OR REPLACE FUNCTION f_get_chiffre_affaire_total(date_debut_param DATE, date_fin_param DATE)
RETURNS TABLE(
    -- contact_proprietaire VARCHAR,
     chiffre_affaire_total NUMERIC) AS $$
BEGIN
    RETURN QUERY
        SELECT 
            -- il.contact_proprietaire,
            -- il.type_bien,
            SUM(il.loyer_locataire) AS chiffre_affaire_total
        FROM 
            information_location il
        WHERE 
            DATE_TRUNC('month', il.date_debut) BETWEEN DATE_TRUNC('month', date_debut_param::date) AND DATE_TRUNC('month', date_fin_param::date)
        -- GROUP BY 
        --     il.contact_proprietaire
            -- ,il.type_bien
            ;
END; $$
LANGUAGE plpgsql;
SELECT * FROM f_get_chiffre_affaire_total('1900-01-01', '2129-01-01');
