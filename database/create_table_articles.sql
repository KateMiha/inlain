CREATE TABLE `inlain`.`articles`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `title` VARCHAR(225) NOT NULL,
    `body` TEXT(2500) NOT NULL,
    PRIMARY KEY (`id`)
);