create database api;

USE api;

CREATE TABLE api.`garages`
(
    `garage_id`     int(11) NOT NULL AUTO_INCREMENT,
    `name`          varchar(255)   NOT NULL,
    `owner`         varchar(255)   NOT NULL,
    `hourly_price`  decimal(10, 2) NOT NULL,
    `currency`      varchar(10)        NOT NULL,
    `contact_email` varchar(255)   NOT NULL,
    `country`       varchar(255)   NOT NULL,
    `latitude`      decimal(11, 8) NOT NULL,
    `longitude`     decimal(11, 8) NOT NULL,
    PRIMARY KEY (`garage_id`),
    KEY             `idx_country` (`country`),
    KEY             `idx_owner` (`owner`),
    KEY             `idx_location` (`latitude`,`longitude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `garages` (`name`, `owner`, `hourly_price`, `currency`, `contact_email`, `country`, `latitude`, `longitude`)
VALUES ('Garage1', 'AutoPark', 2.00, '€', 'testemail@testautopark.fi', 'Finland', 60.16860785, 24.93237107),
       ('Garage2', 'AutoPark', 1.50, '€', 'testemail@testautopark.fi', 'Finland', 60.16256200, 24.93945300),
       ('Garage3', 'AutoPark', 3.00, '€', 'testemail@testautopark.fi', 'Finland', 60.16444997, 24.93817817),
       ('Garage4', 'AutoPark', 3.00, '€', 'testemail@testautopark.fi', 'Finland', 60.16521936, 24.93537426),
       ('Garage5', 'AutoPark', 3.00, '€', 'testemail@testautopark.fi', 'Finland', 60.17167429, 24.92158566),
       ('Garage6', 'Parkkitalo OY', 2.00, '€', 'testemail@testgarage.fi', 'Finland', 60.16867390, 24.93016295);
