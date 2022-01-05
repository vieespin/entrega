/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     04-01-2022 10:36:41                          */
/*==============================================================*/


drop table if exists LABORATORIO;

drop table if exists RESERVA;

drop table if exists USUARIO;

/*==============================================================*/
/* Table: LABORATORIO                                           */
/*==============================================================*/
create table LABORATORIO
(
   ID_LABORATORIO       int not null auto_increment,
   NOMBRE_LAB           varchar(15) not null,
   primary key (ID_LABORATORIO)
);

/*==============================================================*/
/* Table: RESERVA                                               */
/*==============================================================*/
create table RESERVA
(
   ID_RESERVA           int not null auto_increment,
   ID_LABORATORIO       int not null,
   ID_USUARIO           int not null,
   FECHA                datetime not null,
   OBSERVACION          varchar(100),
   primary key (ID_RESERVA, ID_LABORATORIO, ID_USUARIO)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   ID_USUARIO           int not null auto_increment,
   RUT                  varchar(15) not null,
   NOMBRE               varchar(30) not null,
   AP_PATERNO           varchar(30) not null,
   AP_MATERNO           varchar(30),
   primary key (ID_USUARIO)
);

alter table RESERVA add constraint FK_RELATIONSHIP_2 foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO) on delete restrict on update restrict;

alter table RESERVA add constraint FK_RELATIONSHIP_3 foreign key (ID_LABORATORIO)
      references LABORATORIO (ID_LABORATORIO) on delete restrict on update restrict;

