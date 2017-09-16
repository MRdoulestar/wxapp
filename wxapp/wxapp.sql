/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.44-0ubuntu0.14.04.1 : Database - wxapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wxapp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `wxapp`;

/*Table structure for table `admin` */

CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `md5_pass` varchar(255) NOT NULL,
  `level` int(4) NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`id`,`name`,`pass`,`md5_pass`,`level`,`login_time`) values (1,'root','123','202cb962ac59075b964b07152d234b70',1,'2017-07-22 13:01:47'),(2,'admin','123','202cb962ac59075b964b07152d234b70',2,'2017-07-22 13:01:13');

/*Table structure for table `alluser` */

CREATE TABLE `alluser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `alluser` */

insert  into `alluser`(`id`,`name`,`pass`,`level`) values (2,'root','123','1'),(3,'admin','123','2'),(30,'test','test','3');

/*Table structure for table `appdata` */

CREATE TABLE `appdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) NOT NULL,
  `app_firm` varchar(255) NOT NULL,
  `app_time` date NOT NULL,
  `app_img_url` varchar(255) NOT NULL,
  `app_statu` int(4) NOT NULL DEFAULT '0' COMMENT '未审核通过和不通过',
  `sub_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交审核时间',
  `chk_by` varchar(255) NOT NULL DEFAULT '0' COMMENT '审核人',
  `ext` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `appdata` */

insert  into `appdata`(`id`,`app_name`,`app_firm`,`app_time`,`app_img_url`,`app_statu`,`sub_time`,`chk_by`,`ext`) values (49,'小程序1','测试公司','2017-07-20','./img/ad3c2c5ce57e9eff5377f9ebad066de7',0,'2017-07-21 21:45:29','0',''),(50,'小程序2','测试公司','2017-07-21','./img/9c89ae99879dfa5e0342b4541898f85a',0,'2017-07-21 21:45:29','0',''),(51,'小程序3','测试公司','2017-07-11','./img/9003f7d4a519a22ef909537610ad1c42',0,'2017-07-21 21:45:30','0',''),(52,'小程序4','测试公司','2017-07-19','./img/24da082f4fa6dfb7e9ef5230bae7af0f',0,'2017-07-21 21:45:30','0',''),(53,'小程序5','测试公司','2017-07-21','./img/164a2ec2b62b056b94ce3410bbf4125c',0,'2017-07-21 21:45:30','0','');

/*Table structure for table `user` */

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `md5_pass` varchar(255) NOT NULL,
  `level` int(4) NOT NULL DEFAULT '3',
  `token` varchar(255) NOT NULL DEFAULT '0',
  `login_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`pass`,`md5_pass`,`level`,`token`,`login_time`) values (3,'test','test','098f6bcd4621d373cade4e832627b4f6',3,'d19cffb59b26ba9066735496f7de2d81','2017-07-22 12:34:28');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
