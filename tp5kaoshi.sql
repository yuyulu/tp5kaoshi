/*
Navicat MySQL Data Transfer

Source Server         : yuyulu
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : tp5kaoshi

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2018-04-05 18:03:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'doyouknow', '1065673465@qq.com', '$2y$10$Gu3J4qH3DsxBxJWzR6d/pe9TbO9Xmsx4pyWKFdEtORfYfukjECG9O', '2UUSPTed8FTMzx2A', '2018-04-01 13:12:41', '2018-04-01 13:44:16');
INSERT INTO `users` VALUES ('2', 'iknow', '13193835328@qq.com', '$2y$10$fl9m0ae60imSLL7vEuwZV.UEAkc46uvjmLSpYE0W2IOByYsD7Qkl.', 'DrW6G5OilJdnb6EkjBj2aBrz3DhyM27i', '2018-04-01 13:13:44', '2018-04-01 13:16:30');
