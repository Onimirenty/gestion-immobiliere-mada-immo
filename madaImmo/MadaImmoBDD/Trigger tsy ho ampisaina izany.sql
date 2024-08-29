CREATE OR REPLACE FUNCTION update_information_location()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' OR TG_OP = 'UPDATE' THEN
        INSERT INTO information_location (
            reference_bien, 
            type_bien, 
            loyer_mensuel, 
            commission, 
            date_debut, 
            duree_mois, 
            contact_proprietaire, 
            id_location_bien,
            gain_proprio, 
            gain_mada_immo, 
            loyer_locataire, 
            date_fin, 
            mois, 
            annee, 
            numero_mois
        )
        SELECT 
            lb.reference_bien, 
            tb.nom_type_bien, 
            b.loyer_par_mois, 
            tb.commission, 
            lb.date_debut, 
            lb.duree_mois, 
            p.contact, 
            lb.id_location_bien,
            (b.loyer_par_mois * (1 - tb.commission)) AS gain_proprio,
            (b.loyer_par_mois * tb.commission) AS gain_mada_immo,
            b.loyer_par_mois AS loyer_locataire,
            (lb.date_debut + INTERVAL '1 month' * lb.duree_mois - INTERVAL '1 day') AS date_fin,
            EXTRACT(MONTH FROM lb.date_debut) AS mois,
            EXTRACT(YEAR FROM lb.date_debut) AS annee,
            EXTRACT(MONTH FROM lb.date_debut) + (lb.duree_mois - 1) AS numero_mois
        FROM 
            location_bien lb
        JOIN 
            biens b ON lb.id_bien = b.id_bien
        JOIN 
            type_bien tb ON b.id_type_bien = tb.id_type_bien
        JOIN 
            proprietaire p ON b.id_proprietaire = p.id_proprietaire
        WHERE 
            lb.id_location_bien = NEW.id_location_bien
        ON CONFLICT (id_location_bien) DO UPDATE
        SET 
            reference_bien = EXCLUDED.reference_bien, 
            type_bien = EXCLUDED.type_bien, 
            loyer_mensuel = EXCLUDED.loyer_mensuel, 
            commission = EXCLUDED.commission, 
            date_debut = EXCLUDED.date_debut, 
            duree_mois = EXCLUDED.duree_mois, 
            contact_proprietaire = EXCLUDED.contact_proprietaire, 
            gain_proprio = EXCLUDED.gain_proprio, 
            gain_mada_immo = EXCLUDED.gain_mada_immo, 
            loyer_locataire = EXCLUDED.loyer_locataire, 
            date_fin = EXCLUDED.date_fin, 
            mois = EXCLUDED.mois, 
            annee = EXCLUDED.annee, 
            numero_mois = EXCLUDED.numero_mois;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


-- Trigger pour la table location_bien
CREATE TRIGGER after_insert_update_location_bien
AFTER INSERT OR UPDATE ON location_bien
FOR EACH ROW
EXECUTE FUNCTION update_information_location();

-- Trigger pour la table biens
CREATE TRIGGER after_update_biens
AFTER UPDATE ON biens
FOR EACH ROW
EXECUTE FUNCTION update_information_location();

-- Trigger pour la table type_bien
CREATE TRIGGER after_update_type_bien
AFTER UPDATE ON type_bien
FOR EACH ROW
EXECUTE FUNCTION update_information_location();

-- Trigger pour la table proprietaire
CREATE TRIGGER after_update_proprietaire
AFTER UPDATE ON proprietaire
FOR EACH ROW
EXECUTE FUNCTION update_information_location();

-- Trigger pour la table locataire
CREATE TRIGGER after_update_locataire
AFTER UPDATE ON locataire
FOR EACH ROW
EXECUTE FUNCTION update_information_location();
