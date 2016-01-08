-- MySQL Script generated by MySQL Workbench
-- 01/08/16 05:09:56
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema 3163_3362_3374
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema 3163_3362_3374
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `3163_3362_3374` DEFAULT CHARACTER SET utf8 ;
USE `3163_3362_3374` ;

-- -----------------------------------------------------
-- Table `3163_3362_3374`.`university`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`university` (
  `universityId` INT NOT NULL AUTO_INCREMENT,
  `universityName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`universityId`),
  UNIQUE INDEX `id_UNIQUE` (`universityId` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`department` (
  `departmentId` INT NOT NULL AUTO_INCREMENT,
  `departmentName` VARCHAR(45) NOT NULL,
  `universities_universityId` INT NOT NULL,
  PRIMARY KEY (`departmentId`),
  UNIQUE INDEX `id_UNIQUE` (`departmentId` ASC),
  INDEX `fk_departments_universities_idx` (`universities_universityId` ASC),
  CONSTRAINT `fk_departments_universities`
    FOREIGN KEY (`universities_universityId`)
    REFERENCES `3163_3362_3374`.`university` (`universityId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`user` (
  `userId` INT(10) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `userType` ENUM('ADMINISTRATOR', 'SECRETARY', 'PROFESSOR', 'STUDENT') NOT NULL,
  `departments_departmentId` INT NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `id_UNIQUE` (`userId` ASC),
  INDEX `fk_users_departments1_idx` (`departments_departmentId` ASC),
  CONSTRAINT `fk_users_departments1`
    FOREIGN KEY (`departments_departmentId`)
    REFERENCES `3163_3362_3374`.`department` (`departmentId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`course` (
  `courseId` INT NOT NULL AUTO_INCREMENT,
  `courseName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`courseId`),
  UNIQUE INDEX `courseId_UNIQUE` (`courseId` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3163_3362_3374`.`grade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `3163_3362_3374`.`grade` (
  `gradeId` INT NOT NULL AUTO_INCREMENT,
  `grade` DOUBLE NULL,
  `users_userId` INT(10) NOT NULL,
  `course_courseId` INT NOT NULL,
  PRIMARY KEY (`gradeId`),
  UNIQUE INDEX `idgrades_UNIQUE` (`gradeId` ASC),
  INDEX `fk_grades_users1_idx` (`users_userId` ASC),
  INDEX `fk_grade_course1_idx` (`course_courseId` ASC),
  CONSTRAINT `fk_grades_users1`
    FOREIGN KEY (`users_userId`)
    REFERENCES `3163_3362_3374`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grade_course1`
    FOREIGN KEY (`course_courseId`)
    REFERENCES `3163_3362_3374`.`course` (`courseId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
