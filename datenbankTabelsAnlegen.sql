drop database if exists inventarisierung;
create database inventarisierung
	character set latin1
    collate latin1_german2_ci;
    
use inventarisierung;

drop table if exists accounts;
create table if not exists accounts(
	id					int unsigned not null primary key auto_increment,
    email				varchar(100) not null,
    vorname				varchar(100) not null,
    nachname			varchar(100) not null,
    ortName				varchar(100) not null,	
    strasse				varchar(100) not null,
    hausnummer			varchar(100) not null,
    plz					varchar(100) not null,
    standort			varchar(100) not null,
	rolle				varchar(100) not null,
    passwort			varchar(100) not null,
    mitarbeiternr		varchar(100) not null,
    einstellungsdatum	date not null
);
drop table if exists hardware;
create table if not exists hardware(
	serienummer				varchar(100) not null primary key,
    hersteller				varchar(100) not null,
    kaufdatum				date not null,
    garantieablaufdatum		date not null,
    betriebssystem			varchar(100) not null,
    zubehoer				varchar(100) not null,	
    ausgegebenVon			varchar(100) not null,
    ausgegebenAn			varchar(100) not null,
    rueckgabedatum			date not null,
    standort				varchar(100) not null,
    ausgabestatus			varchar(100) not null,
    beschreibung			varchar(100) not null,
    verfuegbarkeit			varchar(100) not null
);

select * from accounts, hardware;
select * from hardware;