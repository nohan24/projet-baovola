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
    entrepot_non_dispo_dId SERIAL PRIMARY KEY,
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

CREATE VIEW v_produit_dispo as 
    SELECT * FROM produit WHERE ProduitId NOT IN (SELECT ProduitId FROM produit_non_dispo);

CREATE VIEW v_entrepot_dispo as 
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
    select * from detail_entrepot where produitid in (select produitid from v_produit_dispo);

CREATE VIEW v_join_detail as 
    SELECT d.detail_entrepot_Id,e.entrepotid,produitid,adresse,superficie,hauteur,quantitestock from v_entrepot_dispo e inner join v_detail_dispo d on e.entrepotid = d.entrepotid;

CREATE VIEW v_etat_stock as  
    SELECT v.*,p.nom_produit,coalesce(coalesce(e.sum,0) - coalesce(s.sum,0),0) as instock from v_join_detail v left join v_sortie s on (v.entrepotid = s.entrepotid and v.produitid = s.produitid) left join v_entre e on (v.entrepotid = e.entrepotid and v.produitid = e.produitid) join produit p on v.produitid = p.produitid;

CREATE TABLE unite (
    UniteId SERIAL PRIMARY KEY, 
    Nom_unite VARCHAR(60) NOT NULL
);
insert into unite(Nom_unite) values('Kg');
insert into unite(Nom_unite) values('KW');
insert into unite(Nom_unite) values('Litre');
insert into unite(Nom_unite) values('Location journalier');
insert into unite(Nom_unite) values('Consommation periodique');
insert into unite(Nom_unite) values('Indefini');

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

CREATE VIEW v_mouvement_financier AS
    SELECT
        Date_transac AS date,
        etat as Entree,
        Libelle,
        (CASE WHEN etat = 6 THEN (Quantite * Unitaire * (-1)) ELSE Quantite * Unitaire END) AS solde
    FROM
        transac;

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

-- materiel 

CREATE TABLE fournisseur(
    FournisseurId SERIAL PRIMARY KEY,
    Nom VARCHAR(80),
    Coordonnee VARCHAR(100),
    Adresse VARCHAR(100)
);

CREATE TABLE fournisseur_non_dispo(
    fournisseur_dispo_id SERIAL PRIMARY KEY,
    FournisseurId INT,
    FOREIGN KEY(FournisseurId) REFERENCES fournisseur(FournisseurId)
);

CREATE TABLE achat_materiel(
    Achat_materiel_id SERIAL PRIMARY KEY,
    FournisseurId INT,
    Nom_materiel VARCHAR(80),
    Date_achat DATE,
    Type_materiel INT,
    Quantite DOUBLE PRECISION,
    Prix_unitaire DOUBLE PRECISION,
    FOREIGN KEY(FournisseurId) REFERENCES fournisseur(FournisseurId)
);

CREATE TABLE location_materiel(
    Location_materiel_id SERIAL PRIMARY KEY,
    FournisseurId INT,
    Nom_materiel VARCHAR(80),
    Date_debut DATE,
    Type_materiel INT,
    Duree INT,
    Quantite DOUBLE PRECISION,
    Prix_unitaire_jour DOUBLE PRECISION,
    FOREIGN KEY(FournisseurId) REFERENCES fournisseur(FournisseurId)
);

CREATE VIEW v_fournisseur_dispo as
    SELECT * FROM fournisseur WHERE FournisseurId NOT IN (SELECT FournisseurId FROM fournisseur_non_dispo);

CREATE VIEW v_stock_difference as 
    SELECT *, DATE_PART('day', (Date_debut + duree)-CURRENT_TIMESTAMP) AS days FROM location_materiel;

CREATE VIEW v_location_actuel as 
    SELECT v.*,f.nom as nom_fournisseur FROM v_stock_difference v JOIN fournisseur f ON v.FournisseurId = f.FournisseurId WHERE days > 0;

-- employe

create table Fonction(
    id_fonction serial PRIMARY key,
    libelle VARCHAR(50),
    salaireHeure double PRECISION
);

insert into Fonction values
(1,'Agriculteur',3000),
(2,'Recolteur',4000),
(3,'Gardien',10000)
;


CREATE TABLE Employe (
    id_emp SERIAL PRIMARY KEY NOT NULL, 
    nom VARCHAR(255) NOT NULL,
    prenomEmploye VARCHAR(255) NOT NULL,
    sexe INT NOT NULL,
    imgEmp VARCHAR(255),
    id_fonction int,
    dtn DATE NOT NULL,
    dateEmbauche Date NOT NULL,
    commentaire text
);

alter table Employe add foreign key (id_fonction) references fonction (id_fonction);

create table historiqueEmp(
    id_hystorique SERIAL PRIMARY KEY NOT NULL, 
    id_emp int NOT NULL,
    dateDepart date
);
alter table historiqueEmp add foreign key (id_emp) references Employe (id_emp);



-- insert into Employe values
-- (default,'ARIVELO', 'faly',1,null,3,'2003-06-07','2023-06-07',''),
-- (default,'Andriamparany', 'ny aro',1,null,3,'2003-06-07','2023-06-07','')
-- ;

create table Presence(
    id_emp int,
    dateEntree timestamp,
    dateSortie timestamp ,
    FOREIGN KEY (id_emp) REFERENCES Employe(id_emp)
);

-- insert into Presence values(3,'2023-06-07 09:18:00','2023-06-07 17:00:00');
-- insert into Presence values(3,'2023-06-08 09:00:00',null);
-- insert into Presence values(4,'2023-06-07 08:00:00','2023-06-07 18:00:00');
-- insert into Presence values(4,'2023-06-08 09:00:00','2023-06-08 15:00:00');

-- update presence set dateSortie =  where id_emp = %s and dateEntree = ; 
-- INSERT INTO presence values(1,'',null)
--vue dernier action presence , sortie ou entree
create or replace view V_dernier_action_presence as 
select t.id_emp id_emp ,t.dateEntree,s.dateSortie from (select id_emp,max(dateEntree) as dateEntree from Presence 
group by id_emp) as t  join Presence s on t.dateEntree = s.dateEntree and t.id_emp = s.id_emp;

-- vue calcul salaire par mois
create or replace view V_salaire_heure_mois as
SELECT E.id_emp, EXTRACT(MONTH FROM P.dateEntree) AS mois,
       EXTRACT(YEAR FROM P.dateEntree) AS annee,
       SUM(F.salaireHeure * (EXTRACT(EPOCH FROM (P.dateSortie - P.dateEntree))/3600)) AS salaireMensuel,
       SUM(EXTRACT(EPOCH FROM (P.dateSortie - P.dateEntree))/3600) AS tempsTravail
FROM Presence P
JOIN Employe E ON P.id_emp = E.id_emp
JOIN Fonction F ON E.id_fonction = F.id_fonction
GROUP BY mois, annee,E.id_emp;

-- vue calcul salaire,temps par jour
create or replace view V_temps_employe_jour as
SELECT P.dateEntree,P.dateSortie,E.id_emp, EXTRACT(DAY FROM P.dateEntree) AS jour,EXTRACT(MONTH FROM P.dateEntree) AS mois,
       EXTRACT(YEAR FROM P.dateEntree) AS annee,
       SUM(EXTRACT(EPOCH FROM (P.dateSortie - P.dateEntree))/3600) AS tempsTravail
FROM Presence P
JOIN Employe E ON P.id_emp = E.id_emp
JOIN Fonction F ON E.id_fonction = F.id_fonction
GROUP BY jour,mois,annee,E.id_emp,P.dateEntree,P.dateSortie
;

create view v_infoEmp as select E.*,F.libelle from employe E, fonction F where F.id_fonction = E.id_fonction;
 
create view EmpValide as select E.*,F.libelle from employe E, fonction F where f.id_fonction = E.id_fonction and  E.id_emp not in (select id_emp from historiqueEmp);