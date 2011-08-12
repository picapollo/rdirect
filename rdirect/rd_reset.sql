CREATE SCHEMA IF NOT EXISTS `bdirect` ;
USE `bdirect` ;

-- -----------------------------------------------------
-- Table `bdirect`.`rd_ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_ci_sessions` ;

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
DROP TABLE IF EXISTS `bdirect`.`rd_login_attempts` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `login` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_users` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `has_photo` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `locale` CHAR(2) NOT NULL DEFAULT 'en' ,
  `currency` CHAR(3) NOT NULL DEFAULT 'USD' ,
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
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_user_autologin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_user_autologin` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_user_autologin` (
  `key_id` CHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `user_id` INT(11) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`key_id`, `user_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_user_profiles` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_user_profiles` (
  `user_id` INT(11) NOT NULL ,
  `facebook_id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `university` VARCHAR(255) NULL DEFAULT NULL ,
  `current_city` VARCHAR(45) NULL DEFAULT NULL ,
  `employer` VARCHAR(45) NULL DEFAULT NULL ,
  `about` TEXT NULL DEFAULT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  `phone_country` CHAR(2) NULL DEFAULT NULL ,
  `phone2` VARCHAR(20) NULL DEFAULT NULL ,
  `phone2_country` CHAR(2) NULL DEFAULT NULL ,
  `cell_phone` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_rd_user_profiles_rd_users1` (`user_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_rooms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_rooms` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_rooms` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL DEFAULT 0 ,
  `active` TINYINT NOT NULL DEFAULT 0 ,
  `property_type_id` TINYINT NOT NULL DEFAULT 1 ,
  `person_capacity` TINYINT NOT NULL DEFAULT 1 ,
  `room_type` ENUM('Private room','Shared room','Entire home/apt') NOT NULL DEFAULT 'Private room' ,
  `bedrooms` TINYINT NOT NULL DEFAULT 1 ,
  `beds` TINYINT NOT NULL DEFAULT 1 ,
  `bed_type_id` TINYINT NOT NULL DEFAULT 0 ,
  `bathrooms` TINYINT NOT NULL DEFAULT 0 ,
  `square_meter` VARCHAR(45) NOT NULL DEFAULT '' ,
  `amenities` SET('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32') NOT NULL DEFAULT '' ,
  `pets` SET('1','2','3','4') NOT NULL DEFAULT '' ,
  `native_currency` CHAR(3) NOT NULL DEFAULT 'USD' ,
  `price_native` INT NOT NULL DEFAULT 10 ,
  `weekly_price_native` INT NOT NULL DEFAULT 0 ,
  `monthly_price_native` INT NOT NULL DEFAULT 0 ,
  `price_for_extra_person_native` INT NOT NULL DEFAULT 0 ,
  `guests_included` TINYINT NOT NULL DEFAULT 1 ,
  `extras_price_native` INT NOT NULL DEFAULT 0 ,
  `security_deposit_native` INT NOT NULL DEFAULT 0 ,
  `cancel_policy` TINYINT NOT NULL DEFAULT 3 ,
  `min_nights` TINYINT NOT NULL DEFAULT 1 ,
  `max_nights` SMALLINT NOT NULL DEFAULT 365 ,
  `check_in_time` TINYINT NOT NULL DEFAULT -1 ,
  `check_out_time` TINYINT NOT NULL DEFAULT -1 ,
  `house_manual` TEXT NOT NULL DEFAULT '' ,
  `house_rules` TEXT NOT NULL DEFAULT '' ,
  `directions` TEXT NULL ,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id` (`user_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_photos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_photos` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_photos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT(11) NOT NULL ,
  `order` INT NOT NULL ,
  `caption` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `room_id` (`room_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_message_list`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_message_list` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_message_list` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_a` INT(11) NOT NULL ,
  `user_b` INT(11) NOT NULL ,
  `is_starred` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON INSERT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`, `user_a`, `user_b`) ,
  INDEX `to_user_id` (`user_a` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_rooms_starred`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_rooms_starred` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_rooms_starred` (
  `user_id` INT(11) NOT NULL ,
  `room_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `room_id`) ,
  INDEX `fk_rd_users_has_rd_rooms_rd_users2` (`user_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_payout_methods`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_payout_methods` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_payout_methods` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `user_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_descriptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_descriptions` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_descriptions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT NOT NULL ,
  `language` CHAR(2) NOT NULL DEFAULT 'en' ,
  `name` VARCHAR(35) NOT NULL DEFAULT '' ,
  `description` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `room_id` (`room_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_directions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_directions` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_directions` (
  `room_id` INT NOT NULL ,
  `text` TEXT NOT NULL DEFAULT '' ,
  PRIMARY KEY (`room_id`) ,
  INDEX `fk_table1_rd_rooms2` (`room_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_temp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_temp` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_temp` (
  `room_id` INT NOT NULL ,
  `email` VARCHAR(100) NOT NULL DEFAULT '' ,
  `phone` VARCHAR(20) NOT NULL DEFAULT '' ,
  `phone_country` CHAR(2) NOT NULL DEFAULT '' ,
  `sig` VARCHAR(45) NOT NULL ,
  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  PRIMARY KEY (`room_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_addresses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_addresses` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_addresses` (
  `room_id` INT NOT NULL ,
  `lat` FLOAT NOT NULL ,
  `lng` FLOAT NOT NULL ,
  `name` VARCHAR(60) NOT NULL ,
  `formatted_address_native` VARCHAR(100) NOT NULL DEFAULT '' ,
  `apt` VARCHAR(100) NOT NULL DEFAULT '' ,
  `address` VARCHAR(100) NOT NULL DEFAULT '' ,
  `lat_fuzzy` FLOAT NULL DEFAULT NULL ,
  `lng_fuzzy` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`room_id`) ,
  INDEX `latlng` (`lng` ASC, `lat` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_calendar_daily`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_calendar_daily` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_calendar_daily` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `available` TINYINT(1) NOT NULL DEFAULT 1 ,
  `price` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `room_date` (`room_id` ASC, `date` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_room_amenities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_room_amenities` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_room_amenities` (
  `room_id` INT NOT NULL ,
  `amenity_id` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`room_id`, `amenity_id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_calendar_monthly`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_calendar_monthly` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_calendar_monthly` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `price` INT NULL ,
  PRIMARY KEY (`id`, `room_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_calendar_weekly`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_calendar_weekly` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_calendar_weekly` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `price` INT NULL ,
  PRIMARY KEY (`id`, `room_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `bdirect`.`rd_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdirect`.`rd_messages` ;

CREATE  TABLE IF NOT EXISTS `bdirect`.`rd_messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `list_id` INT(11) NOT NULL ,
  `user_from` INT(11) NOT NULL ,
  `user_to` INT(11) NOT NULL ,
  `sent` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON INSERT CURRENT_TIMESTAMP ,
  `template` TINYINT NOT NULL DEFAULT 0 ,
  `room_id` INT NOT NULL DEFAULT 0 ,
  `checkin` DATE NOT NULL DEFAULT '0000/00/00 00:00:00' ,
  `checkout` DATE NOT NULL DEFAULT '0000/00/00 00:00:00' ,
  `number_of_guests` TINYINT NOT NULL DEFAULT 1 ,
  `price_native` INT NOT NULL DEFAULT 0 ,
  `text` TEXT NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`, `list_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

