CREATE TABLE `tbl_address` (
  `pk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_salutation_id` int(10) unsigned DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address_1` varchar(100) DEFAULT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `address_3` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pk_id`),
  KEY `fk_address_salution_idx` (`fk_salutation_id`),
  CONSTRAINT `fk_address_salution` FOREIGN KEY (`fk_salutation_id`) REFERENCES `tbl_salutation` (`pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE `tbl_salutation` (
  `pk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_id`),
  UNIQUE KEY `value_UNIQUE` (`value`)
);



