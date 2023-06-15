CREATE SEQUENCE produit_seq;

CREATE TABLE produit (
    ProduitId INT PRIMARY KEY DEFAULT(nextval('produit_seq')), 
    Nom_produit VARCHAR(60) NOT NULL
);

CREATE SEQUENCE entrepot_seq;

CREATE TABLE entrepot(
    EntrepotId INT PRIMARY KEY DEFAULT(nextval('entrepot_seq')),
    Adresse VARCHAR(80) NOT NULL,
    Superficie DOUBLE PRECISION NOT NULL,
    Hauteur DOUBLE PRECISION NOT NULL
);

CREATE TABLE entrepot_non_dispo(
    endId SERIAL PRIMARY KEY,
    EntrepotId INT,
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
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

CREATE SEQUENCE produit_seq;

CREATE TABLE produit (
    ProduitId INT PRIMARY KEY DEFAULT(nextval('produit_seq')), 
    Nom_produit VARCHAR(60) NOT NULL
);

CREATE SEQUENCE entrepot_seq;

CREATE TABLE entrepot(
    EntrepotId INT PRIMARY KEY DEFAULT(nextval('entrepot_seq')),
    Adresse VARCHAR(80) NOT NULL,
    Superficie DOUBLE PRECISION NOT NULL,
    Hauteur DOUBLE PRECISION NOT NULL
);

CREATE TABLE entrepot_non_dispo(
    endId SERIAL PRIMARY KEY,
    EntrepotId INT,
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);


CREATE TABLE detail_entrepot(
    detail_entrepot_Id SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    QuantiteStock DOUBLE PRECISION NOT NULL DEFAULT(0),
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId),
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);

CREATE TABLE entre_stock(
    EntreId SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    Date_entre DATE NOT NULL,
    Quantite DOUBLE PRECISION NOT NULL,
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId),
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);

CREATE TABLE sortie_stock(
    SortieId SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    Date_sortie DATE NOT NULL,
    Quantite DOUBLE PRECISION NOT NULL,
    Type_sortie SMALLINT,
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId),
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);

-- INSERT INTO sortie_stock VALUES(1,1,13,'2023/06/02',2,1);

CREATE TABLE produit_non_dispo(
    pndId SERIAL PRIMARY KEY, 
    ProduitId INT,
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId)
);

-- View commence par v_nomdelavue
CREATE VIEW v_historique_entre as 
    SELECT Date_entre,p.Nom_produit as Nom_produit,Quantite,e.Adresse as Adresse FROM entre_stock es JOIN produit p ON es.ProduitId = p.ProduitId JOIN entrepot e ON es.EntrepotId = e.EntrepotId;

CREATE OR REPLACE VIEW v_historique_sortie as 
    SELECT Date_sortie, CASE WHEN Type_sortie = 1 THEN 'Local' ELSE 'Exportation' END AS Type_sortie, p.Nom_produit as Nom_produit, Quantite, e.Adresse as Adresse  FROM sortie_stock ss JOIN produit p ON ss.ProduitId = p.ProduitId JOIN entrepot e ON ss.EntrepotId = e.EntrepotId;

CREATE VIEW v_p_dispo as 
    SELECT * FROM produit WHERE ProduitId NOT IN (SELECT ProduitId FROM produit_non_dispo);

CREATE VIEW v_e_dispo as 
    SELECT * FROM entrepot WHERE EntrepotId NOT IN (SELECT EntrepotId FROM entrepot_non_dispo);

CREATE VIEW v_liste_detail as 
    SELECT * FROM entrepot CROSS JOIN produit;

CREATE VIEW v_detail as 
    SELECT v.entrepotid,v.produitid,adresse,quantitestock FROM v_liste_detail v JOIN detail_entrepot d ON (v.entrepotid = d.entrepotid AND v.produitid = d.produitid);

CREATE VIEW v_sortie as 
    SELECT entrepotid,produitid,sum(quantite) from sortie_stock group by entrepotid,produitid;

CREATE VIEW v_entre  as 
    SELECT entrepotid,produitid,sum(quantite) from entre_stock group by entrepotid,produitid;

 create view v_detail_dispo as
    select * from detail_entrepot where produitid in (select produitid from v_p_dispo);

CREATE VIEW v_join_detail as 
    SELECT e.entrepotid,produitid,adresse,superficie,hauteur,quantitestock from entrepot e inner join v_detail_dispo d on e.entrepotid = d.entrepotid;

CREATE VIEW v_etat_stock as  
    SELECT v.*,p.nom_produit,coalesce(coalesce(e.sum,0) - coalesce(s.sum,0),0) as instock from v_join_detail v left join v_sortie s on (v.entrepotid = s.entrepotid and v.produitid = s.produitid) left join v_entre e on (v.entrepotid = e.entrepotid and v.produitid = e.produitid) join produit p on v.produitid = p.produitid;


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
