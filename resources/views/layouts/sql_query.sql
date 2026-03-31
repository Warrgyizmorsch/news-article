ALTER TABLE `categories` ADD `main_menu` TINYINT(4) NOT NULL AFTER `status`;

--manish 30-3-26
ALTER TABLE `articles` ADD `is_hero` TINYINT NULL DEFAULT '0' AFTER `is_breaking`;

--manish 31-3-26
ALTER TABLE `articles` ADD `pdf_file` TEXT NULL DEFAULT NULL AFTER `is_hero`;
ALTER TABLE `articles` ADD `section_id` INT NULL AFTER `category_id`;
ALTER TABLE `articles` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `articles` ADD `auther` VARCHAR(255) NULL DEFAULT NULL AFTER `pdf_file`;
ALTER TABLE `articles` ADD `auther_description` TEXT NULL DEFAULT NULL AFTER `auther`;
a