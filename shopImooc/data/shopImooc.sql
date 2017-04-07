CREATE DATABASE IF NOT EXISTS `shopImooc`;
USE  `shopImooc`;
--管理员表
DROP TABLE IF EXISTS `imooc_admin`;
CREATE TABLE `imooc_admin`(
  `id` TINYINT unsigned auto_increment KEY,
  `username` VARCHAR(20) NOT NULL UNIQUE,
  `password` CHAR(32) NOT NULL,
  `email` VARCHAR(50) NOT NULL
);
--商品表
DROP TABLE IF EXISTS `imooc_pro`;
CREATE TABLE `imooc_pro`(
  `id` INT unsigned auto_increment KEY,
  `pName` VARCHAR(50) NOT NULL UNIQUE,
  `pSn` VARCHAR(50) NOT NULL,
  `pNum` INT unsigned DEFAULT 1,
  `mPrice` DECIMAL(10, 2) NOT NULL,
  `iPrice` DECIMAL(10, 2) NOT NULL,
  `pDesc` text,
  `pImg` VARCHAR(50) NOT NULL,
  `pubTime` INT unsigned NOT NULL,
  `isShow` TINYINT(1) DEFAULT 1,
  `isHot` TINYINT(1) DEFAULT 0,
  `cId` SMALLINT unsigned NOT NULL 
);
--用户表
DROP TABLE IF EXISTS `imooc_user`;
CREATE TABLE `imooc_user`(
  `id` INT unsigned auto_increment KEY,
  `username` VARCHAR(20) NOT NULL UNIQUE,
  `password` CHAR(32) NOT NULL,
  `sex` enum('男', '女', '保密') NOT NULL DEFAULT '保密',
  `face` VARCHAR(50) NOT NULL,
  `regTime` INT unsigned NOT NULL
);
--相册表
DROP TABLE IF EXISTS `imooc_album`;
CREATE TABLE `imooc_album`(
  `id` INT unsigned auto_increment KEY,
  `pId` INT unsigned NOT NULL,
  `albumPath` VARCHAR(50) NOT NULL
);
