CREATE TABLE Historique
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ID_Commande INT NOT NULL,
    ID_CompteClient INT NOT NULL
)

CREATE TABLE Panier
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    quantite INT DEFAULT NULL,
    ID_Produit INT NOT NULL,
)

CREATE TABLE Categorie
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL
)

CREATE TABLE SousCategorie
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR (50) NOT NULL,
    ID_Categorie INT NOT NULL
)

CREATE TABLE Categorie_Produit
(
    ID_Categorie INT NOT NULL,
    ID_Produit INT NOT NULL
)

CREATE TABLE Produit
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    reference VARCHAR(255) DEFAULT NULL,
    designation VARCHAR(255) DEFAULT NULL,
    poids INT(4) DEFAULT NULL,
    taille INT(5) DEFAULT NULL,
    couleur VARCHAR(50) DEFAULT NULL,
    taille_roue INT(3) DEFAULT NULL,
    matiere_cadre VARCHAR(50) DEFAULT NULL,
    type_suspension VARCHAR(50) DEFAULT NULL,
    type_frein VARCHAR(50) DEFAULT NULL,
    stock INT(4) DEFAULT NULL,
    prix INT(6) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    electrique TINYINT(1) DEFAULT 0
)

CREATE TABLE Commande
(
    idCommande INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    transporteur VARCHAR(255) DEFAULT NULL,
    code_colis VARCHAR(255) DEFAULT NULL,
    poids INT(4) DEFAULT NULL,
    taille INT(3) DEFAULT NULL,
    etat VARCHAR(25) DEFAULT NULL,
    ID_CompteClient INT NOT NULL
)

CREATE TABLE LigneCommande
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    quantite INT(4) DEFAULT NULL,
    montant_unite INT(4) DEFAULT NULL,
    montant_total INT(4) DEFAULT NULL,
    reference_produit VARCHAR(255) DEFAULT NULL,
    designation_produit VARCHAR(255) DEFAULT NULL,
    ID_Commande INT NOT NULL
)

CREATE TABLE CompteCLient
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    identifiant VARCHAR(55) DEFAULT NULL,
    mot_de_passe VARCHAR(255) DEFAULT NULL,
    nom VARCHAR(255) DEFAULT NULL,
    prenom VARCHAR(255) DEFAULT NULL,
    mail VARCHAR(255) DEFAULT NULL,
    telephone_port INT(25) DEFAULT NULL,
    telephone_fixe INT(25) DEFAULT NULL,
    adresse1 VARCHAR(255) DEFAULT NULL,
    adresse2 VARCHAR(255) DEFAULT NULL,
    ville VARCHAR(255) DEFAULT NULL,
    code_postal INT(10) DEFAULT NULL,
    pays VARCHAR(255) DEFAULT NULL,
    code_validation VARCHAR(255) DEFAULT NULL,
    etat VARCHAR(100) DEFAULT NULL
)

CREATE TABLE Promo
(
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    code VARCHAR(255) DEFAULT NULL,
    reduction DECIMAL(2) DEFAULT NULL,
    duree_validite TIME DEFAULT NULL,
    date_debut DATETIME DEFAULT NULL,
    date_fin DATETIME DEFAULT NULL,
    ID_Produit INT NOT NULL
)