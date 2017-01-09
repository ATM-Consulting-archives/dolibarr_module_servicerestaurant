/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Clément
 * Created: 9 janv. 2017
 */

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