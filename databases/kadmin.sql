-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-07-24 09:06:28
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WYmanage`
--

-- --------------------------------------------------------

--
-- 表的结构 `wy_admin`
--

CREATE TABLE IF NOT EXISTS `wy_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `bind_ip` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` int(10) unsigned NOT NULL DEFAULT '0',
  `error_count` int(1) unsigned DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台用户表' AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `wy_admin`
--

INSERT INTO `wy_admin` (`id`, `account`, `nickname`, `password`, `bind_ip`, `last_login_ip`, `login_count`, `error_count`, `last_login_time`, `email`, `role_id`, `status`) VALUES
(1, 'admin', '超级管理员', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', '127.0.*.*', '127.0.0.1', 58, 0, 1437721529, 'abc@abc.com', 1, 1),
(45, 'xujiantao', '徐建涛', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 1),
(46, 'xiaoming', '小明', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 0),
(47, 'xiaoqiang', '小强', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 1),
(48, 'zhaochunfeng', '赵春风', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 1),
(49, 'zhaodan', '赵丹', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 0),
(50, 'zhaofang', '赵芳', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 3, 0),
(51, 'zhaofeng', '赵锋', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 0),
(52, 'wanghongxia', '王洪侠', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 1),
(53, 'fuwenwen', '付文文', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 3, 0),
(54, 'shiying', '史莹', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 2, 1),
(55, 'xingmingming', '兴明明', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 1),
(56, 'liuying', '刘颖', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 0),
(57, 'sunxue', '孙雪', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 0),
(58, 'sunyuanlong', '孙源龙', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 1),
(59, 'zhuzhenhua', '朱振华', '$2y$10$iWXeoymquyr0pm6nJ5RaleQhogUG026MItfN3F6IymwKO7Obmj7qm', NULL, '127.0.0.1', 0, 0, 0, 'abc@abc.com', 1, 0),
(60, 'test', 'test', '', '111.222.333.444', NULL, 0, 0, 0, 'test@qq.com', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_category`
--

CREATE TABLE IF NOT EXISTS `wy_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` int(11) unsigned NOT NULL,
  `path` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `path` (`path`(333))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wy_category`
--

INSERT INTO `wy_category` (`id`, `name`, `pid`, `path`) VALUES
(100, '摩托罗拉', 78, '0-78'),
(99, 'OPPO', 78, '0-78'),
(124, '数码相机', 0, '0'),
(98, '酷派', 78, '0-78'),
(97, '纽曼', 78, '0-78'),
(96, '夏普', 78, '0-78'),
(95, '中兴', 78, '0-78'),
(91, '明泰', 78, '0-78'),
(92, '索尼', 78, '0-78'),
(93, '首派', 78, '0-78'),
(90, '西铂', 78, '0-78'),
(89, '戴尔', 78, '0-78'),
(88, '魅族', 78, '0-78'),
(87, '天语', 78, '0-78'),
(86, '步步高', 78, '0-78'),
(85, '金立', 78, '0-78'),
(84, '联想', 78, '0-78'),
(83, 'LG', 78, '0-78'),
(82, '微铂', 78, '0-78'),
(81, '现代手机', 78, '0-78'),
(80, '长虹', 78, '0-78'),
(79, '中恒', 78, '0-78'),
(78, '手机专区', 0, '0'),
(101, '诺基亚', 78, '0-78'),
(102, '三星', 78, '0-78'),
(103, 'HTC', 78, '0-78'),
(104, '华为', 78, '0-78'),
(105, '索爱', 78, '0-78'),
(106, 'iphone(苹果)', 78, '0-78'),
(107, '笔记本电脑', 0, '0'),
(109, 'Thinkpad(IBM)', 107, '0-107'),
(110, '华硕', 107, '0-107'),
(111, '宏碁', 107, '0-107'),
(112, '惠普', 0, '0-107'),
(113, '神舟', 107, '0-107'),
(114, '东芝', 107, '0-107'),
(115, '清华同方', 107, '0-107'),
(116, 'SONY', 107, '0-107'),
(117, '戴尔', 107, '0-107'),
(118, '海尔', 107, '0-107'),
(119, '方正', 107, '0-107'),
(120, '三星', 107, '0-107'),
(121, '苹果', 107, '0-107'),
(122, 'Alienware', 107, '0-107'),
(123, '富士通', 107, '0-107'),
(125, '佳能', 124, '0-124'),
(126, '富士', 124, '0-124'),
(127, '尼康', 124, '0-124'),
(128, '柯达', 124, '0-124'),
(129, '卡西欧', 124, '0-124'),
(130, '通用GE', 124, '0-124'),
(131, '其他品牌', 124, '0-124'),
(132, '平板电脑', 0, '0'),
(133, '3G--专区', 0, '0'),
(134, '镜头/滤镜', 0, '0'),
(135, '数码摄像', 0, '0'),
(136, '摄影背包', 0, '0'),
(137, '汽车导航', 0, '0'),
(138, '其他商品', 0, '0'),
(139, '三星', 132, '0-132'),
(140, 'HTC', 132, '0-132'),
(141, '华为', 132, '0-132'),
(142, '索尼', 132, '0-132'),
(143, '苹果IPAD', 132, '0-132'),
(144, '联想乐PAD', 132, '0-132'),
(145, '苹果手机', 133, '0-133'),
(146, 'HTC', 133, '0-133'),
(147, '华为', 133, '0-133'),
(148, '中兴', 133, '0-133'),
(149, '索爱', 133, '0-133'),
(150, '摩托罗拉', 133, '0-133'),
(151, '联想', 133, '0-133'),
(152, '腾龙镜头', 134, '0-134'),
(153, '佳能镜头', 134, '0-134'),
(154, '尼康镜头', 134, '0-134'),
(155, '索尼镜头', 134, '0-134'),
(156, '松下镜头', 134, '0-134'),
(157, '适马镜头', 134, '0-134'),
(158, '图丽镜头', 134, '0-134'),
(159, '宾得镜头', 134, '0-134'),
(160, '奥林巴斯镜头', 134, '0-134'),
(161, '佳能', 135, '0-135'),
(162, '松下', 135, '0-135'),
(163, '索尼', 135, '0-135'),
(164, '乐摄宝', 136, '0-136'),
(165, '国家地理', 136, '0-136'),
(166, '凯思智品', 136, '0-136'),
(167, '佳能', 136, '0-136'),
(168, 'TENBA', 136, '0-136'),
(169, '其他品牌', 136, '0-136'),
(170, 'GPS导航', 137, '0-137'),
(171, '电子狗', 137, '0-137'),
(172, '充电器', 137, '0-137'),
(173, '车载MP3', 137, '0-137'),
(174, '电子词典', 138, '0-138'),
(175, '复读机', 138, '0-138'),
(176, '点读机', 138, '0-138');

-- --------------------------------------------------------

--
-- 表的结构 `wy_node`
--

CREATE TABLE IF NOT EXISTS `wy_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `role_id` varchar(100) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `pid` int(10) unsigned DEFAULT '0',
  `icon` varchar(20) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台功能节点' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wy_node`
--

INSERT INTO `wy_node` (`id`, `title`, `status`, `role_id`, `module`, `pid`, `icon`, `remark`) VALUES
(7, '权限管理', 1, '1,2', NULL, 0, 'fa-desktop', ''),
(83, '后台用户管理', 1, '1', 'Admin/Index', 7, '', ''),
(84, '节点管理', 1, '1', 'Admin/Node', 7, '', ''),
(92, '分类管理', 1, '1', '', 0, 'fa-inbox ', NULL),
(93, '分类列表', 1, '1', 'Category/Index', 92, '', NULL),
(104, '角色管理', 1, '1', 'Admin/Role', 7, '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wy_role`
--

CREATE TABLE IF NOT EXISTS `wy_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wy_role`
--

INSERT INTO `wy_role` (`id`, `name`) VALUES
(1, '管理员'),
(2, '编辑'),
(3, '打酱油的');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
