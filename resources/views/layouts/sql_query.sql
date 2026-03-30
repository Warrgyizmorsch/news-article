ALTER TABLE `categories` ADD `main_menu` TINYINT(4) NOT NULL AFTER `status`;

--manish 30-3-26
ALTER TABLE `articles` ADD `is_hero` TINYINT NULL DEFAULT '0' AFTER `is_breaking`;

