
CREATE TABLE Produit(
    idProduit INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
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
    image VARCHAR(255) DEFAULT NULL
);

CREATE TABLE Promo(
    idPromo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    code VARCHAR(255) DEFAULT NULL,
    reduction DECIMAL(2) DEFAULT NULL,
    duree_validite TIME DEFAULT NULL,
    date_debut DATETIME DEFAULT NULL,
    date_fin DATETIME DEFAULT NULL,
    idProduit INT NOT NULL
);

CREATE TABLE Commande(
    idCommande INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    transporteur VARCHAR(255) DEFAULT NULL,
    code_colis VARCHAR(255) DEFAULT NULL,
    poids INT(4) DEFAULT NULL,
    taille INT(3) DEFAULT NULL,
    etat VARCHAR(25) DEFAULT NULL,
    idCompte_client INT NOT NULL
);

CREATE TABLE Ligne_commande(
    idLigne_commande INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    quantite INT(4) DEFAULT NULL,
    montant_unite INT(4) DEFAULT NULL,
    montant_total INT(6) DEFAULT NULL,
    reference_produit VARCHAR (255) DEFAULT NULL,
    designation_produit VARCHAR (255) DEFAULT NULL,
    idCommande INT NOT NULL,
    idProduit INT NOT NULL
);

CREATE TABLE Historique(
    idHistorique INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idLigne_commande INT NOT NULL,
    idCompte_client INT NOT NULL
);

CREATE TABLE Panier(
    idPanier INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    quantite INT (4) DEFAULT NULL,
    idProduit INT NOT NULL
);

CREATE TABLE Compte_client(
    idCompte_client INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    identifiant VARCHAR (255) NOT NULL,
    mot_de_passe VARCHAR (255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR (255) NOT NULL,
    mail VARCHAR (255) NOT NULL,
    telephone_port INT(25) NOT NULL,
    telephone_fixe INT(25) DEFAULT NULL,
    adresse_1 VARCHAR(255) NOT NULL,
    adresse_2 VARCHAR (255) DEFAULT NULL,
    ville VARCHAR(255) NOT NULL,
    code_postal VARCHAR(60) NOT NULL,
    pays VARCHAR(255) NOT NULL,
    code_validation VARCHAR(255) DEFAULT NULL,
    etat VARCHAR(255) DEFAULT NULL
);
