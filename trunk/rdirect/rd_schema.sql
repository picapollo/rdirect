SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE SCHEMA IF NOT EXISTS `bdirect` ;
USE `bdirect` ;

-- -----------------------------------------------------
-- Table `bdirect`.`rd_ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_ci_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_login_attempts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `login` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `activated` TINYINT(1) NOT NULL DEFAULT '1' ,
  `banned` TINYINT(1) NOT NULL DEFAULT '0' ,
  `ban_reason` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_requested` DATETIME NULL DEFAULT NULL ,
  `new_email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_email_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_user_autologin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_user_autologin` (
  `key_id` CHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `user_id` INT(11) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`key_id`, `user_id`) ,
  INDEX `fk_rd_user_autologin_rd_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_rd_user_autologin_rd_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_user_profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `facebook_id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `school` VARCHAR(255) NULL DEFAULT NULL ,
  `city` VARCHAR(45) NULL DEFAULT NULL ,
  `job` VARCHAR(45) NULL DEFAULT NULL ,
  `home_phone` VARCHAR(45) NULL DEFAULT NULL ,
  `cell_phone` VARCHAR(45) NULL DEFAULT NULL ,
  `profile_picture` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `user_id`) ,
  INDEX `fk_rd_user_profiles_rd_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_rd_user_profiles_rd_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_rooms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_rooms` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `owner_id` INT(11) NOT NULL ,
  `activated` TINYINT(1) NULL DEFAULT 0 ,
  `title` VARCHAR(255) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_rd_rooms_rd_users1` (`owner_id` ASC) ,
  CONSTRAINT `fk_rd_rooms_rd_users1`
    FOREIGN KEY (`owner_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL DEFAULT NULL ,
  `description` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_cities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_cities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_calanders`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_calanders` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`, `room_id`) ,
  INDEX `fk_rd_calanders_rd_rooms1` (`room_id` ASC) ,
  CONSTRAINT `fk_rd_calanders_rd_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `bdirect`.`rd_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_photos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_photos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT(11) NOT NULL ,
  `order` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_rd_room_photos_rd_rooms1` (`room_id` ASC) ,
  CONSTRAINT `fk_rd_room_photos_rd_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `bdirect`.`rd_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_users_has_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_users_has_groups` (
  `user_id` INT(11) NOT NULL ,
  `group_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `group_id`) ,
  INDEX `fk_rd_users_has_rd_groups_rd_groups1` (`group_id` ASC) ,
  INDEX `fk_rd_users_has_rd_groups_rd_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_rd_users_has_rd_groups_rd_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rd_users_has_rd_groups_rd_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `bdirect`.`rd_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_groups_has_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_groups_has_users` (
  `group_id` INT NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`group_id`, `user_id`) ,
  INDEX `fk_rd_groups_has_rd_users_rd_users1` (`user_id` ASC) ,
  INDEX `fk_rd_groups_has_rd_users_rd_groups1` (`group_id` ASC) ,
  CONSTRAINT `fk_rd_groups_has_rd_users_rd_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `bdirect`.`rd_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rd_groups_has_rd_users_rd_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_groups_has_rooms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_groups_has_rooms` (
  `group_id` INT NOT NULL ,
  `room_id` INT NOT NULL ,
  PRIMARY KEY (`group_id`, `room_id`) ,
  INDEX `fk_rd_groups_has_rd_rooms_rd_rooms1` (`room_id` ASC) ,
  INDEX `fk_rd_groups_has_rd_rooms_rd_groups1` (`group_id` ASC) ,
  CONSTRAINT `fk_rd_groups_has_rd_rooms_rd_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `bdirect`.`rd_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rd_groups_has_rd_rooms_rd_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `bdirect`.`rd_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(45) NULL DEFAULT NULL ,
  `from_user_id` INT(11) NOT NULL ,
  `to_user_id` INT(11) NOT NULL ,
  `date_start` VARCHAR(45) NULL DEFAULT NULL ,
  `date_end` VARCHAR(45) NULL DEFAULT NULL ,
  `guests` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_rooms_starred`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_rooms_starred` (
  `user_id` INT(11) NOT NULL ,
  `room_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_rd_users_has_rd_rooms_rd_rooms1` (`room_id` ASC) ,
  INDEX `fk_rd_users_has_rd_rooms_rd_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_rd_users_has_rd_rooms_rd_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `bdirect`.`rd_users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rd_users_has_rd_rooms_rd_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `bdirect`.`rd_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_message_lists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_message_lists` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `rd_message_listscol` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_payout_methods`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_payout_methods` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

