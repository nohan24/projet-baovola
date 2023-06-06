CREATE TABLE fournisseur(
    FournisseurId SERIAL PRIMARY KEY,
    Nom VARCHAR(80),
    Coordonne VARCHAR(100),
    Adresse VARCHAR(100)
);

CREATE TABLE achat_materiel(
    Achat_materiel_id SERIAL PRIMARY KEY,
    FournisseurId INT,
    Nom_materiel VARCHAR(80),
    Date_achat DATE,
    Type_materiel VARCHAR(50),
    Quantite DOUBLE PRECISION,
    Prix_unitaire DOUBLE PRECISION,
    FOREIGN KEY(FournisseurId) REFERENCES fournisseur(FournisseurId)

);
CREATE TABLE location_materiel(
    Location_materiel_id SERIAL PRIMARY KEY,
    FournisseurId INT,
    Nom_materiel VARCHAR(80),
    Date_debut DATE,
    Duree INT,
    Quantite DOUBLE PRECISION,
    Prix_unitaire_jour DOUBLE PRECISION,
    FOREIGN KEY(FournisseurId) REFERENCES fournisseur(FournisseurId)
);

INSERT INTO fournisseur VALUES(DEFAULT,'kiva','coordonne','c17 Eter');
INSERT INTO location_materiel VALUES(DEFAULT,1,'tracteur','2023/10/02',30,20,12000)
INSERT INTO achat_materiel VALUES(DEFAULT,1,'tracteur','2023/02/02','fer',3,100000);

INSERT INTO sortie_stock VALUES(1,7,1,'2023/06/02',2,1);

-- View commence par v_nomdelavue
CREATE VIEW v_historique_entre as 
    SELECT Date_entre,p.Nom_produit as Nom_produit,Quantite,e.Adresse as Adresse FROM entre_stock es JOIN produit p ON es.ProduitId = p.ProduitId JOIN entrepot e ON es.EntrepotId = e.EntrepotId;

CREATE OR REPLACE VIEW v_historique_sortie as 
    SELECT Date_sortie, CASE WHEN Type_sortie = 1 THEN 'Local' ELSE 'Exportation' END AS Type_sortie, p.Nom_produit as Nom_produit, Quantite, e.Adresse as Adresse  FROM sortie_stock ss JOIN produit p ON ss.ProduitId = p.ProduitId JOIN entrepot e ON ss.EntrepotId = e.EntrepotId;

CREATE VIEW v_etat_stock as 
    SELECT * FROM detail_entrepot GROUP BY EntrepotId;

CREATE VIEW v_p_dispo as 
    SELECT * FROM produit WHERE ProduitId NOT IN (SELECT ProduitId FROM produit_non_dispo);

CREATE VIEW v_e_dispo as 
    SELECT * FROM entrepot WHERE EntrepotId NOT IN (SELECT EntrepotId FROM entrepot_non_dispo);
CREATE VIEW v_achat_materiel as
    SELECT Date_achat,Nom_materiel,Quantite,Type_materiel,Nom from achat_materiel join fournisseur on achat_materiel.FournisseurId=fournisseur.FournisseurId;

CREATE OR REPLACE VIEW  v_date_fin AS
SELECT Date_debut + Duree*INTERVAL '1 day' AS date_fin,Date_debut,Nom_materiel,Nom,Quantite,Duree from location_materiel join fournisseur on location_materiel.FournisseurId=fournisseur.FournisseurId;

CREATE VIEW v_location_materiel_encours AS
 SELECT Date_debut, Nom_materiel, Quantite, Date_fin- CURRENT_DATE AS nombre_jours_restant, Nom from v_date_fin where Date_fin>=CURRENT_DATE and Date_debut<=CURRENT_DATE;




