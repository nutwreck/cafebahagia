/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL-PC-XAMPP-PHP8
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : cafe

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 14/05/2023 17:43:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akses
-- ----------------------------
DROP TABLE IF EXISTS `akses`;
CREATE TABLE `akses`  (
  `id_akses` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level_akses` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akses
-- ----------------------------
INSERT INTO `akses` VALUES (1, 'admin', 'Administrator');
INSERT INTO `akses` VALUES (2, 'kasir', 'Staff Kasir');
INSERT INTO `akses` VALUES (3, 'inventory', 'Staff Inventory');
INSERT INTO `akses` VALUES (4, 'keuangan', 'Staff Keuangan');

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions`  (
  `id` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('1a62294a8be5a1c2aa44e99a8731b8ab621c67d2', '::1', 1684058730, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343035353137323B61705F69645F757365727C733A313A2231223B61705F70617373776F72647C733A34303A2264303333653232616533343861656235363630666332313430616563333538353063346461393937223B61705F6E616D617C733A31313A2253757065722041646D696E223B61705F6C6576656C7C733A353A2261646D696E223B61705F6C6576656C5F63617074696F6E7C733A31333A2241646D696E6973747261746F72223B);
INSERT INTO `ci_sessions` VALUES ('660263d7d7a56b32156f8a884cab85ae7f54c484', '::1', 1684059071, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343035383738323B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);
INSERT INTO `ci_sessions` VALUES ('1771e0cb40a6c4317d4a2c09b3a8e654fef3b757', '::1', 1684059621, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343035393038393B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);
INSERT INTO `ci_sessions` VALUES ('5b23a63279ce9ff57e5ed3b854afedc82432909e', '::1', 1684059899, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343035393632333B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);
INSERT INTO `ci_sessions` VALUES ('e4a29fefd6854c2a5b4cf63ce390e4889fa68be2', '::1', 1684060365, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343036303030383B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);
INSERT INTO `ci_sessions` VALUES ('490f5e531f2f796dad467f251926cf40e25ff701', '::1', 1684060663, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343036303433363B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);
INSERT INTO `ci_sessions` VALUES ('78c43dbcb1092dbba89e89073d326060a97c4cfd', '::1', 1684060828, 0x5F5F63695F6C6173745F726567656E65726174657C693A313638343036303739363B61705F69645F757365727C733A313A2232223B61705F70617373776F72647C733A34303A2238363931653466633533623939646135343463653836653232616362613632643133333532656666223B61705F6E616D617C733A353A22496E646168223B61705F6C6576656C7C733A353A226B61736972223B61705F6C6576656C5F63617074696F6E7C733A31313A225374616666204B61736972223B);

-- ----------------------------
-- Table structure for kategori_produk
-- ----------------------------
DROP TABLE IF EXISTS `kategori_produk`;
CREATE TABLE `kategori_produk`  (
  `id_kategori_produk` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dihapus` enum('tidak','ya') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategori_produk`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori_produk
-- ----------------------------
INSERT INTO `kategori_produk` VALUES (1, 'Minuman', 'tidak');
INSERT INTO `kategori_produk` VALUES (2, 'Makanan', 'tidak');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id_pelanggan` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `telp` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `info_tambahan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kode_unik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu_input` datetime NOT NULL,
  `dihapus` enum('tidak','ya') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (1, 'Candra', 'Pulo Asem', '085826045068', '', '16840449671', '2023-05-14 13:16:07', 'tidak');

-- ----------------------------
-- Table structure for penjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_detail`;
CREATE TABLE `penjualan_detail`  (
  `id_penjualan_d` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_penjualan_m` int UNSIGNED NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah_beli` smallint UNSIGNED NOT NULL,
  `harga_satuan` decimal(10, 0) NOT NULL,
  `total` decimal(10, 0) NOT NULL,
  PRIMARY KEY (`id_penjualan_d`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of penjualan_detail
-- ----------------------------
INSERT INTO `penjualan_detail` VALUES (1, 1, 9, 3, 8500, 25500);
INSERT INTO `penjualan_detail` VALUES (2, 1, 10, 5, 12500, 62500);
INSERT INTO `penjualan_detail` VALUES (3, 1, 11, 2, 17900, 35800);
INSERT INTO `penjualan_detail` VALUES (4, 2, 1, 10, 10500, 105000);
INSERT INTO `penjualan_detail` VALUES (5, 3, 11, 10, 17900, 179000);

-- ----------------------------
-- Table structure for penjualan_master
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_master`;
CREATE TABLE `penjualan_master`  (
  `id_penjualan_m` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_nota` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `grand_total` decimal(10, 0) NOT NULL,
  `bayar` decimal(10, 0) NOT NULL,
  `keterangan_lain` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_pelanggan` mediumint UNSIGNED NULL DEFAULT NULL,
  `id_user` mediumint UNSIGNED NOT NULL,
  PRIMARY KEY (`id_penjualan_m`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan_master
-- ----------------------------
INSERT INTO `penjualan_master` VALUES (1, '6460B2B15B62F2', '2023-05-14 12:06:41', 123800, 150000, '', 1, 2);
INSERT INTO `penjualan_master` VALUES (2, '6460B3D185C3C2', '2023-05-14 12:11:29', 105000, 110000, '', NULL, 2);
INSERT INTO `penjualan_master` VALUES (3, '6460B41F379362', '2023-05-14 12:12:47', 179000, 200000, 'lunas', NULL, 2);

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id_produk` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_produk` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_stok` mediumint UNSIGNED NOT NULL,
  `harga` decimal(10, 0) NOT NULL,
  `id_kategori_produk` mediumint UNSIGNED NOT NULL,
  `expired_date` date NOT NULL,
  `size` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dihapus` enum('tidak','ya') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_produk`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, 'CC890', 'Coca Cola', 1389, 10500, 1, '2024-05-16', 'Sedang', 'tidak');
INSERT INTO `produk` VALUES (2, 'CH780', 'Chitato', 735, 15500, 2, '2023-05-14', 'Besar', 'tidak');
INSERT INTO `produk` VALUES (10, 'KA561', 'Kacang Atom', 865, 12500, 2, '2025-05-10', '15 gr', 'tidak');
INSERT INTO `produk` VALUES (9, 'AA544', 'Fanta', 97, 8500, 1, '2024-12-12', 'Sedang', 'tidak');
INSERT INTO `produk` VALUES (8, 'AA543', 'Fanta', 100, 4500, 1, '2024-12-12', 'Kecil', 'tidak');
INSERT INTO `produk` VALUES (11, 'TA456', 'Taro', 478, 17900, 2, '2026-02-15', 'Besar', 'tidak');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_akses` tinyint(1) UNSIGNED NOT NULL,
  `status` enum('Aktif','Non Aktif') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dihapus` enum('tidak','ya') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Super Admin', 1, 'Aktif', 'tidak');
INSERT INTO `user` VALUES (2, 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'Indah', 2, 'Aktif', 'tidak');
INSERT INTO `user` VALUES (3, 'inventory', 'ec99b813fa064f7f7cfa1d35bc7cc3d743c61fd1', 'Mario', 3, 'Aktif', 'tidak');
INSERT INTO `user` VALUES (4, 'keuangan', '1f931595786f2f178358d0af5fe4d75eaee46819', 'Agung', 4, 'Aktif', 'tidak');

SET FOREIGN_KEY_CHECKS = 1;
