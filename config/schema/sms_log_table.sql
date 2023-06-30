CREATE TABLE IF NOT EXISTS `sms_logs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `phone` VARCHAR(15) NOT NULL,
    `message` VARCHAR(200) NOT NULL,
    `created` DATETIME NOT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
