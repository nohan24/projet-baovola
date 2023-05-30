CREATE TABLE produit (
    ProduitId SERIAL PRIMARY KEY, 
    Nom_produit VARCHAR(60)
);

CREATE TABLE entrepot(
    EntrepotId SERIAL PRIMARY KEY,
    Adresse TEXT,
    Superficie DOUBLE PRECISION NOT NULL,
    Hauteur DOUBLE PRECISION NOT NULL
);

CREATE TABLE detail_entrepot(
    detail_entrepot_Id SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    QuantiteStock DOUBLE PRECISION,
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId),
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);

CREATE TABLE entre_stock(
    EntreId SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    Date_entre DATE NOT NULL,
    Quantite DOUBLE PRECISION,
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId),
    FOREIGN KEY(EntrepotId) REFERENCES entrepot(EntrepotId)
);

CREATE TABLE sortie_stock(
    SortieId SERIAL PRIMARY KEY,
    EntrepotId INT,
    ProduitId INT,
    Date_sortie DATE NOT NULL,
    Quantite DOUBLE PRECISION,
    Type_sortie ENUM(1,2)
    FOREIGN KEY(ProduitId) REFERENCES produit(ProduitId)
);

-- View commence par v_nomdelavue