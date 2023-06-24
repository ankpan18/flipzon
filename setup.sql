-- drop database if exists Flipzon;
create database if not exists Flipzon;
use Flipzon;

-- -- id
-- create table if not exists `id`(
--     `id` varchar(50) not null,
--     -- `role` ENUM ('user','seller','admin') not null,
--     `role` varchar(50) not null,
--     PRIMARY KEY(`id`,`role`)
-- );


-- user table
create table if not exists `user`(
    `id` varchar(50) PRIMARY KEY,
    `password` varchar(70) not null
);


-- admin table
create table if not exists `admin`(
    `id` varchar(50) PRIMARY KEY,
    `password` varchar(70) not null
);

-- seller table
create table if not exists `seller`(
    `id` varchar(50) PRIMARY KEY,
    `name` varchar(50) not null,
    `password` varchar(70) not null
);


-- product table
drop table `order`;
-- drop table `product`;
create table if not exists `product`(
    `id` varchar(50) PRIMARY KEY,
    `name` varchar(50) not null,
    `desc` varchar(100) not null,
    `seller_id` varchar(50) not null,
    `price` varchar(50) not null,
    `image` varchar(30) not null,
    FOREIGN KEY(`seller_id`) REFERENCES `seller`(`id`)

);

-- order table
create table if not exists `order`(
    `user_id` varchar(50) not null,
    `product_id` varchar(50) not null,
    `incartonly` char(1) not null,
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);

-- -- session table
-- create table if not exists `session`(
--     `id` varchar(50) not null,
--     `role` varchar(50) not null,
--     `session_token` varchar(70) not null,
--     `expiry_time` timestamp not null,
--     PRIMARY KEY(`id`,`role`),
--     FOREIGN KEY (`id`,`role`) REFERENCES `id`(`id`,`role`)
-- );

