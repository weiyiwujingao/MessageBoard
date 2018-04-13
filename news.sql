/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : news

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-13 15:39:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `message_content`
-- ----------------------------
DROP TABLE IF EXISTS `message_content`;
CREATE TABLE `message_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '留言自增id',
  `user_id` int(5) NOT NULL COMMENT '用户id',
  `user_name` varchar(30) NOT NULL DEFAULT '0' COMMENT '用户名称',
  `content` varchar(255) NOT NULL COMMENT '发言内容',
  `parent` int(10) NOT NULL DEFAULT '0' COMMENT '0为留言 其他的为回复 为留言的自增id',
  `number` int(5) NOT NULL DEFAULT '0' COMMENT '回复评论的数量',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '文章发表时间',
  PRIMARY KEY (`id`),
  KEY `content` (`content`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='用户留言表 保存用户的发言和回复信息 author@colin ';


-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id自增主键',
  `user_name` varchar(30) NOT NULL COMMENT '用户名称',
  `user_sex` enum('2','1','0') DEFAULT '0' COMMENT '0未知，1男，2女',
  `user_password` varchar(40) DEFAULT '' COMMENT 'md5加密保存的密码',
  `user_email` varchar(20) DEFAULT NULL COMMENT 'email地址',
  `user_type` int(1) NOT NULL DEFAULT '2' COMMENT '1为管理员2位普通用户',
  `time` int(10) unsigned zerofill DEFAULT '0000000000' COMMENT '用户注册时间戳',
  PRIMARY KEY (`user_id`),
  KEY `username` (`user_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户表 保存用户的基础信息 author@colin ';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '0', '96e79218965eb72c92a549dd5a330112', 'admin@qq.com', '1', '0000000000');
