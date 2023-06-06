
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

