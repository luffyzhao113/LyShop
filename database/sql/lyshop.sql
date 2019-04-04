/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : localhost:3306
 Source Schema         : lyshop

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 04/04/2019 14:58:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for authorities
-- ----------------------------
DROP TABLE IF EXISTS `authorities`;
CREATE TABLE `authorities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `uri` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限Uri',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '权限描述',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `Unique_method_uri`(`uri`) USING BTREE COMMENT '请求'
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of authorities
-- ----------------------------
INSERT INTO `authorities` VALUES (7, '获取后台用户列表', 'user.index', '获取后台用户列表', '2019-04-03 03:15:12', '2019-04-03 03:15:12');
INSERT INTO `authorities` VALUES (8, '添加后台用户', 'user.store', '添加后台用户', '2019-04-03 03:15:33', '2019-04-03 03:15:33');
INSERT INTO `authorities` VALUES (9, '修改后台用户', 'user.update', '修改后台用户', '2019-04-03 03:15:53', '2019-04-03 03:15:53');
INSERT INTO `authorities` VALUES (10, '获取后台菜单列表', 'menu.index', '获取后台菜单列表', '2019-04-03 03:20:23', '2019-04-03 03:20:23');
INSERT INTO `authorities` VALUES (11, '添加后台菜单', 'menu.store', '添加后台菜单', '2019-04-03 03:20:43', '2019-04-03 03:20:43');
INSERT INTO `authorities` VALUES (12, '修改后台菜单', 'menu.update', '修改后台菜单', '2019-04-03 03:21:01', '2019-04-03 03:21:01');
INSERT INTO `authorities` VALUES (13, '删除后台菜单', 'menu.destroy', '删除后台菜单', '2019-04-03 03:21:31', '2019-04-03 03:21:31');
INSERT INTO `authorities` VALUES (14, '获取后台权限列表', 'authority.index', '获取后台权限列表', '2019-04-03 03:23:21', '2019-04-03 03:23:21');
INSERT INTO `authorities` VALUES (15, '添加后台权限', 'authority.store', '添加后台权限', '2019-04-03 03:23:49', '2019-04-03 03:23:49');
INSERT INTO `authorities` VALUES (16, '修改后台权限', 'authority.update', '修改后台权限', '2019-04-03 03:24:44', '2019-04-03 03:24:44');
INSERT INTO `authorities` VALUES (17, '删除后台权限', 'authority.destroy', '删除后台权限', '2019-04-03 03:25:02', '2019-04-03 03:25:02');
INSERT INTO `authorities` VALUES (18, '获取后台部门列表', 'role.index', '获取后台部门列表', '2019-04-03 03:27:47', '2019-04-03 03:27:47');
INSERT INTO `authorities` VALUES (19, '添加后台部门', 'role.store', '添加后台部门', '2019-04-03 03:28:11', '2019-04-03 03:28:11');
INSERT INTO `authorities` VALUES (20, '修改后台部门', 'role.update', '修改后台部门', '2019-04-03 03:28:35', '2019-04-03 03:28:35');
INSERT INTO `authorities` VALUES (21, '删除后台部门', 'role.destroy', '删除后台部门', '2019-04-03 03:29:03', '2019-04-03 03:29:03');
INSERT INTO `authorities` VALUES (22, '获取菜单所关联权限', 'role.menu_authority', '部门添加和修改时获取菜单所关联权限', '2019-04-03 08:05:31', '2019-04-03 08:05:31');

-- ----------------------------
-- Table structure for menu_authority
-- ----------------------------
DROP TABLE IF EXISTS `menu_authority`;
CREATE TABLE `menu_authority`  (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `authority_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`menu_id`, `authority_id`) USING BTREE,
  INDEX `menu_authority_authority_id`(`authority_id`) USING BTREE,
  CONSTRAINT `menu_authority_authority_id` FOREIGN KEY (`authority_id`) REFERENCES `authorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_authority_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜单多对多权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_authority
-- ----------------------------
INSERT INTO `menu_authority` VALUES (7, 7);
INSERT INTO `menu_authority` VALUES (7, 8);
INSERT INTO `menu_authority` VALUES (7, 9);
INSERT INTO `menu_authority` VALUES (10, 10);
INSERT INTO `menu_authority` VALUES (10, 11);
INSERT INTO `menu_authority` VALUES (10, 12);
INSERT INTO `menu_authority` VALUES (10, 13);
INSERT INTO `menu_authority` VALUES (9, 14);
INSERT INTO `menu_authority` VALUES (9, 15);
INSERT INTO `menu_authority` VALUES (9, 16);
INSERT INTO `menu_authority` VALUES (9, 17);
INSERT INTO `menu_authority` VALUES (8, 18);
INSERT INTO `menu_authority` VALUES (8, 19);
INSERT INTO `menu_authority` VALUES (8, 20);
INSERT INTO `menu_authority` VALUES (8, 21);
INSERT INTO `menu_authority` VALUES (8, 22);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单名称',
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单URL',
  `sort` tinyint(3) NULL DEFAULT 99 COMMENT '排序',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '权限描述',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '获取表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (5, 0, '首页', 'home', 1, '管理后台首页', '2019-04-03 02:47:33', '2019-04-03 02:47:33');
INSERT INTO `menus` VALUES (6, 0, '后台用户', 'authorities', 98, '后台用户管理', '2019-04-03 02:48:14', '2019-04-03 02:48:14');
INSERT INTO `menus` VALUES (7, 6, '用户管理', 'authorities.user', 1, '用户管理', '2019-04-03 02:48:40', '2019-04-03 02:48:40');
INSERT INTO `menus` VALUES (8, 6, '部门管理', 'authorities.role', 99, '部门管理', '2019-04-03 02:49:05', '2019-04-03 02:49:05');
INSERT INTO `menus` VALUES (9, 6, '权限管理', 'authorities.authority', 99, '权限管理', '2019-04-03 02:49:29', '2019-04-03 02:51:44');
INSERT INTO `menus` VALUES (10, 6, '菜单管理', 'authorities.menu', 99, '菜单管理', '2019-04-03 02:50:53', '2019-04-03 02:50:53');

-- ----------------------------
-- Table structure for role_authority
-- ----------------------------
DROP TABLE IF EXISTS `role_authority`;
CREATE TABLE `role_authority`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `authority_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `authority_id`) USING BTREE,
  INDEX `role_authority_authority_id`(`authority_id`) USING BTREE,
  CONSTRAINT `role_authority_authority_id` FOREIGN KEY (`authority_id`) REFERENCES `authorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_authority_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_authority
-- ----------------------------
INSERT INTO `role_authority` VALUES (9, 7);
INSERT INTO `role_authority` VALUES (9, 8);
INSERT INTO `role_authority` VALUES (9, 9);
INSERT INTO `role_authority` VALUES (9, 10);
INSERT INTO `role_authority` VALUES (9, 11);
INSERT INTO `role_authority` VALUES (9, 12);
INSERT INTO `role_authority` VALUES (9, 13);
INSERT INTO `role_authority` VALUES (9, 14);
INSERT INTO `role_authority` VALUES (9, 15);
INSERT INTO `role_authority` VALUES (9, 16);
INSERT INTO `role_authority` VALUES (9, 17);
INSERT INTO `role_authority` VALUES (9, 18);
INSERT INTO `role_authority` VALUES (9, 19);
INSERT INTO `role_authority` VALUES (9, 20);
INSERT INTO `role_authority` VALUES (9, 21);
INSERT INTO `role_authority` VALUES (9, 22);

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu`  (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`menu_id`, `role_id`) USING BTREE,
  INDEX `role_menu_role_id`(`role_id`) USING BTREE,
  CONSTRAINT `role_menu_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_menu_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_menu
-- ----------------------------
INSERT INTO `role_menu` VALUES (5, 9);
INSERT INTO `role_menu` VALUES (6, 9);
INSERT INTO `role_menu` VALUES (7, 9);
INSERT INTO `role_menu` VALUES (8, 9);
INSERT INTO `role_menu` VALUES (9, 9);
INSERT INTO `role_menu` VALUES (10, 9);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '权限描述',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (9, '超级管理员', '超级管理员', '2019-04-03 03:33:07', '2019-04-03 03:33:07');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '所属角色',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电话',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮件',
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `entryday` date NULL DEFAULT NULL COMMENT '入职日期',
  `sex` enum('man','women') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '性别',
  `status` enum('on','off') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '状态',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email`(`email`) USING BTREE,
  INDEX `user_role_id`(`role_id`) USING BTREE,
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 9, '苍老师1', '18620341552', 'cang@av.com', '$2y$10$1K1iVCZ0NzyCxAGu9EiXk.HfNXXp6U7n/gz4nTi2.7qK0sIzWotYW', '2019-04-01', '2018-04-03', 'women', 'off', '2019-04-03 07:34:28', '2019-04-03 07:39:01');

SET FOREIGN_KEY_CHECKS = 1;
