CREATE TABLE caisse(
    CaisseId SERIAL PRIMARY KEY,
    Date_caisse DATE NOT NULL,
    Entree double PRECISION,
    Sortie double PRECISION,
    Libelle VARCHAR(80) NOT NULL
);

CREATE VIEW v_mouvement_financier AS
    SELECT Date_caisse AS date,Entree,Sortie,Libelle,Entree - Sortie AS solde
    FROM caisse
;

CREATE TABLE unite (
    UniteId SERIAL PRIMARY KEY, 
    Nom_unite VARCHAR(60) NOT NULL
);

CREATE TABLE transac(
    TransacId SERIAL PRIMARY KEY,
    etat INT, -- vente 7, charge 6
    Date_transac DATE NOT NULL,
    Libelle VARCHAR(80) NOT NULL,
    Quantite double PRECISION,
    UniteId INT,
    Unitaire double PRECISION,
    FOREIGN KEY(UniteId) REFERENCES unite(UniteId)
);

CREATE VIEW v_charge AS
    SELECT t.Date_transac AS date,t.Libelle,t.Quantite,u.Nom_unite AS unite,t.Unitaire AS cout_unitaire,t.Quantite * t.Unitaire AS montant
    FROM transac t
    JOIN unite u ON t.UniteId = u.UniteId
    WHERE t.etat = 6
;
CREATE VIEW v_vente AS
    SELECT t.Date_transac AS date,t.Libelle,t.Quantite,u.Nom_unite AS unite,t.Unitaire AS prix_unitaire,t.Quantite * t.Unitaire AS montant
    FROM transac t
    JOIN unite u ON t.UniteId = u.UniteId
    WHERE t.etat = 7
;
