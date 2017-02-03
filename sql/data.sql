/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Clément
 * Created: 9 janv. 2017
 */
-- Création Utilisateurs*
/*
Insert into llx_usergroup(nom,entity,datec,tms,note)
values("Serveurs",1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,"Les serveurs du restaurant");

Insert into llx_user(entity,datec,tms,login,lastname,firstname,job)
values(1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,"Serveur1","Test","Serveur","Serveur");

Insert into llx_usergroup_user(entity,fk_user,fk_usergroup)
values
(
    1,
    (select rowid from llx_user where login="Serveur1"),
    (select rowid from llx_usergroup where nom="Serveurs")
);

Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),11);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),12);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),31);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),81);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),82);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),87);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),121);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),122);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),241);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),342);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),343);
Insert into llx_usergroup_rights(fk_usergroup,fk_id) values((select rowid from llx_usergroup where nom="Serveurs"),1001);

-- Fin création utilisateurs

-- Création des tables 
insert into llx_categorie(entity,fk_parent,label,type,description,visible)
values 
(
    1,
    0,
    "Tables",
    2,
    "Liste des tables du restaurant",
    0
);

insert into llx_societe (nom,client)
values
(
    "Table1",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table1")
);

insert into llx_societe (nom,client)
values
(
    "Table2",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table2")
);

insert into llx_societe (nom,client)
values
(
    "Table3",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table3")
);

insert into llx_societe (nom,client)
values
(
    "Table4",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table4")
);

insert into llx_societe (nom,client)
values
(
    "Table5",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table5")
);

insert into llx_societe (nom,client)
values
(
    "Table6",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table6")
);

insert into llx_societe (nom,client)
values
(
    "Table7",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table7")
);

insert into llx_societe (nom,client)
values
(
    "Table8",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table8")
);

insert into llx_societe (nom,client)
values
(
    "Table9",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table9")
);

insert into llx_societe (nom,client)
values
(
    "Table10",
    1
);

insert into llx_categorie_societe (fk_categorie,fk_soc)
values
(
    (select rowid from llx_categorie where label="Tables"),
    (select rowid from llx_societe where nom="Table10")
);

-- Fin création des tables

-- Création d'un entrepot si aucun n'est créer

insert into llx_entrepot(datec,tms,label,entity,description)
select current_timestamp,current_timestamp,"E1",1,"Entrepot1"
/*from DUAL
where (select count(rowid) from llx_entrepot) =0;

-- Fin création d'entepot

-- Création produits et stocks

insert into llx_categorie(entity,fk_parent,label,type,description,visible)
values(1,0,"Entrees",0,"Les entrees du restaurant",0);
insert into llx_categorie(entity,fk_parent,label,type,description,visible)
values(1,0,"Plats",0,"Les plats du restaurant",0);
insert into llx_categorie(entity,fk_parent,label,type,description,visible)
values(1,0,"Desserts",0,"Les desserts du restaurant",0);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("E1",1,current_timestamp,current_timestamp,10,0,"Entree 1","L'entree numero 1 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Entrees"),(select rowid from llx_product where ref="E1"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="E1"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("E2",1,current_timestamp,current_timestamp,10,0,"Entree 2","L'entree numero 2 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Entrees"),(select rowid from llx_product where ref="E2"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="E2"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("E3",1,current_timestamp,current_timestamp,10,0,"Entree 3","L'entree numero 3 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Entrees"),(select rowid from llx_product where ref="E3"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="E3"),(select rowid from llx_entrepot where label="E1"),10);


insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("P1",1,current_timestamp,current_timestamp,10,0,"Plat 1","Le plat numero 1 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Plats"),(select rowid from llx_product where ref="P1"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="P1"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("P2",1,current_timestamp,current_timestamp,10,0,"Plat 2","Le plat numero 2 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Plats"),(select rowid from llx_product where ref="P2"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="P2"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("P3",1,current_timestamp,current_timestamp,10,0,"Plat 3","Le plat numero 3 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Plats"),(select rowid from llx_product where ref="P3"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="P3"),(select rowid from llx_entrepot where label="E1"),10);


insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("D1",1,current_timestamp,current_timestamp,10,0,"Dessert 1","Le dessert numero 1 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Desserts"),(select rowid from llx_product where ref="D1"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="D1"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("D2",1,current_timestamp,current_timestamp,10,0,"Dessert 2","Le dessert numero 2 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Desserts"),(select rowid from llx_product where ref="D2"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="D2"),(select rowid from llx_entrepot where label="E1"),10);

insert into llx_product(ref,entity,datec,tms,stock,fk_parent,label,description,price,price_base_type,tosell,tobuy)
values("D3",1,current_timestamp,current_timestamp,10,0,"Dessert 3","Le dessert numero 3 du  restaurant de test",10,"HT",1,1);
insert into llx_categorie_product(fk_categorie,fk_product)
values((select rowid from llx_categorie where label="Desserts"),(select rowid from llx_product where ref="D3"));
insert into llx_product_stock(tms,fk_product,fk_entrepot,reel)
values(current_timestamp,(select rowid from llx_product where ref="D3"),(select rowid from llx_entrepot where label="E1"),10);

*/