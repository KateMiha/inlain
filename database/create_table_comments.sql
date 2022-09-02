CREATE TABLE `inlain`.`comments`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `postId` INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `body` TEXT(800) NOT NULL,
    PRIMARY KEY (`id`)
);