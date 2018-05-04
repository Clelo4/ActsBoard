/*
 Navicat MySQL Data Transfer

 Source Server         : 腾讯云
 Source Server Type    : MySQL
 Source Server Version : 50556
 Source Host           : 123.207.35.163:3306
 Source Schema         : actsboard_test

 Target Server Type    : MySQL
 Target Server Version : 50556
 File Encoding         : 65001

 Date: 04/05/2018 16:03:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access_openid
-- ----------------------------
DROP TABLE IF EXISTS `access_openid`;
CREATE TABLE `access_openid`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for access_token
-- ----------------------------
DROP TABLE IF EXISTS `access_token`;
CREATE TABLE `access_token`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '是否是测试：1不是测试，2为测试',
  `appid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for act_tag_type
-- ----------------------------
DROP TABLE IF EXISTS `act_tag_type`;
CREATE TABLE `act_tag_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tag` tinyint(1) NOT NULL,
  `valid_date` datetime NOT NULL,
  `school` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(1) NOT NULL COMMENT '判断活动是否被删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 215 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '活動唯一id',
  `valid_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '此条记录是否合法，1为合法，0为非法',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '活动类型',
  `create_time` datetime NOT NULL COMMENT '添加记录的时间',
  `apply_way` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `school` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `act_detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动内容',
  `create_user` int(11) NOT NULL COMMENT '此活动的记录添加者',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动链接',
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `pic_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动原图url',
  `litimg_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动缩略图url',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 104 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for activities_pic
-- ----------------------------
DROP TABLE IF EXISTS `activities_pic`;
CREATE TABLE `activities_pic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `litimg_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
-- Table structure for auth_login_log
-- ----------------------------
DROP TABLE IF EXISTS `auth_login_log`;
CREATE TABLE `auth_login_log`  (
  `id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `login_time` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
  `group_id` int(8) NOT NULL DEFAULT 10 COMMENT '用户组，默认10',
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `realname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nickname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称，唯一',
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `date_joined` datetime NOT NULL COMMENT '账户创建时间',
  `last_login` datetime NULL DEFAULT NULL COMMENT '最后一次登录时间',
  `islock` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否锁定，0为不锁定，1为锁定',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '\'状态-用于软删除\'，0为删除，1为不删除',
  PRIMARY KEY (`auth_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
-- Table structure for jsapi_ticket
-- ----------------------------
DROP TABLE IF EXISTS `jsapi_ticket`;
CREATE TABLE `jsapi_ticket`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jsapi_ticket` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'jsapi_ticket',
  `type` tinyint(1) NOT NULL COMMENT '是否是测试：1为成功，2为测试',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
-- Table structure for system_log
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log`  (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '操作者id',
  `access_type` tinyint(3) NOT NULL COMMENT '操作类型',
  `access_time` datetime NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for taglist
-- ----------------------------
DROP TABLE IF EXISTS `taglist`;
CREATE TABLE `taglist`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `tag` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'tag名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '1正常用户，0为为黑名单用户，',
  `openid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户的标识，对当前公众号唯一',
  `unionid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '全网唯一',
  `groupid` int(11) NOT NULL COMMENT '用户所在的分组ID',
  `user_type` tinyint(1) NULL DEFAULT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户的昵称',
  `remark` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公众号运营者对粉丝的备注',
  `sex` tinyint(1) NOT NULL COMMENT '值为1时是男性，值为2时是女性，值为0时是未知',
  `country` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `language` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `headimgurl` varchar(8190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户微信头像url',
  `subscribe` tinyint(1) NOT NULL COMMENT '用户是否订阅.1为订阅，',
  `subscribe_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
  `subscribe_scene` varbinary(20) NOT NULL COMMENT '返回用户关注的渠道来源',
  `tagid_list` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户被打上的标签ID列表',
  `qr_scene` tinyint(1) NOT NULL COMMENT '二维码扫码场景（开发者自定义）',
  `qr_scene_str` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '二维码扫码场景描述（开发者自定义）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_push_rule
-- ----------------------------
DROP TABLE IF EXISTS `user_push_rule`;
CREATE TABLE `user_push_rule`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `frequency` tinyint(1) NOT NULL COMMENT '推送频率',
  `school` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `taglist` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动的便签：实习，讲座，~~~~',
  `type` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_push_time` datetime NOT NULL COMMENT '最后一次推送的时间',
  `subscribe` tinyint(1) NOT NULL COMMENT '是否关注',
  `interest_tag_1` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_2` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_3` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_4` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_5` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_6` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_7` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_8` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_9` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_10` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_11` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_12` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_13` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_14` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_15` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 66 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
