SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `created_at` VARCHAR(45) NOT NULL ,
  `updated_at` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`languages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`languages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `code` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`address_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`address_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `value_id` TIMESTAMP NOT NULL ,
  `languages_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_address_type_languages1` (`languages_id` ASC) ,
  CONSTRAINT `fk_address_type_languages1`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`countries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`countries` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `capital` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `citizenship` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `country_code` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `currency` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `currency_code` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `currency_sub_unit` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `currency_symbol` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `full_name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `iso_3166_2` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `iso_3166_3` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `region_code` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `sub_region_code` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' ,
  `eea` TINYINT(1) NOT NULL DEFAULT '0' ,
  `calling_code` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `flag` VARCHAR(6) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `languages_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_countries_languages1_idx` (`languages_id` ASC) ,
  CONSTRAINT `fk_countries_languages1`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 895
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`states`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`states` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `country_id` INT(10) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_states_countries1` (`country_id` ASC) ,
  CONSTRAINT `fk_states_countries1`
    FOREIGN KEY (`country_id` )
    REFERENCES `mydb`.`countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`address`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `address_type_id` INT NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `state_id` INT NOT NULL ,
  `zip_code` VARCHAR(45) NOT NULL ,
  `city` VARCHAR(45) NOT NULL ,
  `is_active` TINYINT NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_address_address_type1_idx` (`address_type_id` ASC) ,
  INDEX `fk_address_states1_idx` (`state_id` ASC) ,
  CONSTRAINT `fk_address_address_type1`
    FOREIGN KEY (`address_type_id` )
    REFERENCES `mydb`.`address_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_states1`
    FOREIGN KEY (`state_id` )
    REFERENCES `mydb`.`states` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`companies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`companies` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `comercial_name` VARCHAR(255) NOT NULL ,
  `register_number` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `address_id` INT NOT NULL ,
  `website` VARCHAR(45) NULL ,
  `is_active` TINYINT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_companies_address1_idx` (`address_id` ASC) ,
  CONSTRAINT `fk_companies_address1`
    FOREIGN KEY (`address_id` )
    REFERENCES `mydb`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `code` VARCHAR(45) NOT NULL ,
  `avatar` VARCHAR(45) NOT NULL ,
  `required_points` FLOAT NULL ,
  `poster_percent` FLOAT NULL ,
  `supplier_percent` FLOAT NULL ,
  `gtalents_percent` FLOAT NULL ,
  `is_active` TINYINT NULL ,
  `languages_id` INT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `remember_token` VARCHAR(255) NULL ,
  `confirmation_token` VARCHAR(45) NULL ,
  `code` VARCHAR(45) NOT NULL ,
  `last_login` TIMESTAMP NULL ,
  `time_connect` VARCHAR(45) NULL ,
  `is_active` TINYINT NULL ,
  `status` VARCHAR(20) NOT NULL ,
  `country_id` INT(10) UNSIGNED NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `category_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_countries1` (`country_id` ASC) ,
  INDEX `fk_users_categories1` (`category_id` ASC) ,
  CONSTRAINT `fk_users_countries1`
    FOREIGN KEY (`country_id` )
    REFERENCES `mydb`.`countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `mydb`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`type_of_shared_searchs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`type_of_shared_searchs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_type_of_shared_searchs_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_type_of_shared_searchs_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`profile_positions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`profile_positions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_profile_positions_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_profile_positions_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`type_of_involved_searchs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`type_of_involved_searchs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_type_of_involved_searchs_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_type_of_involved_searchs_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`type_of_shared_opportunities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`type_of_shared_opportunities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_type_of_shared_oportunities_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_type_of_shared_oportunities_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`type_of_involved_opportunities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`type_of_involved_opportunities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_type_of_involved_oportunities_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_type_of_involved_oportunities_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`actual_positions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`actual_positions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_type_of_involved_oportunities_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_type_of_involved_oportunities_languages10`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`profiles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `company_id` INT NOT NULL ,
  `linkedin_url` VARCHAR(255) NOT NULL ,
  `availability` VARCHAR(45) NOT NULL ,
  `size` INT NOT NULL ,
  `points` FLOAT NOT NULL ,
  `actual_position_id` INT NOT NULL ,
  `profile_position_id` INT NOT NULL ,
  `type_of_shared_search_id` INT NOT NULL ,
  `type_of_involved_search_id` INT NOT NULL ,
  `type_of_shared_opportunity_id` INT NOT NULL ,
  `type_of_involved_opportunity_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_profiles_type_of_shared_searchs1_idx` (`type_of_shared_search_id` ASC) ,
  INDEX `fk_profiles_profile_positions1_idx` (`profile_position_id` ASC) ,
  INDEX `fk_profiles_type_of_involved_searchs1_idx` (`type_of_involved_search_id` ASC) ,
  INDEX `fk_profiles_type_of_shared_oportunities1_idx` (`type_of_shared_opportunity_id` ASC) ,
  INDEX `fk_profiles_type_of_involved_oportunities1_idx` (`type_of_involved_opportunity_id` ASC) ,
  INDEX `fk_profiles_actual_position1_idx` (`actual_position_id` ASC) ,
  INDEX `fk_profiles_companies1` (`company_id` ASC) ,
  CONSTRAINT `fk_profiles_type_of_shared_searchs1`
    FOREIGN KEY (`type_of_shared_search_id` )
    REFERENCES `mydb`.`type_of_shared_searchs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_profile_positions1`
    FOREIGN KEY (`profile_position_id` )
    REFERENCES `mydb`.`profile_positions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_type_of_involved_searchs1`
    FOREIGN KEY (`type_of_involved_search_id` )
    REFERENCES `mydb`.`type_of_involved_searchs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_type_of_shared_oportunities1`
    FOREIGN KEY (`type_of_shared_opportunity_id` )
    REFERENCES `mydb`.`type_of_shared_opportunities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_type_of_involved_oportunities1`
    FOREIGN KEY (`type_of_involved_opportunity_id` )
    REFERENCES `mydb`.`type_of_involved_opportunities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_actual_position1`
    FOREIGN KEY (`actual_position_id` )
    REFERENCES `mydb`.`actual_positions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_companies1`
    FOREIGN KEY (`company_id` )
    REFERENCES `mydb`.`companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_years`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_years` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_experience_years_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_experience_years_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`level_positions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`level_positions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_level_positions_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_level_positions_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cases_numbers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`cases_numbers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experiences`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experiences` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `company_id` INT NOT NULL ,
  `cases_number_id` INT NOT NULL ,
  `experience_years_id` INT NOT NULL ,
  `level_position_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_experiences_experience_years1_idx` (`experience_years_id` ASC) ,
  INDEX `fk_experiences_level_positions1_idx` (`level_position_id` ASC) ,
  INDEX `fk_experiences_cases_numbers1_idx` (`cases_number_id` ASC) ,
  INDEX `fk_experiences_companies1` (`company_id` ASC) ,
  CONSTRAINT `fk_experiences_experience_years1`
    FOREIGN KEY (`experience_years_id` )
    REFERENCES `mydb`.`experience_years` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_level_positions1`
    FOREIGN KEY (`level_position_id` )
    REFERENCES `mydb`.`level_positions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_cases_numbers1`
    FOREIGN KEY (`cases_number_id` )
    REFERENCES `mydb`.`cases_numbers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_companies1`
    FOREIGN KEY (`company_id` )
    REFERENCES `mydb`.`companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancy_status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancy_status` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  `value_id` INT NOT NULL ,
  `languages_id` INT NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vacancy_status_languages1` (`languages_id` ASC) ,
  CONSTRAINT `fk_vacancy_status_languages1`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`contract_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`contract_types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `value_id` INT NULL ,
  `languages_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scheme_works_languages1` (`languages_id` ASC) ,
  CONSTRAINT `fk_scheme_works_languages10`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`scheme_works`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`scheme_works` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `value_id` INT NULL ,
  `languages_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scheme_works_languages1` (`languages_id` ASC) ,
  CONSTRAINT `fk_scheme_works_languages1`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancies` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `poster_user_id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `positions_number` INT NOT NULL ,
  `scheme_work_id` INT NOT NULL ,
  `responsabilities` VARCHAR(45) NOT NULL ,
  `experience` VARCHAR(45) NOT NULL ,
  `file` VARCHAR(45) NULL ,
  `key_points` VARCHAR(45) NOT NULL ,
  `minimum_salary` DOUBLE NOT NULL ,
  `maximum_salary` DOUBLE NOT NULL ,
  `career_plan` VARCHAR(45) NOT NULL ,
  `contract_type_id` INT NOT NULL ,
  `sharing` VARCHAR(45) NOT NULL ,
  `address_id` INT NOT NULL ,
  `vacancy_status_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deletet_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vacancies_users1_idx` (`poster_user_id` ASC) ,
  INDEX `fk_vacancies_address1_idx` (`address_id` ASC) ,
  INDEX `fk_vacancies_vacancy_status1_idx` (`vacancy_status_id` ASC) ,
  INDEX `fk_vacancies_contract_types1` (`contract_type_id` ASC) ,
  INDEX `fk_vacancies_scheme_works1` (`scheme_work_id` ASC) ,
  CONSTRAINT `fk_vacancies_users1`
    FOREIGN KEY (`poster_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancies_address1`
    FOREIGN KEY (`address_id` )
    REFERENCES `mydb`.`address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancies_vacancy_status1`
    FOREIGN KEY (`vacancy_status_id` )
    REFERENCES `mydb`.`vacancy_status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancies_contract_types1`
    FOREIGN KEY (`contract_type_id` )
    REFERENCES `mydb`.`contract_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancies_scheme_works1`
    FOREIGN KEY (`scheme_work_id` )
    REFERENCES `mydb`.`scheme_works` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`contracts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`contracts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `vacancy_id` INT NOT NULL ,
  `company_id` INT NOT NULL ,
  `nda` VARCHAR(255) NULL ,
  `contrat` VARCHAR(255) NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_contracts_vacancies1_idx` (`vacancy_id` ASC) ,
  INDEX `fk_contracts_companies1_idx` (`company_id` ASC) ,
  CONSTRAINT `fk_contracts_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contracts_companies1`
    FOREIGN KEY (`company_id` )
    REFERENCES `mydb`.`companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancies_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancies_users` (
  `id` INT NOT NULL ,
  `vacancy_id` INT NOT NULL ,
  `supplier_user_id` INT NOT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  `is_active` TINYINT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_consultants_vacancies_vacancies1` (`vacancy_id` ASC) ,
  INDEX `fk_consultants_vacancies_users1_idx` (`supplier_user_id` ASC) ,
  CONSTRAINT `fk_consultants_vacancies_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultants_vacancies_users1`
    FOREIGN KEY (`supplier_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`scores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`scores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `score` FLOAT NOT NULL ,
  `register` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scores_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_scores_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`news`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `users_id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `section` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_news_users1` (`users_id` ASC) ,
  CONSTRAINT `fk_news_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`invoices`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`invoices` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `vacancy_id` INT NOT NULL ,
  `number` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `amount` DOUBLE NOT NULL ,
  `tax` DOUBLE NULL ,
  `supplier_user_id` INT NOT NULL ,
  `poster_user_id` INT NOT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  `payment_due` DATE NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_invoices_vacancies1_idx` (`vacancy_id` ASC) ,
  INDEX `fk_invoices_users1_idx` (`supplier_user_id` ASC) ,
  INDEX `fk_invoices_users2_idx` (`poster_user_id` ASC) ,
  CONSTRAINT `fk_invoices_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoices_users1`
    FOREIGN KEY (`supplier_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoices_users2`
    FOREIGN KEY (`poster_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `sender_user_id` INT NOT NULL ,
  `destinatary_user_id` INT NOT NULL ,
  `message` VARCHAR(45) NOT NULL ,
  `status` TINYINT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_by_sender` TIMESTAMP NULL ,
  `deleted_by_destinatary` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_messages_users1_idx` (`sender_user_id` ASC) ,
  INDEX `fk_messages_users2_idx` (`destinatary_user_id` ASC) ,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`sender_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users2`
    FOREIGN KEY (`destinatary_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`role_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`role_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `role_id`, `user_id`) ,
  INDEX `fk_role_users_roles1_idx` (`role_id` ASC) ,
  INDEX `fk_role_users_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_role_users_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `mydb`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_users_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permissions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`permissions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permission_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`permission_role` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_id` INT NOT NULL ,
  `permission_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `role_id`, `permission_id`) ,
  INDEX `fk_permission_role_roles1_idx` (`role_id` ASC) ,
  INDEX `fk_permission_role_permissions1_idx` (`permission_id` ASC) ,
  CONSTRAINT `fk_permission_role_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `mydb`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permission_role_permissions1`
    FOREIGN KEY (`permission_id` )
    REFERENCES `mydb`.`permissions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`companies_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`companies_users` (
  `company_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `is_active` TINYINT NULL ,
  `position` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`company_id`, `user_id`) ,
  INDEX `fk_companies_users_companies1_idx` (`company_id` ASC) ,
  INDEX `fk_companies_users_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_companies_users_companies1`
    FOREIGN KEY (`company_id` )
    REFERENCES `mydb`.`companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_companies_users_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sourcing_networks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sourcing_networks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sourcing_networks_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_sourcing_networks_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`conditions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`conditions` (
  `id` INT NOT NULL ,
  `vacancy_id` INT NOT NULL ,
  `general_condition` INT NOT NULL ,
  `approximate_total_billing` FLOAT NOT NULL ,
  `comission` DOUBLE NOT NULL ,
  `warranty` INT NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_conditions_vacancies1_idx` (`vacancy_id` ASC) ,
  CONSTRAINT `fk_conditions_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`candidates`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`candidates` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `supplier_user_id` INT NOT NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `profile` VARCHAR(255) NOT NULL ,
  `resume` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `code` VARCHAR(45) NOT NULL ,
  `is_active` TINYINT NULL ,
  `accept_terms_cond` TINYINT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_candidates_users1_idx` (`supplier_user_id` ASC) ,
  CONSTRAINT `fk_candidates_users1`
    FOREIGN KEY (`supplier_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancy_logs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancy_logs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `vacancy_id` INT NOT NULL ,
  `candidate_id` INT NULL ,
  `name` VARCHAR(45) NULL ,
  `description` VARCHAR(45) NULL ,
  `positions_number` INT NULL ,
  `scheme` VARCHAR(45) NULL ,
  `responsabilities` VARCHAR(45) NULL ,
  `experience` VARCHAR(45) NULL ,
  `language` VARCHAR(45) NULL ,
  `file` VARCHAR(45) NULL ,
  `key_points` VARCHAR(45) NULL ,
  `minimum_salary` DOUBLE NULL ,
  `maximum_salary` DOUBLE NULL ,
  `career_plan` VARCHAR(45) NULL ,
  `contract_type` VARCHAR(45) NULL ,
  `sharing` VARCHAR(45) NULL ,
  `address_id` INT NULL ,
  `vacancy_status_id` INT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vacancy_logs_vacancies1_idx` (`vacancy_id` ASC) ,
  INDEX `fk_vacancy_logs_candidates1_idx` (`candidate_id` ASC) ,
  CONSTRAINT `fk_vacancy_logs_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancy_logs_candidates1`
    FOREIGN KEY (`candidate_id` )
    REFERENCES `mydb`.`candidates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancy_candidates`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancy_candidates` (
  `id` INT NOT NULL ,
  `vacancy_id` INT NOT NULL ,
  `candidate_id` INT NOT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_vacancy_candidates_vacancies1_idx` (`vacancy_id` ASC) ,
  INDEX `fk_vacancy_candidates_candidates1_idx` (`candidate_id` ASC) ,
  CONSTRAINT `fk_vacancy_candidates_vacancies1`
    FOREIGN KEY (`vacancy_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancy_candidates_candidates1`
    FOREIGN KEY (`candidate_id` )
    REFERENCES `mydb`.`candidates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`comments` (
  `id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `vacancy_candidate_id` INT NOT NULL ,
  `comment` VARCHAR(255) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_vacancy_candidates1_idx` (`vacancy_candidate_id` ASC) ,
  INDEX `fk_comments_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_comments_vacancy_candidates1`
    FOREIGN KEY (`vacancy_candidate_id` )
    REFERENCES `mydb`.`vacancy_candidates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`testimonial_status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`testimonial_status` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`testimonials`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`testimonials` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `recommended_user_id` INT NOT NULL ,
  `recommended_by_user_id` INT NOT NULL ,
  `testimony` TEXT NOT NULL ,
  `testimonial_status_id` INT NOT NULL ,
  `is_active` TINYINT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_testimonies_users1_idx` (`recommended_user_id` ASC) ,
  INDEX `fk_testimonies_users2_idx` (`recommended_by_user_id` ASC) ,
  INDEX `fk_testimonials_testimonials_status1_idx` (`testimonial_status_id` ASC) ,
  CONSTRAINT `fk_testimonies_users1`
    FOREIGN KEY (`recommended_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_testimonies_users2`
    FOREIGN KEY (`recommended_by_user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_testimonials_testimonials_status1`
    FOREIGN KEY (`testimonial_status_id` )
    REFERENCES `mydb`.`testimonial_status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`balances`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`balances` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `company_id` INT NOT NULL ,
  `credit` DOUBLE NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_company_balances_companies1_idx` (`company_id` ASC) ,
  CONSTRAINT `fk_company_balances_companies1`
    FOREIGN KEY (`company_id` )
    REFERENCES `mydb`.`companies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_experience_roles_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_experience_roles_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`industries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`industries` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_industries_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_industries_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sectors`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sectors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sectors_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_sectors_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`regions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`regions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_regions_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_regions_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`functional_areas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`functional_areas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `language_id` INT NOT NULL ,
  `value_id` INT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NOT NULL ,
  `deleted_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_functional_areas_languages1_idx` (`language_id` ASC) ,
  CONSTRAINT `fk_functional_areas_languages1`
    FOREIGN KEY (`language_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_regions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_regions` (
  `experience_id` INT NOT NULL ,
  `region_id` INT NOT NULL ,
  PRIMARY KEY (`experience_id`, `region_id`) ,
  INDEX `fk_experiences_has_regions_regions1_idx` (`region_id` ASC) ,
  INDEX `fk_experiences_has_regions_experiences1_idx` (`experience_id` ASC) ,
  CONSTRAINT `fk_experiences_has_regions_experiences1`
    FOREIGN KEY (`experience_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_has_regions_regions1`
    FOREIGN KEY (`region_id` )
    REFERENCES `mydb`.`regions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_sectors`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_sectors` (
  `experience_id` INT NOT NULL ,
  `sector_id` INT NOT NULL ,
  PRIMARY KEY (`experience_id`, `sector_id`) ,
  INDEX `fk_experiences_has_sectors_sectors1_idx` (`sector_id` ASC) ,
  INDEX `fk_experiences_has_sectors_experiences1_idx` (`experience_id` ASC) ,
  CONSTRAINT `fk_experiences_has_sectors_experiences1`
    FOREIGN KEY (`experience_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_has_sectors_sectors1`
    FOREIGN KEY (`sector_id` )
    REFERENCES `mydb`.`sectors` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_experiences_roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_experiences_roles` (
  `experience_roles_id` INT NOT NULL ,
  `experience_id` INT NOT NULL ,
  PRIMARY KEY (`experience_roles_id`, `experience_id`) ,
  INDEX `fk_experience_roles_has_experiences_experiences1_idx` (`experience_id` ASC) ,
  INDEX `fk_experience_roles_has_experiences_experience_roles1_idx` (`experience_roles_id` ASC) ,
  CONSTRAINT `fk_experience_roles_has_experiences_experience_roles1`
    FOREIGN KEY (`experience_roles_id` )
    REFERENCES `mydb`.`experience_roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experience_roles_has_experiences_experiences1`
    FOREIGN KEY (`experience_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_industries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_industries` (
  `experience_id` INT NOT NULL ,
  `industrie_id` INT NOT NULL ,
  PRIMARY KEY (`experience_id`, `industrie_id`) ,
  INDEX `fk_experiences_has_industries_industries1_idx` (`industrie_id` ASC) ,
  INDEX `fk_experiences_has_industries_experiences1_idx` (`experience_id` ASC) ,
  CONSTRAINT `fk_experiences_has_industries_experiences1`
    FOREIGN KEY (`experience_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_has_industries_industries1`
    FOREIGN KEY (`industrie_id` )
    REFERENCES `mydb`.`industries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_functional_areas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_functional_areas` (
  `experience_id` INT NOT NULL ,
  `functional_area_id` INT NOT NULL ,
  PRIMARY KEY (`experience_id`, `functional_area_id`) ,
  INDEX `fk_experiences_has_functional_areas_functional_areas1_idx` (`functional_area_id` ASC) ,
  INDEX `fk_experiences_has_functional_areas_experiences1_idx` (`experience_id` ASC) ,
  CONSTRAINT `fk_experiences_has_functional_areas_experiences1`
    FOREIGN KEY (`experience_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_has_functional_areas_functional_areas1`
    FOREIGN KEY (`functional_area_id` )
    REFERENCES `mydb`.`functional_areas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`experience_sourcing_networks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`experience_sourcing_networks` (
  `experiences_id` INT NOT NULL ,
  `sourcing_networks_id` INT NOT NULL ,
  PRIMARY KEY (`experiences_id`, `sourcing_networks_id`) ,
  INDEX `fk_experiences_has_sourcing_networks_sourcing_networks1_idx` (`sourcing_networks_id` ASC) ,
  INDEX `fk_experiences_has_sourcing_networks_experiences1_idx` (`experiences_id` ASC) ,
  CONSTRAINT `fk_experiences_has_sourcing_networks_experiences1`
    FOREIGN KEY (`experiences_id` )
    REFERENCES `mydb`.`experiences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiences_has_sourcing_networks_sourcing_networks1`
    FOREIGN KEY (`sourcing_networks_id` )
    REFERENCES `mydb`.`sourcing_networks` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`migrations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`migrations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `migration` VARCHAR(255) NOT NULL ,
  `batch` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancy_languages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`vacancy_languages` (
  `vacancies_id` INT NOT NULL ,
  `languages_id` INT NOT NULL ,
  PRIMARY KEY (`vacancies_id`, `languages_id`) ,
  INDEX `fk_vacancies_has_languages_languages1` (`languages_id` ASC) ,
  INDEX `fk_vacancies_has_languages_vacancies1` (`vacancies_id` ASC) ,
  CONSTRAINT `fk_vacancies_has_languages_vacancies1`
    FOREIGN KEY (`vacancies_id` )
    REFERENCES `mydb`.`vacancies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacancies_has_languages_languages1`
    FOREIGN KEY (`languages_id` )
    REFERENCES `mydb`.`languages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sessions` (
  `id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `ip_address` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `user_agent` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `payload` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `last_activity` INT(11) NOT NULL ,
  UNIQUE INDEX `sessions_id_unique` (`id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`settings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`settings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `key` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `value` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `settings_key_index` (`key` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`password_resets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`password_resets` (
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  INDEX `password_resets_email_index` (`email` ASC) ,
  INDEX `password_resets_token_index` (`token` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`user_activity`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user_activity` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `description` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `ip_address` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `user_agent` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_user_activity_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_activity_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`social_logins`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`social_logins` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `provider` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `provider_id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `avatar` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_social_logins_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_social_logins_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`user_social_networks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user_social_networks` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `facebook` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `twitter` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `google_plus` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `linked_in` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `dribbble` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `skype` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_user_social_networks_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_user_social_networks_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`points`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`points` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `sum` FLOAT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_scores_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_scores_users10`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
