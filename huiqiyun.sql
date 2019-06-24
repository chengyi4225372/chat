/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : huiqiyun

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-06-21 17:39:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hqy_member
-- ----------------------------
DROP TABLE IF EXISTS `hqy_member`;
CREATE TABLE `hqy_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shen` varchar(20) NOT NULL COMMENT '身份证',
  `tel` varchar(20) DEFAULT NULL COMMENT '手机号',
  `names` varchar(50) DEFAULT NULL COMMENT '姓名',
  `cates` varchar(50) DEFAULT NULL COMMENT '所属分类',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hqy_member
-- ----------------------------
INSERT INTO `hqy_member` VALUES ('1', '421125199004020312', '15678234455', '张无忌', '签约客户', '不顾骨灰级和', null);
INSERT INTO `hqy_member` VALUES ('2', '421125199004020312', '15678234223', '哈哈哈', '签约客户', 'SDBCHIACBIAdwjiacbsidbcidbuc', '1561103601');

-- ----------------------------
-- Table structure for hqy_protuct
-- ----------------------------
DROP TABLE IF EXISTS `hqy_protuct`;
CREATE TABLE `hqy_protuct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL COMMENT '项目标题',
  `money` decimal(11,3) unsigned NOT NULL COMMENT '金额',
  `cate_id` int(10) NOT NULL,
  `info` varchar(255) DEFAULT NULL COMMENT '需求',
  `person` varchar(40) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `paytype` int(4) unsigned DEFAULT NULL COMMENT '结算方式',
  `order_num` char(14) DEFAULT NULL COMMENT '订单编号',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hqy_protuct
-- ----------------------------

-- ----------------------------
-- Table structure for hyq_protuct_cate
-- ----------------------------
DROP TABLE IF EXISTS `hyq_protuct_cate`;
CREATE TABLE `hyq_protuct_cate` (
  `id` int(10) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hyq_protuct_cate
-- ----------------------------
