SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, '首页', 'fa-bar-chart', '/', NULL, '2018-09-10 13:35:09');
INSERT INTO `admin_menu` VALUES (2, 0, 2, '管理员', 'fa-tasks', NULL, NULL, '2018-09-10 13:34:55');
INSERT INTO `admin_menu` VALUES (3, 2, 3, '用户', 'fa-users', 'auth/users', NULL, '2018-09-10 13:33:57');
INSERT INTO `admin_menu` VALUES (4, 2, 4, '角色', 'fa-user', 'auth/roles', NULL, '2018-09-10 13:34:11');
INSERT INTO `admin_menu` VALUES (5, 2, 5, '权限', 'fa-ban', 'auth/permissions', NULL, '2018-09-10 13:34:25');
INSERT INTO `admin_menu` VALUES (6, 2, 6, '菜单', 'fa-bars', 'auth/menu', NULL, '2018-09-10 13:34:43');
INSERT INTO `admin_menu` VALUES (8, 0, 0, '项目管理', 'fa-bars', '/projects', '2018-09-08 04:35:21', '2018-09-08 04:35:21');
INSERT INTO `admin_menu` VALUES (9, 0, 0, '分类管理', 'fa-certificate', '/categories', '2018-09-08 06:35:25', '2018-09-08 06:35:25');
INSERT INTO `admin_menu` VALUES (10, 0, 0, '用户管理', 'fa-users', '/users', '2018-10-14 14:14:40', '2018-10-14 14:14:40');