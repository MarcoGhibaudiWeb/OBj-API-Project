

CREATE DATABASE  IF NOT EXISTS waxDB;
USE waxDB;

CREATE TABLE IF NOT EXISTS search (
  title varchar(100) NOT NULL,
  recent int(10) NOT NULL AUTO_INCREMENT,
  qt varchar (100) NOT NULL,
  PRIMARY KEY (recent)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



















