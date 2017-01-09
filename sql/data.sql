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
from DUAL
where (select count(rowid) from llx_entrepot) =0

-- Fin création d'entepot