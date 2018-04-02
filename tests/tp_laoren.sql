/*
 Navicat MySQL Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : tp_laoren

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 01/04/2018 21:57:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_access`;
CREATE TABLE `admin_access`  (
  `user_id` int(11) NULL DEFAULT NULL,
  `group_id` int(11) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_group
-- ----------------------------
DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rules` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pid` int(11) NULL DEFAULT NULL,
  `remark` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(3) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `pid` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '上级菜单ID',
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(127) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '链接地址',
  `icon` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '图标',
  `menu_type` tinyint(4) NULL DEFAULT NULL COMMENT '菜单类型',
  `sort` tinyint(4) UNSIGNED NULL DEFAULT 0 COMMENT '排序（同级有效）',
  `status` tinyint(4) NULL DEFAULT 1 COMMENT '状态',
  `rule_id` int(11) NULL DEFAULT NULL COMMENT '权限id',
  `module` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '三级菜单吗',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '【配置】后台菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_post
-- ----------------------------
DROP TABLE IF EXISTS `admin_post`;
CREATE TABLE `admin_post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '岗位名称',
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '岗位备注',
  `create_time` int(11) NULL DEFAULT NULL COMMENT '数据创建时间',
  `status` tinyint(5) NULL DEFAULT 1 COMMENT '状态1启用,0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '岗位表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_rule`;
CREATE TABLE `admin_rule`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '名称',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '定义',
  `level` tinyint(5) NULL DEFAULT NULL COMMENT '级别。1模块,2控制器,3操作',
  `pid` int(11) NULL DEFAULT 0 COMMENT '父id，默认0',
  `status` tinyint(3) NULL DEFAULT 1 COMMENT '状态，1启用，0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_structure
-- ----------------------------
DROP TABLE IF EXISTS `admin_structure`;
CREATE TABLE `admin_structure`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `pid` int(11) NULL DEFAULT 0,
  `status` tinyint(3) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理后台账号',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理后台密码',
  `remark` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户备注',
  `create_time` int(11) NULL DEFAULT NULL,
  `realname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '真实姓名',
  `structure_id` int(11) NULL DEFAULT NULL COMMENT '部门',
  `post_id` int(11) NULL DEFAULT NULL COMMENT '岗位',
  `status` tinyint(3) NULL DEFAULT NULL COMMENT '状态,1启用0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for log_normal
-- ----------------------------
DROP TABLE IF EXISTS `log_normal`;
CREATE TABLE `log_normal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` tinyint(5) NOT NULL COMMENT '1 老人、2药物、3物资、4员工、5系统设置、6财务',
  `msg` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `op_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人姓名',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lr_info_basic
-- ----------------------------
DROP TABLE IF EXISTS `lr_info_basic`;
CREATE TABLE `lr_info_basic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电话',
  `status` tinyint(3) NOT NULL COMMENT '状态，1为在院，2为回家，3广船、4外院，5退院',
  `birthday` date NOT NULL,
  `domicile` tinyint(2) NOT NULL COMMENT '户籍，1为广州，2为非广州	',
  `district` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '广州哪个区',
  `street` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '广州街道',
  `checkinday` date NOT NULL COMMENT '入住日期',
  `room` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房号',
  `specialrisk` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '重点病症',
  `freedom` tinyint(2) NOT NULL COMMENT '能否自由活动，1为可以，2为不可以',
  `mark` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '老人基本信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lr_info_medical
-- ----------------------------
DROP TABLE IF EXISTS `lr_info_medical`;
CREATE TABLE `lr_info_medical`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` date NOT NULL COMMENT '看护月份',
  `lr_id` int(11) NOT NULL,
  `level` tinyint(3) NOT NULL COMMENT '护理等级，1为一级护理，2为二级护理，3位三级护理	',
  `monthlypay_id` tinyint(5) NOT NULL COMMENT '月交费id',
  `needair` tinyint(2) NOT NULL COMMENT '空调费，1为需要，2为不需要',
  `needbed` tinyint(2) NOT NULL COMMENT '气垫费',
  `needtv` tinyint(2) NOT NULL COMMENT '电视费',
  `needhelp` tinyint(2) NOT NULL COMMENT '辅助行走',
  `needwash` tinyint(2) NOT NULL COMMENT '单独洗衣',
  `needallot` tinyint(2) NOT NULL COMMENT '派药费',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '老人医疗信息表（按月选择该月服务）' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lr_info_status
-- ----------------------------
DROP TABLE IF EXISTS `lr_info_status`;
CREATE TABLE `lr_info_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lr_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态，1为在院，2为回家，3广船、4外院，5退院',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '老人状态信息表（每天插入一次）' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lr_shop_record
-- ----------------------------
DROP TABLE IF EXISTS `lr_shop_record`;
CREATE TABLE `lr_shop_record`  (
  `id` int(11) NOT NULL,
  `lr_id` int(11) NOT NULL COMMENT '老人id	',
  `type_id` tinyint(5) NOT NULL COMMENT '1为物资消耗、2为药物消耗、3为零散可选月交费 、4为临时加插的费用、5为临时加插的退费',
  `use_time` timestamp(0) NULL DEFAULT NULL COMMENT '使用时间',
  `service_id` tinyint(5) NOT NULL DEFAULT 0 COMMENT '服务id，若 type_id =1，此id为物资id，否则为药物id、月交费id等，若为 4 5 则不需要这个 id',
  `service_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '项目名称',
  `num` tinyint(4) NOT NULL COMMENT '数量',
  `price_unit` decimal(10, 2) NOT NULL COMMENT '单价',
  `count` decimal(10, 2) NOT NULL COMMENT '总价',
  `create_time` timestamp(0) NULL DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `create_user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_time` timestamp(0) NULL DEFAULT NULL,
  `update_user_id` int(11) NOT NULL,
  `update_user_name` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '老人消费记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_info
-- ----------------------------
DROP TABLE IF EXISTS `staff_info`;
CREATE TABLE `staff_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staff_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '员工类型',
  `idcard` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idcard_pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` tinyint(2) NOT NULL COMMENT '性别 1男 2女',
  `birthday` date NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '状态，1为开启，2为关闭',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_laoren
-- ----------------------------
DROP TABLE IF EXISTS `staff_laoren`;
CREATE TABLE `staff_laoren`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `lr_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '员工老人看护关系表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for staff_laoren_extra
-- ----------------------------
DROP TABLE IF EXISTS `staff_laoren_extra`;
CREATE TABLE `staff_laoren_extra`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL COMMENT '员工id',
  `lr_id` int(11) NOT NULL,
  `date` date NOT NULL COMMENT '看护日期',
  `status` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1表示有效，2表示此记录无效',
  `create_user_id` int(11) NOT NULL,
  `create_user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建人姓名',
  `create_time` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '护工看护额外老人信息记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_status
-- ----------------------------
DROP TABLE IF EXISTS `staff_status`;
CREATE TABLE `staff_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL COMMENT '员工id',
  `date` date NOT NULL,
  `status` tinyint(5) NOT NULL COMMENT '1为休息（工作不需要记录）',
  `create_user_id` int(11) NOT NULL COMMENT '创建人id',
  `create_user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '员工状态信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_fee_goods
-- ----------------------------
DROP TABLE IF EXISTS `sys_fee_goods`;
CREATE TABLE `sys_fee_goods`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '单位',
  `left_num` int(11) NOT NULL DEFAULT 0 COMMENT '剩余数量',
  `format` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规格',
  `cost_price` decimal(9, 2) NOT NULL COMMENT '进货价',
  `sale_price` decimal(9, 2) NOT NULL COMMENT '售价',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '物资表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_fee_medical
-- ----------------------------
DROP TABLE IF EXISTS `sys_fee_medical`;
CREATE TABLE `sys_fee_medical`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `format` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bulk_unit` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `num_packege` smallint(5) NOT NULL,
  `left_num` int(11) NOT NULL COMMENT '散装数量 * 盒装数量',
  `cost_price` decimal(7, 2) NOT NULL,
  `sale_price` decimal(7, 2) NOT NULL,
  `bulk_cost_price` decimal(7, 2) NOT NULL,
  `bulk_sale_price` decimal(7, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '药物费用收费系统' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_fee_monthlypay
-- ----------------------------
DROP TABLE IF EXISTS `sys_fee_monthlypay`;
CREATE TABLE `sys_fee_monthlypay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(5) NOT NULL COMMENT '护理等级 1为一级护理，2为二级护理，3位三级护理',
  `room_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间类型',
  `fee` int(8) NOT NULL COMMENT '每月费用',
  `refund_perday` int(5) NOT NULL COMMENT '每天退费金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '院设置-老人月交费表（这部分费用为床位费、伙食费、服务费的集合体，因此有点特别）' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_fee_monthlypay_option
-- ----------------------------
DROP TABLE IF EXISTS `sys_fee_monthlypay_option`;
CREATE TABLE `sys_fee_monthlypay_option`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '项目名称',
  `fee_perday` decimal(6, 2) NOT NULL COMMENT '多少钱一天',
  `refund_perday` decimal(6, 2) NOT NULL COMMENT '每天退费金额',
  `roof` decimal(6, 2) NOT NULL COMMENT '封顶费用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '院设置-老人月交费表（可选）' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_fee_special
-- ----------------------------
DROP TABLE IF EXISTS `sys_fee_special`;
CREATE TABLE `sys_fee_special`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '试住费、一次性购置费-双人间、一次性购置费-三人间、一次性购置费-四人间、医疗押金、非广州户口费用',
  `fee` int(11) NOT NULL COMMENT '费用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '特别费用表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_room
-- ----------------------------
DROP TABLE IF EXISTS `sys_room`;
CREATE TABLE `sys_room`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间号',
  `room_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房间类型',
  `bed_num` tinyint(3) NOT NULL COMMENT '床位数',
  `sex` tinyint(2) NOT NULL COMMENT '性别 1为男，2为女',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '房间设置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `value` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '配置值',
  `group` tinyint(4) UNSIGNED NULL DEFAULT 0 COMMENT '配置分组',
  `need_auth` tinyint(4) NULL DEFAULT 1 COMMENT '1需要登录后才能获取，0不需要登录即可获取',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `参数名`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '【配置】系统配置表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
