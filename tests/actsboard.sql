/*
 Navicat MySQL Data Transfer

 Source Server         : 腾讯云
 Source Server Type    : MySQL
 Source Server Version : 50556
 Source Host           : 123.207.35.163:3306
 Source Schema         : actsboard

 Target Server Type    : MySQL
 Target Server Version : 50556
 File Encoding         : 65001

 Date: 06/04/2018 19:51:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access_log
-- ----------------------------
DROP TABLE IF EXISTS `access_log`;
CREATE TABLE `access_log`  (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '操作者id',
  `access_type` tinyint(3) NOT NULL COMMENT '操作类型',
  `access_time` datetime NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for access_token
-- ----------------------------
DROP TABLE IF EXISTS `access_token`;
CREATE TABLE `access_token`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '是否是测试：1为成功，2为测试',
  `appid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of access_token
-- ----------------------------
INSERT INTO `access_token` VALUES (1, '8_1Neu862E1a-598sCp9jVEMFHro5_PMdo_sFStHpY6sc-ve4S-yykG4h65nVLoatv93dQeHru2RM3MQ2erVOLptYQOiveVjzuQ9HnPWH-hE_6GewlGMIB6HYUpIgGPGdAFACLC', '2018-04-06 19:49:58', 2, 'wxb569d7a3f448c503');

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_type` tinyint(3) NOT NULL COMMENT '活动类型',
  `name` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `validity_date` datetime NOT NULL,
  `create_time` datetime NOT NULL COMMENT '添加记录的时间',
  `apply_way` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `school` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '此条记录是否合法，0为合法，1为非法',
  `act_detail` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动内容',
  `create_user` int(11) NOT NULL COMMENT '此活动的记录添加者',
  `taglist` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动的便签：实习，讲座，~~~~',
  `activity_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动链接',
  `act_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (1, 1, '', '2018-04-05 00:00:00', '0000-00-00 00:00:00', '', '', 0, NULL, 0, NULL, NULL, NULL);
INSERT INTO `activities` VALUES (2, 1, '', '2018-04-19 00:00:00', '2018-03-08 00:00:00', '1', '1', 1, '', 1, '1', '1', NULL);
INSERT INTO `activities` VALUES (3, 1, '', '2018-04-10 20:29:55', '2018-04-04 09:34:11', '2', '2', 0, '', 2, '', '', NULL);
INSERT INTO `activities` VALUES (4, 1, '', '2018-04-10 20:29:55', '2018-04-04 09:34:41', '2', '2', 0, '', 2, '', '', NULL);
INSERT INTO `activities` VALUES (5, 1, '', '2018-04-10 20:29:55', '2018-04-04 09:36:08', '2', '2', 0, '', 2, '', '', '');
INSERT INTO `activities` VALUES (6, 1, '', '2018-04-10 20:29:55', '2018-04-04 09:36:41', '2', '2', 0, '', 2, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for activities_pic
-- ----------------------------
DROP TABLE IF EXISTS `activities_pic`;
CREATE TABLE `activities_pic`  (
  `id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `pic_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `litimg_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_group_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_permissions`;
CREATE TABLE `auth_group_permissions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_permission
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission`;
CREATE TABLE `auth_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `codename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_user
-- ----------------------------
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE `auth_user`  (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `realname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`auth_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_user_groups
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_groups`;
CREATE TABLE `auth_user_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for auth_user_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_user_permissions`;
CREATE TABLE `auth_user_user_permissions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for push_act_log
-- ----------------------------
DROP TABLE IF EXISTS `push_act_log`;
CREATE TABLE `push_act_log`  (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `status` tinyint(1) NOT NULL COMMENT '此条记录的状态，1为合法，2为不合法',
  `user_id` int(32) NOT NULL COMMENT '微信用户，openid或unionid',
  `user_id_type` tinyint(1) NOT NULL COMMENT '1为openid，2为unionid',
  `push_time` datetime NOT NULL COMMENT '推送时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0为黑名单用户，1为正常用户，',
  `openid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户的标识，对当前公众号唯一',
  `unionid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '全网唯一',
  `goupid` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户所在的分组ID',
  `nickname` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户的昵称',
  `remark` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公众号运营者对粉丝的备注',
  `user_type` tinyint(1) NULL DEFAULT NULL,
  `sex` tinyint(1) NOT NULL COMMENT '值为1时是男性，值为2时是女性，值为0时是未知',
  `country` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `headimgurl` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subscribe` tinyint(1) NOT NULL COMMENT '用户是否订阅.1为订阅，',
  `subscribe_time` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
  `subcribe_scene` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '返回用户关注的渠道来源',
  `tagid_list` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户被打上的标签ID列表',
  `qr_scene` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '二维码扫码场景（开发者自定义）',
  `qr_scene_str` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '二维码扫码场景描述（开发者自定义）',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_list
-- ----------------------------
DROP TABLE IF EXISTS `user_list`;
CREATE TABLE `user_list`  (
  `id` int(11) NOT NULL,
  `openid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unionid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0为不启用，1为启用',
  `subscribe` tinyint(1) NOT NULL COMMENT '0为不订阅，1为订阅',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_push_rule
-- ----------------------------
DROP TABLE IF EXISTS `user_push_rule`;
CREATE TABLE `user_push_rule`  (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_type` tinyint(3) NULL DEFAULT NULL,
  `push_frequency` int(5) NULL DEFAULT NULL COMMENT '推送频率',
  `school` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `taglist` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动的便签：实习，讲座，~~~~',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for wait_push_acts
-- ----------------------------
DROP TABLE IF EXISTS `wait_push_acts`;
CREATE TABLE `wait_push_acts`  (
  `id` int(11) NOT NULL,
  `push_user` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '待推送的用户id',
  `user_type` tinyint(1) NOT NULL,
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `push_time` datetime NOT NULL COMMENT '推送的详细时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
