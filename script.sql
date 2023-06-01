CREATE TABLE produit (
    ProduitId SERIAL PRIMARY KEY, 
    Nom_produit VARCHAR(60) NOT NULL
);

CREATE TABLE entrepot(
    EntrepotId SERIAL PRIMARY KEY,
    Adresse TEXT,
    Designation VARCHAR(2),
    Superficie DOUBLE PRECISION NOT NULL,
    Hauteur DOUBLE PRECISION NOT NULL
);

CREATE TABLE detail_entrepot(
    detail_entrepot_Id SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    QuantiteStock DOUBLE PRECISION NOT NULL,
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
    Type_sortie ENUM(1,2)
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId)
);
-- View commence par v_nomdelavue
CREATE VIEW v_historique_entre as 
    SELECT Date_sortie,es.Nom_produit as Nom_produit,Quantite,e.Adresse as Adresse FROM entre_stock es JOIN produit p ON es.ProduitId = p.ProduitId JOIN entrepot e ON es.EntrepotId = e.EntreId;

CREATE VIEW v_historique_sortie as 
    SELECT Date_sortie, CASE WHEN Type_sortie = 1 THEN 'Local' ELSE 'Export' END AS Type_sortie, es.Nom_produit as Nom_produitn, Quantite, e.Adresse as Adresse  FROM sortie_stock ss JOIN produit p ON ss.ProduitId = p.ProduitId JOIN entrepot e ON ss.EntrepotId = e.EntreId;

CREATE VIEW v_etat_stock as 
    SELECT * FROM detail_entrepot GROUP BY EntrepotId;