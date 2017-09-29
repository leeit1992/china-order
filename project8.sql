/*
 Navicat Premium Data Transfer

 Source Server         : Mamp
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : project8

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 09/29/2017 08:51:34 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `avt_banks`
-- ----------------------------
DROP TABLE IF EXISTS `avt_banks`;
CREATE TABLE `avt_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_user_name` varchar(255) DEFAULT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_banks`
-- ----------------------------
BEGIN;
INSERT INTO `avt_banks` VALUES ('1', 'Vietcombank', 'Le Trung Ha', '060967967', 'Dong Da'), ('2', 'Viettinbank', 'Le Trung Ha', '060967967', 'Hn');
COMMIT;

-- ----------------------------
--  Table structure for `avt_expenditure`
-- ----------------------------
DROP TABLE IF EXISTS `avt_expenditure`;
CREATE TABLE `avt_expenditure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `rest_payment` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_expenditure`
-- ----------------------------
BEGIN;
INSERT INTO `avt_expenditure` VALUES ('1', '9', '26224320', '80', '6556080', '2017-09-26 00:31:26', 'Thanh toán cho ??n hàng Custommer-HN-25-09-2017'), ('2', '5', '426732840', '100', '0', '2017-09-27 15:47:27', 'Thanh toán cho ??n hàng Admin-HN-21-09-2017');
COMMIT;

-- ----------------------------
--  Table structure for `avt_options`
-- ----------------------------
DROP TABLE IF EXISTS `avt_options`;
CREATE TABLE `avt_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(255) DEFAULT NULL,
  `option_value` longtext,
  `option_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_options`
-- ----------------------------
BEGIN;
INSERT INTO `avt_options` VALUES ('1', 'currency_rate', '3449', null);
COMMIT;

-- ----------------------------
--  Table structure for `avt_order_items`
-- ----------------------------
DROP TABLE IF EXISTS `avt_order_items`;
CREATE TABLE `avt_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_item_content` longtext,
  `order_item_quantity` int(11) DEFAULT NULL,
  `order_item_real_purchase` int(11) DEFAULT NULL,
  `order_item_status` tinyint(2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_item_seller` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_order_items`
-- ----------------------------
BEGIN;
INSERT INTO `avt_order_items` VALUES ('1', '{\"type\":\"taobao\",\"item_id\":\"541002697427\",\"item_price\":\"549\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i2\\/654519625\\/TB2PW4TyhhmpuFjSZFyXXcLdFXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"1\",\"color_size\":\";Tr\\u1ee5c Xanh Tr\\u1eafng \\u0110\\u01a1n s\\u1eafc;Ti\\u00eau chu\\u1ea9n ch\\u00ednh th\\u1ee9c\",\"comment\":\"Test\",\"data_value\":\"1627207:1156034360;5919063:6536025\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3409899514472\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?id=541002697427&toSite=main&skuId=3409899514472\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3270db0975\"}', '1', '0', '1', '5', null), ('2', '{\"type\":\"taobao\",\"item_id\":\"555312613403\",\"item_price\":\"39999\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i1\\/654519625\\/TB2KnWIaRUSMeJjy1zdXXaR3FXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"3\",\"color_size\":\";b\\u1ed9 nh\\u1edb 16G i7 1600 * 4 512 tr\\u1ea1ng th\\u00e1i r\\u1eafn * 2 1080-8GSLI\",\"comment\":\"test\",\"data_value\":\"1627207:281439983\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3427013909547\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?spm=a220o.1000855.1998025129.1.222d04b7GvP9mD&abtest=_AB-LR32-PR32&pvid=b938c36d-f4dd-4b12-afe9-4453c0c74dad&pos=1&abbucket=_AB-M32_B13&acm=03054.1003.1.1539344&id=555312613403&scm=1007.12144.81309.23864_0&skuId=3427013909547\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3273490409\"}', '3', '0', '1', '5', null), ('3', '{\"type\":\"taobao\",\"item_id\":\"541002697427\",\"item_price\":\"549\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i2\\/654519625\\/TB2PW4TyhhmpuFjSZFyXXcLdFXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"1\",\"color_size\":\";Tr\\u1ee5c Xanh Tr\\u1eafng \\u0110\\u01a1n s\\u1eafc;Ti\\u00eau chu\\u1ea9n ch\\u00ednh th\\u1ee9c\",\"comment\":\"Test\",\"data_value\":\"1627207:1156034360;5919063:6536025\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3409899514472\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?id=541002697427&toSite=main&skuId=3409899514472\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3270db0975\"}', '1', '0', '1', '6', null), ('4', '{\"type\":\"taobao\",\"item_id\":\"555312613403\",\"item_price\":\"39999\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i1\\/654519625\\/TB2KnWIaRUSMeJjy1zdXXaR3FXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"3\",\"color_size\":\";b\\u1ed9 nh\\u1edb 16G i7 1600 * 4 512 tr\\u1ea1ng th\\u00e1i r\\u1eafn * 2 1080-8GSLI\",\"comment\":\"test\",\"data_value\":\"1627207:281439983\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3427013909547\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?spm=a220o.1000855.1998025129.1.222d04b7GvP9mD&abtest=_AB-LR32-PR32&pvid=b938c36d-f4dd-4b12-afe9-4453c0c74dad&pos=1&abbucket=_AB-M32_B13&acm=03054.1003.1.1539344&id=555312613403&scm=1007.12144.81309.23864_0&skuId=3427013909547\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3273490409\"}', '3', '0', '1', '6', null), ('5', '{\"type\":\"taobao\",\"item_id\":\"541002697427\",\"item_price\":\"549\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i2\\/654519625\\/TB2PW4TyhhmpuFjSZFyXXcLdFXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"1\",\"color_size\":\";Tr\\u1ee5c Xanh Tr\\u1eafng \\u0110\\u01a1n s\\u1eafc;Ti\\u00eau chu\\u1ea9n ch\\u00ednh th\\u1ee9c\",\"comment\":\"Test\",\"data_value\":\"1627207:1156034360;5919063:6536025\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3409899514472\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?id=541002697427&toSite=main&skuId=3409899514472\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3270db0975\"}', '1', '1', '1', '7', null), ('6', '{\"type\":\"taobao\",\"item_id\":\"555312613403\",\"item_price\":\"39999\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i1\\/654519625\\/TB2KnWIaRUSMeJjy1zdXXaR3FXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"3\",\"color_size\":\";b\\u1ed9 nh\\u1edb 16G i7 1600 * 4 512 tr\\u1ea1ng th\\u00e1i r\\u1eafn * 2 1080-8GSLI\",\"comment\":\"test\",\"data_value\":\"1627207:281439983\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3427013909547\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?spm=a220o.1000855.1998025129.1.222d04b7GvP9mD&abtest=_AB-LR32-PR32&pvid=b938c36d-f4dd-4b12-afe9-4453c0c74dad&pos=1&abbucket=_AB-M32_B13&acm=03054.1003.1.1539344&id=555312613403&scm=1007.12144.81309.23864_0&skuId=3427013909547\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3273490409\"}', '3', '3', '1', '7', null), ('7', '{\"type\":\"taobao\",\"item_id\":\"541002697427\",\"item_price\":\"549\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i2\\/654519625\\/TB2PW4TyhhmpuFjSZFyXXcLdFXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"1\",\"color_size\":\";Tr\\u1ee5c Xanh Tr\\u1eafng \\u0110\\u01a1n s\\u1eafc;Ti\\u00eau chu\\u1ea9n ch\\u00ednh th\\u1ee9c\",\"comment\":\"Test\",\"data_value\":\"1627207:1156034360;5919063:6536025\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3409899514472\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?id=541002697427&toSite=main&skuId=3409899514472\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3270db0975\"}', '1', '1', '1', '8', null), ('8', '{\"type\":\"taobao\",\"item_id\":\"555312613403\",\"item_price\":\"39999\",\"item_image\":\"https:\\/\\/img.alicdn.com\\/imgextra\\/i1\\/654519625\\/TB2KnWIaRUSMeJjy1zdXXaR3FXa_!!654519625.jpg_430x430q90.jpg\",\"seller_name\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"seller_id\":\"<strong><font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">C\\u1eeda h\\u00e0ng h\\u00e0ng \\u0111\\u1ea7u c\\u1ee7a ASUS ASUS<\\/font><\\/font><\\/strong>\",\"quantity\":\"3\",\"color_size\":\";b\\u1ed9 nh\\u1edb 16G i7 1600 * 4 512 tr\\u1ea1ng th\\u00e1i r\\u1eafn * 2 1080-8GSLI\",\"comment\":\"test\",\"data_value\":\"1627207:281439983\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"outer_id\":\"3427013909547\",\"item_link\":\"https:\\/\\/detail.tmall.com\\/item.htm?spm=a220o.1000855.1998025129.1.222d04b7GvP9mD&abtest=_AB-LR32-PR32&pvid=b938c36d-f4dd-4b12-afe9-4453c0c74dad&pos=1&abbucket=_AB-M32_B13&acm=03054.1003.1.1539344&id=555312613403&scm=1007.12144.81309.23864_0&skuId=3427013909547\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c3273490409\"}', '3', '1', '1', '8', null), ('9', '{\"type\":\"taobao\",\"item_id\":\"38432642101\",\"item_price\":\"1100\",\"item_image\":\"\\/\\/gd3.alicdn.com\\/bao\\/uploaded\\/i3\\/721492295\\/TB2H.YEe80kpuFjSsziXXa.oVXa_!!721492295.jpg_600x600.jpg\",\"seller_name\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">H\\u00e0ng ho\\u00e1 h\\u00e1t Ai Lu<\\/font><\\/font>\",\"seller_id\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">H\\u00e0ng ho\\u00e1 h\\u00e1t Ai Lu<\\/font><\\/font>\",\"quantity\":\"1\",\"color_size\":\";B\\u1ea1c\",\"comment\":\"them con nay\",\"data_value\":\"B\\u1ea1c\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"item_link\":\"https:\\/\\/world.taobao.com\\/item\\/38432642101.htm?fromSite=main&spm=a21wu.241046-global.4691948847.5.533465dcMn52tN&scm=1007.15423.84311.100200300000005&pvid=f149bbba-0b52-4a7e-8bb3-740957781f63\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c8b7dc2cebb\"}', '1', '0', '1', '9', '<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Hàng hoá hát Ai Lu</font></font>'), ('10', '{\"type\":\"taobao\",\"item_id\":\"526030153025\",\"item_price\":\"5880\",\"item_image\":\"\\/\\/gd1.alicdn.com\\/bao\\/uploaded\\/i1\\/TB1xepdLpXXXXaYXpXXXXXXXXXX_!!0-item_pic.jpg_600x600.jpg\",\"seller_name\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">H\\u00e0ng ho\\u00e1 h\\u00e1t Ai Lu<\\/font><\\/font>\",\"seller_id\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">H\\u00e0ng ho\\u00e1 h\\u00e1t Ai Lu<\\/font><\\/font>\",\"quantity\":\"1\",\"comment\":\"hu la\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"item_link\":\"https:\\/\\/world.taobao.com\\/item\\/526030153025.htm?spm=a312a.7728556.2015080705.20.52bcb5aa5bwH0d&id=526030153025&scm=1007.12006.72291.i38432642101&pvid=f1c19d15-dbb9-4e0c-a74a-8086b020cabf\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c8b80e413cd\"}', '1', '0', '1', '9', '<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Hàng hoá hát Ai Lu</font></font>'), ('11', '{\"type\":\"taobao\",\"item_id\":\"545353381941\",\"item_price\":\"2280\",\"item_image\":\"https:\\/\\/gd3.alicdn.com\\/bao\\/uploaded\\/i3\\/380309067\\/TB22VNGcbRkpuFjSspmXXc.9XXa_!!380309067.jpg_600x600.jpg\",\"seller_name\":\"Gazi trong \\u0111\\u00f3\",\"seller_id\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">Gazi trong \\u0111\\u00f3<\\/font><\\/font>\",\"quantity\":\"1\",\"color_size\":\";G\\u00f3i 2 (Little Bull)\",\"comment\":\"haha\",\"data_value\":\"G\\u00f3i 2 (Little Bull)\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"item_link\":\"https:\\/\\/world.taobao.com\\/item\\/545353381941.htm?fromSite=main&spm=a21wu.241046-global.4691948847.115.533465dcMn52tN&scm=1007.15423.84311.100200300000005&pvid=f149bbba-0b52-4a7e-8bb3-740957781f63\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59c8bb1206e20\"}', '1', '0', '1', '9', 'Gazi trong ?ó'), ('12', '{\"type\":\"taobao\",\"item_id\":\"557853274899\",\"item_price\":\"128\",\"item_image\":\"https:\\/\\/gd1.alicdn.com\\/bao\\/uploaded\\/i1\\/678900008\\/TB23j5fayIRMeJjy0FbXXbnqXXa_!!678900008.jpg_600x600.jpg\",\"seller_name\":\"Qu\\u1ea7n \\u00e1o Yuner 168\",\"seller_id\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">Qu\\u1ea7n \\u00e1o Yuner 168<\\/font><\\/font>\",\"quantity\":\"1\",\"color_size\":\";XL;\\u7ea2\\u8272\",\"comment\":\"test\",\"data_value\":\"XL;\\u0110\\u1ecf\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"item_link\":\"https:\\/\\/world.taobao.com\\/item\\/557853274899.htm?fromSite=main&spm=a21wu.241046-global.4691948847.15.73445d1aNaNHEY&scm=1007.15423.84311.100200300000005&pvid=27428833-9291-42f1-9371-6473fe5e6118\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59cb7fd1083c3\"}', '1', '0', '1', '10', 'Qu?n áo Yuner 168'), ('13', '{\"type\":\"taobao\",\"item_id\":\"39153793996\",\"item_price\":\"18\",\"item_image\":\"https:\\/\\/gd3.alicdn.com\\/bao\\/uploaded\\/i3\\/360793838\\/T2mG0SX_tXXXXXXXXX-360793838.jpg_600x600.jpg\",\"seller_name\":\"Th\\u1eddi trang y\\u00eau nh\\u00e0 th\\u1ea3m mall\",\"seller_id\":\"<font style=\\\"vertical-align: inherit;\\\"><font style=\\\"vertical-align: inherit;\\\">Th\\u1eddi trang y\\u00eau nh\\u00e0 th\\u1ea3m mall<\\/font><\\/font>\",\"quantity\":\"1\",\"color_size\":\";37 * 70 cm;\\u73ab\\u7ea2\",\"comment\":\"test\",\"data_value\":\"37 * 70 cm;H\\u1ed3ng \\u0111\\u1ecf\",\"ct\":\"c0f149fc45f29378355bee37990ef902\",\"item_link\":\"https:\\/\\/world.taobao.com\\/item\\/39153793996.htm?fromSite=main&spm=a21wu.241046-global.4691948847.9.73445d1aNaNHEY&scm=1007.15423.84311.100200300000005&pvid=27428833-9291-42f1-9371-6473fe5e6118\",\"is_addon\":\"1\",\"version\":\"20140225\",\"id\":\"59cb8019b6a70\"}', '1', '0', '1', '10', 'Th?i trang yêu nhà th?m mall');
COMMIT;

-- ----------------------------
--  Table structure for `avt_orders`
-- ----------------------------
DROP TABLE IF EXISTS `avt_orders`;
CREATE TABLE `avt_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_note` text,
  `order_quantity` int(11) DEFAULT NULL,
  `order_total_price_cn` varchar(255) DEFAULT NULL,
  `order_total_price_vn` varchar(255) DEFAULT NULL,
  `order_real_purchase` int(11) DEFAULT NULL,
  `order_status` tinyint(2) DEFAULT NULL,
  `order_buy_status` tinyint(2) DEFAULT NULL,
  `order_delivery_status` tinyint(2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_seller` varchar(255) DEFAULT NULL,
  `order_info_pay` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_orders`
-- ----------------------------
BEGIN;
INSERT INTO `avt_orders` VALUES ('5', 'Admin-HN-21-09-2017', '2017-09-21 14:49:21', null, '4', '120546', '426732840', '0', '2', '1', '1', '3', null, '{\"rest_percent\":0,\"has_pay\":426732840,\"rest_pay\":0}'), ('6', 'Admin-HN-21-09-2017', '2017-09-21 14:50:21', null, '4', '120546', '426732840', '0', '2', '1', '1', '3', null, null), ('7', 'Admin-HN-21-09-2017', '2017-09-21 14:00:21', null, '4', '120546', '426732840', '4', '2', '2', '2', '3', null, null), ('8', 'Admin-HN-21-09-2017', '2017-09-21 15:58:21', null, '4', '120546', '426732840', '2', '2', '2', '1', '3', null, null), ('9', 'Custommer-HN-25-09-2017', '2017-09-25 15:44:25', null, '3', '9260', '32780400', '0', '2', '1', '1', '3', null, '{\"rest_percent\":0,\"has_pay\":32780400,\"rest_pay\":0}'), ('10', 'Custommer-HN-27-09-2017', '2017-09-27 17:41:27', null, '2', '146', '516840', '0', '1', '1', '1', '3', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `avt_recharge`
-- ----------------------------
DROP TABLE IF EXISTS `avt_recharge`;
CREATE TABLE `avt_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `note` text,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_recharge`
-- ----------------------------
BEGIN;
INSERT INTO `avt_recharge` VALUES ('1', 'le trung ha', '23/06/2017', '2000000', 'test', '1', 'ck', '3', '2', 'BCDAD'), ('2', 'le trung ha', '23/06/2017', '2000000', 'test', '1', 'ck', '3', '2', 'BCDAD'), ('3', 'le trung ha', '23/06/2017', '2000000', 'test', '2', 'ck', '3', '2', 'BCDAD'), ('4', 'le trung ha', '23/06/2017', '2000000', 'test', '2', 'ck', '3', '1', 'BCDAD');
COMMIT;

-- ----------------------------
--  Table structure for `avt_usermeta`
-- ----------------------------
DROP TABLE IF EXISTS `avt_usermeta`;
CREATE TABLE `avt_usermeta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `avt_users`
-- ----------------------------
DROP TABLE IF EXISTS `avt_users`;
CREATE TABLE `avt_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_status` tinyint(2) DEFAULT NULL,
  `user_display_name` varchar(255) DEFAULT NULL,
  `user_role` tinyint(2) DEFAULT NULL,
  `user_money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `avt_users`
-- ----------------------------
BEGIN;
INSERT INTO `avt_users` VALUES ('2', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2017-07-20 14:58:29', '1', 'Admin', '1', '0'), ('3', 'Custommer', '21232f297a57a5a743894a0e4a801fc3', 'a@gmail.com', '2017-07-20 14:58:29', '1', 'Custommer', '2', '350486760');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
