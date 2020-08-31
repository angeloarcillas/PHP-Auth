CREATE DATABASE db_auth;

CREATE TABLE `users` (
  `id` varchar(55) NOT NULL PRIMARY KEY,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logged_in` datetime DEFAULT NULL,
  `logged_out` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
);

CREATE TABLE `email_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(55) NOT NULL,
  `token` varchar(255) NOT NULL
);

CREATE TABLE `password_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(55) NOT NULL,
  `token` varchar(255) NOT NULL
);