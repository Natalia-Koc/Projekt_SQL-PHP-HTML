CREATE DATABASE projekt_zfn;

CREATE TABLE projekt_zfn.gatunek(
	gatunek_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gatunek varchar(15) NOT NULL,
    rasa varchar(50)
);

CREATE TABLE projekt_zfn.zwierzaki (
  zwierzak_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  gatunek_id int(11) NOT NULL,
  data_urodzenia date,
  nazwa varchar(20) NOT NULL,
  zdjecie varchar(100),
  plec char(10) NOT NULL,
  opis varchar(1000) NULL,
  FOREIGN KEY (gatunek_id) REFERENCES gatunek (gatunek_id)
);

CREATE TABLE projekt_zfn.opiekun (
  opiekun_id int(11) NOT NULL PRIMARY KEY  AUTO_INCREMENT,
  nick varchar(30) NOT NULL,
  imie varchar(30) NOT NULL,
  nazwisko varchar(30) NOT NULL,
  haslo varchar(20) NOT NULL,
  telefon int(11) NOT NULL,
  miasto char(30) NOT NULL,
  ulica char(30) NOT NULL,
  dom char(4) NOT NULL,
  mieszkanie int(11)
);

CREATE TABLE projekt_zfn.opiekun_zwierze (
  opiekun_id int(11) NOT NULL,
  zwierzak_id int(11) NOT NULL,
  FOREIGN KEY (opiekun_id) REFERENCES opiekun (opiekun_id),
  FOREIGN KEY (zwierzak_id) REFERENCES zwierzaki (zwierzak_id)
);

CREATE TABLE projekt_zfn.uslugi (
  usluga_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  zwierzak_id int(11) NOT NULL,
  wlasciciel_id int(11) NOT NULL,
  opiekun_id int(11),
  nazwa_uslugi varchar(50) NOT NULL,
  cena int(11) NULL,
  usluga_star datetime NOT NULL,
  usluga_stop datetime NOT NULL,
  FOREIGN KEY (zwierzak_id) REFERENCES zwierzaki (zwierzak_id),
  FOREIGN KEY (wlasciciel_id) REFERENCES opiekun (opiekun_id),
  FOREIGN KEY (opiekun_id) REFERENCES opiekun (opiekun_id)
);

create table projekt_zfn.ocena(
	ocena int not null primary key auto_increment,
    usluga_id int not null,
    ocena int not null,
    foreign key (usluga_id) references uslugi(usluga_id)
);

CREATE TABLE projekt_zfn.oferty (
  oferty_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  o_wlasciciel_id int(11) NOT NULL,
  o_opiekun_id int(11) NOT NULL,
  o_usluga_id int(11) NOT NULL,
  wiadomosc varchar(500),
  stan_oferty varchar(45),
  FOREIGN KEY (o_wlasciciel_id) REFERENCES opiekun (opiekun_id),
  FOREIGN KEY (o_opiekun_id) REFERENCES opiekun (opiekun_id),
  FOREIGN KEY (o_usluga_id) REFERENCES uslugi (usluga_id)
);