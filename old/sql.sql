CREATE DATABASE IF NOT EXISTS dbcustomer
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_unicode_ci;

USE dbcustomer;

CREATE TABLE IF NOT EXISTS tbmain
(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	loan_type varchar(50) NOT NULL,
	tenure varchar(50) NOT NULL,
	loan_purpose varchar(50) NOT NULL,
	industry varchar(50) NOT NULL,
	url text,
	location text	
);

CREATE TABLE IF NOT EXISTS tbloantype
(
	loan_type varchar(50) NOT NULL PRIMARY KEY,
	details text
);

CREATE TABLE IF NOT EXISTS tbtenure
(
	tenure varchar(50) NOT NULL PRIMARY KEY,
	details text
);

CREATE TABLE IF NOT EXISTS tbloanpurpose
(
	loan_purpose varchar(50) NOT NULL PRIMARY KEY,
	details text
);

CREATE TABLE IF NOT EXISTS tbcompanytype
(
	company_type varchar(50) NOT NULL PRIMARY KEY,
	details text
);

CREATE TABLE IF NOT EXISTS tbindustry
(
	industry varchar(50) NOT NULL PRIMARY KEY,
	details text
);

CREATE TABLE IF NOT EXISTS tbworkingstatus
(
	working_status varchar(50) NOT NULL PRIMARY KEY,
	details text
);

ALTER TABLE tbmain ADD CONSTRAINT fk_loan_type FOREIGN KEY(loan_type) REFERENCES tbloantype(loan_type);
ALTER TABLE tbmain ADD CONSTRAINT fk_tenure FOREIGN KEY(tenure) REFERENCES tbtenure(tenure);
ALTER TABLE tbmain ADD CONSTRAINT fk_loan_purpose FOREIGN KEY(loan_purpose) REFERENCES tbloanpurpose(loan_purpose);

INSERT INTO tbworkingstatus(personal, details) VALUES("Full-time", "No Time To Rest");
INSERT INTO tbworkingstatus(personal, details) VALUES("Part-time", "Play While Ya Can");

INSERT INTO tbloantype VALUES("UPL", "");

INSERT INTO tbtenure(tenure) VALUES("12");
INSERT INTO tbtenure(tenure) VALUES("24");
INSERT INTO tbtenure(tenure) VALUES("36");
INSERT INTO tbtenure(tenure) VALUES("48");

INSERT INTO tbloanpurpose(loan_purpose) VALUES("Renovation");

INSERT INTO tbcompanytype(company_type) VALUES("Limited Company");

INSERT INTO tbindustry(industry) VALUES("Cosmestics");

--ALTER TABLE tbmain ADD industry varchar(50) NOT NULL AFTER loan_purpose;

--ALTER TABLE Users DROP FOREIGN KEY fk_group




















