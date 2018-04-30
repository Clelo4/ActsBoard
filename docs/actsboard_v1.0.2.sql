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

 Date: 30/04/2018 17:01:45
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
-- Records of access_openid
-- ----------------------------
INSERT INTO `access_openid` VALUES (6, 'oKvv71cR-X-6BxWtCYfB2kqcQoQE', 'cdb70265932b5553a61ec22afc1b90b1');
INSERT INTO `access_openid` VALUES (8, 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ', 'db14e813685a9a335619923e61ba83aa');
INSERT INTO `access_openid` VALUES (9, 'oKvv71Z6zlzwh-LhpOPlRj1vVZvU', '1fc8df67c2501bfe6a462cc26777c083');

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
-- Records of access_token
-- ----------------------------
INSERT INTO `access_token` VALUES (1, '9_nhY7OCIr6s7dDAXPskDtSjhIh5Y9ZUiwlhPd_bjnX4dVCs03vnmP5UMmEHpabWO4W6svU5zfdBytFcHkNJsIOrdSd_eAwHYl7dwgm_WyJUYQHBfiSkT2PBWT9ZYVUAbAGAZYE', '2018-04-30 15:52:41', 2, 'wxb569d7a3f448c503');

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
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of act_tag_type
-- ----------------------------
INSERT INTO `act_tag_type` VALUES (88, '18112399576', '讲座', 10, '2018-05-01 23:59:59', '', 0);
INSERT INTO `act_tag_type` VALUES (89, '18112399576', '讲座', 11, '2018-05-01 23:59:59', '', 0);
INSERT INTO `act_tag_type` VALUES (90, '18112399576', '讲座', 12, '2018-05-01 23:59:59', '', 0);
INSERT INTO `act_tag_type` VALUES (94, '18119415112', '1231', 11, '2018-05-01 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (95, '18119415112', '1231', 10, '2018-05-01 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (96, '18109163289', '社团招新', 10, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (97, '18109163289', '社团招新', 9, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (98, '18109163289', '社团招新', 8, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (99, '18109163289', '社团招新', 7, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (100, '18109163289', '社团招新', 11, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (101, '18109163289', '社团招新', 12, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (102, '18109163289', '社团招新', 13, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (103, '18109163289', '社团招新', 14, '2018-05-03 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (104, '18114167188', '讲座', 10, '2018-05-01 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (105, '18114167188', '讲座', 9, '2018-05-01 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (106, '18114167188', '讲座', 8, '2018-05-01 23:59:59', '', 1);
INSERT INTO `act_tag_type` VALUES (107, '18114167188', '讲座', 11, '2018-05-01 23:59:59', '', 1);

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
  `pic_url` varchar(8190) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动原图url',
  `litimg_url` varchar(8190) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '活动缩略图url',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (27, '18101912698', '2019-02-01 23:59:59', 1, 'TEST_0', '社团招新', '2018-04-12 15:05:55', '1', '1', '', 2, NULL, '1', '', '');
INSERT INTO `activities` VALUES (28, '18101068128', '2018-06-21 23:59:59', 1, '11', '社团招新', '2018-04-12 15:08:28', '1', '1', '', 2, NULL, '1', '', '');
INSERT INTO `activities` VALUES (29, '18109008850', '2018-05-17 23:59:59', 1, '华南理工大学', '社团招新', '2018-04-20 15:34:24', NULL, '华南理工大学', '', 0, NULL, '华南理工大学', '', '');
INSERT INTO `activities` VALUES (30, '18109038820', '2018-04-28 23:59:59', 1, '华南理工大学222', '社团招新', '2018-04-20 15:40:50', NULL, '华南理工大学', '饭否非官方个个', 0, NULL, '华南理工大学', '', '');
INSERT INTO `activities` VALUES (31, '18109078510', '2018-04-28 23:59:59', 1, '华南1', '社团招新', '2018-04-20 15:44:31', NULL, '华南', '', 0, NULL, '华南', '', '');
INSERT INTO `activities` VALUES (32, '18109347373', '2018-04-27 23:59:59', 1, '华南2', '社团招新', '2018-04-20 15:45:28', '', '华南', '否登录', 0, NULL, '华南GGG', '', '');
INSERT INTO `activities` VALUES (33, '18109163289', '2018-05-03 23:59:59', 1, '百度他', '社团招新', '2018-04-30 14:16:23', NULL, '百度他', '', 0, NULL, '百度他', '', '');
INSERT INTO `activities` VALUES (34, '18109091177', '2018-04-29 23:59:59', 1, '华东', '社团招新', '2018-04-29 14:35:32', NULL, '华东', '11', 0, NULL, '华东', '', '');
INSERT INTO `activities` VALUES (35, '18110225820', '2018-04-29 23:59:59', 1, '百度', '社团招新', '2018-04-29 14:08:37', NULL, '百度', '', 0, NULL, '百度', '', '');
INSERT INTO `activities` VALUES (36, '18110445970', '2018-05-27 23:59:59', 1, '百步梯讲座', '社团招新', '2018-04-21 11:57:02', NULL, '华南理工大学', '', 0, NULL, '华南理工大学城A1', '', '');
INSERT INTO `activities` VALUES (37, '18112901586', '2018-05-01 23:59:59', 0, '华南理工大学讲座101', '社团招新', '2018-04-30 11:12:20', NULL, '华南理工大学', '佳作灯笼裤飞机过来发动进攻立法机关浪费大家两个房间个立方结构裂缝浪费国家法律机构了发过节费国家法律机构立法机关立法机关浪费福利国家法律机构立法机关立法机关发的发了过节费独立国家立法的结构裂缝', 0, NULL, '大学城', '', '');
INSERT INTO `activities` VALUES (38, '18112972090', '2018-05-02 23:59:59', 0, '苟富贵', '社团招新', '2018-04-23 13:57:34', NULL, '对方的', '打发打发', 0, NULL, '对方的', '', '');
INSERT INTO `activities` VALUES (39, '18112429334', '2018-05-03 23:59:59', 1, '风帆股份', '讲座', '2018-04-23 13:57:50', NULL, '反对反对', '的反对反对', 0, NULL, '大饭店', '', '');
INSERT INTO `activities` VALUES (40, '18112481084', '2018-04-26 23:59:59', 0, '大学城', '讲座', '2018-04-23 13:58:04', NULL, 'd反对反对d', '', 0, NULL, 'fd\'f\'d', '', '');
INSERT INTO `activities` VALUES (41, '18112032479', '2018-04-02 23:59:59', 1, 'a', '讲座', '2018-04-23 16:16:43', NULL, 'a', 'a', 0, NULL, 'a', '', '');
INSERT INTO `activities` VALUES (42, '18112898749', '2018-03-27 23:59:59', 1, 'qqqq', '讲座', '2018-04-23 16:17:16', NULL, 'q', 'q', 0, NULL, 'q', '', '');
INSERT INTO `activities` VALUES (43, '18112597644', '2018-05-02 23:59:59', 1, 'q', '讲座', '2018-04-23 16:17:24', NULL, 'q', 'q和嘎嘎嘎嘎嘎哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈活该哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈活该哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈和q和嘎嘎嘎嘎嘎哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈咯哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈活该哈哈哈', 0, NULL, 'q', '', '');
INSERT INTO `activities` VALUES (44, '18112167108', '2018-04-30 23:59:59', 0, '测试活动1', '讲座', '2018-04-30 03:14:14', NULL, '学校1', '内容1', 0, NULL, '地点1', '', '');
INSERT INTO `activities` VALUES (45, '18112399576', '2018-05-01 23:59:59', 0, 'd', '讲座', '2018-04-30 13:47:44', NULL, '1', '1', 0, NULL, '1', '', '');
INSERT INTO `activities` VALUES (46, '18112064968', '2018-04-23 23:59:59', 1, '“湖南科技学院”招聘宣讲', '讲座', '2018-04-23 23:46:42', NULL, '华南理工大学', '无', 0, NULL, '华工北就业指导中心一号报告厅', '', '');
INSERT INTO `activities` VALUES (47, '18112227644', '2018-05-14 23:59:59', 1, '寻找广州大学城国民男神', '讲座', '2018-04-23 23:49:07', NULL, '华南理工大学', '无', 0, NULL, '待定', '', '');
INSERT INTO `activities` VALUES (48, '18114167188', '2018-05-01 23:59:59', 1, '活动1', '讲座', '2018-04-30 14:40:45', NULL, '华南理工大学', '方法', 0, NULL, '大学城', '', '');
INSERT INTO `activities` VALUES (49, '18114386282', '2018-04-30 23:59:59', 0, 'a', '公益', '2018-04-30 11:01:00', NULL, 'a', 'a', 0, NULL, 'a', '', '');
INSERT INTO `activities` VALUES (50, '18114765351', '2018-04-29 23:59:59', 1, 'a', '公益', '2018-04-25 11:52:33', NULL, 'a', 'a', 0, NULL, 'a', '', '');
INSERT INTO `activities` VALUES (70, '18119006297', '2018-05-05 23:59:59', 1, '华南理工大学', '讲座', '2018-04-30 11:17:32', NULL, '华南理工大学', '讲座', 11, '', '无', 'http://actsboard-1253442303.cos.ap-guangzhou.myqcloud.com/dir/11.txt', '');
INSERT INTO `activities` VALUES (71, '18119415112', '2018-05-01 23:59:59', 1, '123', '1231', '2018-04-30 13:48:15', NULL, '1231', '1313', 11, '', '31', '', '');
INSERT INTO `activities` VALUES (72, '18119858393', '2019-05-08 23:59:59', 1, 'Hello', '', '2018-04-30 15:02:30', NULL, '华南理工大学', '百度', 11, '', NULL, 'http://actsboard-1253442303.cos.ap-guangzhou.myqcloud.com/dir/11.txt', '');

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
-- Records of activities_pic
-- ----------------------------
INSERT INTO `activities_pic` VALUES (1, '12345678901', '1', '1');

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
-- Records of auth_user
-- ----------------------------
INSERT INTO `auth_user` VALUES (11, 10, 'test', 'd93a5def7511da3d0f2d171d9c344e91', NULL, NULL, '3149495317@qq.com', '17728104079', '2018-04-17 23:04:09', NULL, 0, 1);
INSERT INTO `auth_user` VALUES (12, 10, 'jack', 'd93a5def7511da3d0f2d171d9c344e91', NULL, NULL, '3149495317@qq.com', '17728104079', '2018-04-18 18:04:26', NULL, 1, 1);
INSERT INTO `auth_user` VALUES (13, 10, 'test1', 'c325548aeb62d63bd5bddcddc33fe096', NULL, NULL, '3149495317@qq.com', '17728104079', '2018-04-18 19:04:20', NULL, 1, 1);

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
-- Records of jsapi_ticket
-- ----------------------------
INSERT INTO `jsapi_ticket` VALUES (1, 'HoagFKDcsGMVCIY2vOjf9pgCtGjKlXoJ7yh4lHwIaguqxnlbQosqEZ6QAb5LVnf7SzYqNBpZl6KXUsfPg8aX4Q', 2, '2018-04-30 15:04:47');

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
-- Records of taglist
-- ----------------------------
INSERT INTO `taglist` VALUES (7, 1, '比赛');
INSERT INTO `taglist` VALUES (8, 1, '文娱');
INSERT INTO `taglist` VALUES (9, 1, '公益');
INSERT INTO `taglist` VALUES (10, 1, '运动');
INSERT INTO `taglist` VALUES (11, 1, '社团招新');
INSERT INTO `taglist` VALUES (12, 1, '讲座');
INSERT INTO `taglist` VALUES (13, 1, '企业宣讲');
INSERT INTO `taglist` VALUES (14, 1, '其他');

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (6, 1, 'oKvv71cR-X-6BxWtCYfB2kqcQoQE', NULL, 0, NULL, 'zekun', '', 1, '中国', '广东', '广州', 'zh_CN', 'http://thirdwx.qlogo.cn/mmopen/dPGibolJica5FGFEPibB6hVULsb0bcYLOrbPnibvfmic0E2BjdhldTFb8PRDaTibndhB3oI1hpqa3IicTjDcUf4wfh9x7YrERPrIoBn/132', 1, '0000-00-00 00:00:00', 0x4144445F5343454E455F50524F46494C455F4341, '', 0, '');
INSERT INTO `user` VALUES (7, 1, 'oKvv71Z6zlzwh-LhpOPlRj1vVZvU', NULL, 0, NULL, '许橼Yuán', '', 1, '印度尼西亚', '北苏拉威西', '', 'zh_CN', 'http://thirdwx.qlogo.cn/mmopen/ajNVdqHZLLDpuJiaGL9ZpubFibmQyia0ibBBAB9A92rUJgb0pbnJNIoTUx7fasbb2T8vO20Md7xksD6PZSTbqrmkEw/132', 1, '0000-00-00 00:00:00', 0x4144445F5343454E455F50524F46494C455F4341, '', 0, '');
INSERT INTO `user` VALUES (8, 1, 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ', NULL, 0, NULL, '程俊杰', '', 1, '中国', '广东', '广州', 'zh_CN', 'http://thirdwx.qlogo.cn/mmopen/iczw76LnQFF6D3iaGibNRGXia7JvRVIiaKHIa7ctvSeEZYAwbX8ficYhS8JdvxIcSdPCTqZVM2KycRX0yiaME7pg9BibO2JcPSKfzvQy/132', 0, '2018-04-29 17:33:06', 0x4144445F5343454E455F50524F46494C455F4341, '', 0, '');

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
  `interest_tag_1` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_2` tinyint(1) NULL DEFAULT NULL,
  `interest_tag_3` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_push_rule
-- ----------------------------
INSERT INTO `user_push_rule` VALUES (4, 'oKvv71Z6zlzwh-LhpOPlRj1vVZvU', 1, '华南理工大学', NULL, 'type', '2018-04-25 17:04:07', NULL, NULL, NULL);
INSERT INTO `user_push_rule` VALUES (6, 'oKvv71cR-X-6BxWtCYfB2kqcQoQE', 3, '华南理工大学', NULL, '比赛', '2018-04-25 17:27:42', NULL, NULL, NULL);
INSERT INTO `user_push_rule` VALUES (8, 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ', 3, '1', NULL, '', '0000-00-00 00:00:00', 12, 9, 14);

SET FOREIGN_KEY_CHECKS = 1;
