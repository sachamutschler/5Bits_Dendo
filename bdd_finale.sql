drop table if exists categorie;
create table categorie
(
    idCategorie  int auto_increment
        primary key,
    nom          varchar(255) not null,
    idCategorie2 int          null
)
    charset = utf8mb4;

drop table if exists commande;
create table commande
(
    idCommande      int auto_increment
        primary key,
    date            datetime default CURRENT_TIMESTAMP not null,
    transporteur    varchar(255)                       null,
    code_colis      varchar(255)                       null,
    poids           int(4)                             null,
    taille          int(3)                             null,
    etat            varchar(25)                        null,
    idCompte_client int                                not null
)
    charset = utf8mb4;

drop table if exists compte_client;
create table compte_client
(
    idCompte_client int auto_increment
        primary key,
    identifiant     varchar(255)             not null,
    mot_de_passe    varchar(255)             not null,
    nom             varchar(255)             not null,
    prenom          varchar(255)             not null,
    mail            varchar(255)             not null,
    telephone_port  varchar(25)                  not null,
    telephone_fixe  varchar(25)                  null,
    adresse_1       varchar(255)             not null,
    adresse_2       varchar(255)             null,
    ville           varchar(255)             not null,
    code_postal     varchar(60)              not null,
    pays            varchar(255)             not null,
    code_validation varchar(255)             null,
    etat            varchar(255) default '0' null
)
    charset = utf8mb4;

drop table if exists ligne_commande;
create table ligne_commande
(
    idLigne_commande    int auto_increment
        primary key,
    quantite            int(4)       null,
    montant_unite       int(4)       null,
    montant_total       int(6)       null,
    reference_produit   varchar(255) null,
    designation_produit varchar(255) null,
    idCommande          int          not null,
    idProduit           int          not null
)
    charset = utf8mb4;

drop table if exists panier;
create table panier
(
    idPanier  int auto_increment
        primary key,
    quantite  int(4) null,
    idProduit int    not null
)
    charset = utf8mb4;

drop table if exists produit;
create table produit
(
    idProduit       int auto_increment
        primary key,
    reference       varchar(255)         null,
    designation     varchar(255)         null,
    poids           int(4)               null,
    taille          int(5)               null,
    couleur         varchar(50)          null,
    taille_roue     int(3)               null,
    matiere_cadre   varchar(50)          null,
    type_suspension varchar(50)          null,
    type_frein      varchar(50)          null,
    stock           int(4)               null,
    prix            int(6)               null,
    image           varchar(255)         null,
    electrique      tinyint(1) default 0 not null,
    idCategorie     int                  not null
)
    charset = utf8mb4;

drop table if exists promo;
create table promo
(
    idPromo        int auto_increment
        primary key,
    code           varchar(255) null,
    reduction      decimal(2)   null,
    duree_validite time         null,
    date_debut     datetime     null,
    date_fin       datetime     null,
    idProduit      int          not null
)
    charset = utf8mb4;

drop table if exists taxonomie;
create table taxonomie
(
    idTaxonomie int auto_increment
        primary key,
    nom         varchar(50) not null
);

drop table if exists taxonomie_produit;
create table taxonomie_produit
(
    idTaxonomie int not null,
    idProduit   int null
);

create index taxonomie_produit_produit_idProduit_fk
    on taxonomie_produit (idProduit);

create index taxonomie_produit_taxonomie_idTaxonomie_fk
    on taxonomie_produit (idTaxonomie);

create index promo_produit_idProduit_fk
    on promo (idProduit);

create index produit_categorie_idCategorie_fk
    on produit (idCategorie);

create index panier_produit_idProduit_fk
    on panier (idProduit);

create index ligne_commande_commande_idCommande_fk
    on ligne_commande (idCommande);

create index ligne_commande_produit_idProduit_fk
    on ligne_commande (idProduit);

create index commande_compte_client_idCompte_client_fk
    on commande (idCompte_client);

create index categorie_categorie_idCategorie_fk
    on categorie (idCategorie2);

