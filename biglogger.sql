/*
 Navicat Premium Data Transfer

 Source Server         : bigloger
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : bigloger

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 24/05/2019 09:56:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `encode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_privilege` int(255) NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `id_privilege`(`id_privilege`) USING BTREE,
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`id_privilege`) REFERENCES `privilege` (`id_privilege`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'bigloggeradmin', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'giang', 'trường', 'truoggiag188@gmail.com', 1);
INSERT INTO `accounts` VALUES (2, 'tesst', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'abc', 'xyz', 'abcxyz@gmail.com', 2);
INSERT INTO `accounts` VALUES (3, 'truonggiang', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'big', 'loger', 'bigloger@gmail.com', 3);
INSERT INTO `accounts` VALUES (4, 'truoggiag199', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'giang', 'truong', '123456@gmail.com', 3);
INSERT INTO `accounts` VALUES (5, 'truoggiag1', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'truong', 'giang', 'safsdfsdf@gmail.com', 3);
INSERT INTO `accounts` VALUES (6, 'truoggiag2', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'truong', 'giang', 'safsdfsdf@gmail.com', 3);
INSERT INTO `accounts` VALUES (7, 'truoggiag3', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'abc', 'xyz', 'hsadfj@gmail.com', 3);
INSERT INTO `accounts` VALUES (8, 'truoggiag4', 'JDJ5JDEwJGFacG1VWVVVZkY2ZnF6VzhGT1ZBSHVUQW9RblF0NWZydjgvVlp1VlNrMktyTENFQTR4SGl5Y2Q3ZDBlZGE1M2JhZmE1MThhMGUxNzQzMGE0MjY3Nzk3YTAzY2NkZiQyeSQxMCRhWnBtVVlVVWZGNmZxelc4Rk9WQUh1VEFvUW5RdDVmcnY4L1ZadVZTazJLckxDRUE0eEhpeQ==', '$2y$10$aZpmUYUUfF6fqzW8FOVAHuTAoQnQt5frv8/VZuVSk2KrLCEA4xHiy', 'abcxyz', 'xyz', 'khjkjas2@gmail.com', 3);
INSERT INTO `accounts` VALUES (9, 'truonggiang1', 'JDJ5JDEwJDdYSjB3bkNyQmJ3MURrQ0NmRmI3Zi5pTjRMTkpMdEhEMGlyekVuNzZlUEZBNHE5OThYaWsuM2Q3ZDNlNzBkNmYyYTk5ZDEyYWJkODViYWIxMGE5ZmUxNWVlMWU3MyQyeSQxMCQ3WEowd25DckJidzFEa0NDZkZiN2YuaU40TE5KTHRIRDBpcnpFbjc2ZVBGQTRxOTk4WGlrLg==', '$2y$10$7XJ0wnCrBbw1DkCCfFb7f.iN4LNJLtHD0irzEn76ePFA4q998Xik.', 'hjsahf', 'ndsdfvhj', 'hshfj@gmail.com', 3);
INSERT INTO `accounts` VALUES (11, 'sondt', 'JDJ5JDEwJDdtRmhvVjNMR0t4bk80Y1ZxNy5Bai5wN0xnOFVnd0NjUzBjc0liTXAveHRSNkN3Z0EzZllDOTRhMmQ1M2ZlYWMzYzU2YTAyZTdkM2YzYjdlOWU2OTE1ZjgwZTJmZSQyeSQxMCQ3bUZob1YzTEdLeG5PNGNWcTcuQWoucDdMZzhVZ3dDY1MwY3NJYk1wL3h0UjZDd2dBM2ZZQw==', '$2y$10$7mFhoV3LGKxnO4cVq7.Aj.p7Lg8UgwCcS0csIbMp/xtR6CwgA3fYC', 'Dang', 'Son', 'sonmobi@gmail.com', 3);

-- ----------------------------
-- Table structure for privilege
-- ----------------------------
DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege`  (
  `id_privilege` int(255) NOT NULL AUTO_INCREMENT,
  `name_privilege` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_privilege`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of privilege
-- ----------------------------
INSERT INTO `privilege` VALUES (1, 'admin');
INSERT INTO `privilege` VALUES (2, 'nhân viên');
INSERT INTO `privilege` VALUES (3, 'khách hàng');

SET FOREIGN_KEY_CHECKS = 1;
