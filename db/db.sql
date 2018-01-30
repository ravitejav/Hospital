CREATE DATABASE hosp;
use hosp;
CREATE TABLE `hosp`.`admin`
(
`id` INT NOT NULL AUTO_INCREMENT ,
`username` VARCHAR(10) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`question` VARCHAR(1) NOT NULL ,
`answer` VARCHAR(30) NOT NULL , PRIMARY KEY (`id`))ENGINE = InnoDB;

INSERT INTO `admin` (`id`, `username`, `password`, `question`, `answer`) VALUES (NULL, 'admin', '68a707945cb61095f8d63e6db9271d17', 'a', 'ravi');
CREATE TABLE `hosp`.`billed`
(
`id` INT NOT NULL ,
`patid` INT NOT NULL ,
`billerid` INT NOT NULL ,
`billamt` INT NOT NULL ,
`forwhat` VARCHAR(100) NOT NULL ,
`date` VARCHAR(15) NOT NULL ,
`time` VARCHAR(10) NOT NULL
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`feedback`
(
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(30) NOT NULL ,
`phone` VARCHAR(16) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`subject` VARCHAR(80) NOT NULL ,
`sug` VARCHAR(400) NOT NULL ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `hosp`.`medicine`
(
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` VARCHAR(16) NOT NULL ,
`type` VARCHAR(15) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`doctor`
(
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` BIGINT NOT NULL ,
`speci` VARCHAR(30) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
`docbill` INT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`patient`
(
`id` INT NOT NULL ,
`name` VARCHAR(40) NOT NULL ,
`fname` VARCHAR(40) NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
`gender` VARCHAR(5) NOT NULL ,
`address` VARCHAR(240) NOT NULL ,
`phone` BIGINT NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`refdoc` INT NOT NULL ,
`prob` VARCHAR(50) NOT NULL ,
`probdes` VARCHAR(300) NOT NULL ,
`docbill` INT NOT NULL ,
`testbill` INT NOT NULL ,
`hossbill` INT NOT NULL ,
`medbill` INT NOT NULL ,
`serbill` INT NOT NULL ,
`discon` VARCHAR(500) NOT NULL ,
`tests` VARCHAR(400) NOT NULL ,
`emer` INT(1) NOT NULL ,
`serv` VARCHAR(30) NOT NULL
) ENGINE = InnoDB;
ALTER TABLE `patient` ADD PRIMARY KEY(`id`);
ALTER TABLE `patient` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
CREATE TABLE `hosp`.`user`
(
`id` INT NOT NULL AUTO_INCREMENT ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`type` VARCHAR(15) NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`test`
(
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` BIGINT NOT NULL ,
`type` VARCHAR(15) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`recpeptionist` (
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` BIGINT NOT NULL ,
`type` VARCHAR(15) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`billing` (
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` BIGINT NOT NULL ,
`type` VARCHAR(15) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`serv`
(
`id` INT NOT NULL AUTO_INCREMENT ,
`ser` VARCHAR(120) NOT NULL ,
`cost` INT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`discharge`
(
`id` INT NOT NULL ,
`per` INT(1) NOT NULL ,
`sub` VARCHAR(200) NOT NULL ,
`desc` VARCHAR(800) NOT NULL ,
 PRIMARY KEY (`id`)
)ENGINE = InnoDB;
ALTER TABLE `discharge` ADD `req` INT NOT NULL AFTER `desc`;
CREATE TABLE `hosp`.`service`
(
`id` INT NOT NULL ,
`username` VARCHAR(30) NOT NULL ,
`password` VARCHAR(32) NOT NULL ,
`first` VARCHAR(30) NOT NULL ,
`last` VARCHAR(30) NOT NULL ,
`gender` VARCHAR(6) NOT NULL ,
`qua` VARCHAR(30) NOT NULL ,
`adress` VARCHAR(240) NOT NULL ,
`email` VARCHAR(40) NOT NULL ,
`phone` BIGINT NOT NULL ,
`speci` VARCHAR(30) NOT NULL ,
`timinga` INT NOT NULL ,
`timingb` INT NOT NULL ,
`session` VARCHAR(5) NOT NULL ,
`sal` INT NOT NULL ,
`date` VARCHAR(10) NOT NULL ,
`docbill` INT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
CREATE TABLE `hosp`.`med`
(
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(200) NOT NULL ,
`exp` VARCHAR(10) NOT NULL ,
`cost` INT NOT NULL ,
`stock` INT NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE = InnoDB;
