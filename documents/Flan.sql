/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/20/2019 8:21:09 PM                        */
/*==============================================================*/


drop table if exists CHITIETDATHANG;

drop table if exists DATHANG;

drop table if exists HANGHOA;

drop table if exists KHACHHANG;

drop table if exists NHANVIEN;

drop table if exists NHOMHANGHOA;

drop table if exists TAIKHOAN;

/*==============================================================*/
/* Table: CHITIETDATHANG                                        */
/*==============================================================*/
create table CHITIETDATHANG
(
   SODONHH              varchar(5) not null,
   MSHH                 varchar(5) not null,
   SOLUONG              smallint not null,
   GIADATHANG           float not null,
   primary key (SODONHH, MSHH)
);

/*==============================================================*/
/* Table: DATHANG                                               */
/*==============================================================*/
create table DATHANG
(
   SODONHH              varchar(5) not null,
   MSNV                 varchar(5) not null,
   MSKH                 varchar(5) not null,
   NGAYDH               datetime not null,
   TRANGTHAI            varchar(10) not null,
   primary key (SODONHH)
);

/*==============================================================*/
/* Table: HANGHOA                                               */
/*==============================================================*/
create table HANGHOA
(
   MSHH                 varchar(5) not null,
   MANHOM               varchar(5) not null,
   TENHH                varchar(50) not null,
   GIA                  int not null,
   SOLUONGHANG          smallint not null,
   HINH                 varchar(50) not null,
   MOTAHH               varchar(200) not null,
   primary key (MSHH)
);

/*==============================================================*/
/* Table: KHACHHANG                                             */
/*==============================================================*/
create table KHACHHANG
(
   MSKH                 varchar(5) not null,
   HOTENKH              varchar(50) not null,
   DIACHI               varchar(50) not null,
   SODIENTHOAI          varchar(10) not null,
   primary key (MSKH)
);

/*==============================================================*/
/* Table: NHANVIEN                                              */
/*==============================================================*/
create table NHANVIEN
(
   MSNV                 varchar(5) not null,
   HOTENNV              varchar(50) not null,
   CHUCVU               varchar(50) not null,
   DIACHI               varchar(50) not null,
   SODIENTHOAI          varchar(10) not null,
   primary key (MSNV)
);

/*==============================================================*/
/* Table: NHOMHANGHOA                                           */
/*==============================================================*/
create table NHOMHANGHOA
(
   MANHOM               varchar(5) not null,
   TENNHOM              varchar(50) not null,
   primary key (MANHOM)
);

/*==============================================================*/
/* Table: TAIKHOAN                                              */
/*==============================================================*/
create table TAIKHOAN
(
   MSNV                 varchar(5) not null,
   TAIKHOAN             varchar(20) not null,
   MATKHAU              varchar(200) not null,
   key AK_IDENTIFIER_1 (MSNV)
);

alter table CHITIETDATHANG add constraint FK_CTDH_DH foreign key (SODONHH)
      references DATHANG (SODONHH) on delete restrict on update restrict;

alter table CHITIETDATHANG add constraint FK_CTDH_HH foreign key (MSHH)
      references HANGHOA (MSHH) on delete restrict on update restrict;

alter table DATHANG add constraint FK_DH_KH foreign key (MSKH)
      references KHACHHANG (MSKH) on delete restrict on update restrict;

alter table DATHANG add constraint FK_NV_DH foreign key (MSNV)
      references NHANVIEN (MSNV) on delete restrict on update restrict;

alter table HANGHOA add constraint FK_NHOMHANGHOA_HANGHOA foreign key (MANHOM)
      references NHOMHANGHOA (MANHOM) on delete restrict on update restrict;

alter table TAIKHOAN add constraint FK_NV_TK2 foreign key (MSNV)
      references NHANVIEN (MSNV) on delete restrict on update restrict;

