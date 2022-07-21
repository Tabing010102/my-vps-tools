-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-07-21 15:18:59
-- 服务器版本： 10.2.24-MariaDB-log
-- PHP 版本： 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `theta`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `aid` int(11) NOT NULL COMMENT '文章id',
  `author_uid` int(11) NOT NULL COMMENT '作者uid',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '文章内容',
  `content_part` varchar(163) COLLATE utf8_unicode_ci NOT NULL COMMENT '截取开头的80字符',
  `last_modified` datetime NOT NULL COMMENT '最后修改时间',
  `issue_num` int(11) NOT NULL COMMENT 'issue(讨论)数目',
  `parent_did` int(11) NOT NULL COMMENT '所属讨论did'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='文章';

-- --------------------------------------------------------

--
-- 表的结构 `discuss`
--

CREATE TABLE `discuss` (
  `did` int(11) NOT NULL COMMENT '讨论id',
  `organizer_uid` int(11) NOT NULL COMMENT '发起者uid',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题(50字）',
  `involve_num` int(11) NOT NULL COMMENT '参与量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='讨论表';

-- --------------------------------------------------------

--
-- 表的结构 `jbeduzhb_feedback`
--

CREATE TABLE `jbeduzhb_feedback` (
  `fid` int(11) NOT NULL COMMENT '反馈编号',
  `identity` text COLLATE utf8_unicode_ci NOT NULL COMMENT '反馈人身份',
  `ftime` datetime NOT NULL COMMENT '反馈时间',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '反馈内容',
  `isprocessed` tinyint(1) NOT NULL COMMENT '是否处理',
  `ptime` datetime NOT NULL COMMENT '处理时间',
  `result` text COLLATE utf8_unicode_ci NOT NULL COMMENT '处理结果'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='金榜中华北电脑使用反馈';

-- --------------------------------------------------------

--
-- 表的结构 `login`
--

CREATE TABLE `login` (
  `lid` int(11) NOT NULL COMMENT '登录id',
  `uid` int(11) NOT NULL COMMENT '登陆的用户id',
  `ua` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'User Agent',
  `ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录ip',
  `time` datetime NOT NULL COMMENT '登录时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='登录记录';

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL COMMENT '用户id',
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名（昵称）（小于16字符）',
  `pwdhash` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码_加密',
  `signup_time` datetime NOT NULL COMMENT '注册时间',
  `last_login_time` datetime NOT NULL COMMENT '最后登录时间',
  `last_login_ip_hash` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '最后登录ip_加密',
  `last_login_ua_hash` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '最后登录User Agent_加密',
  `gender` enum('male','female','other') COLLATE utf8_unicode_ci NOT NULL COMMENT '性别',
  `authentication` enum('user','admin','other') COLLATE utf8_unicode_ci DEFAULT 'user' COMMENT '身份认证',
  `coin` int(11) NOT NULL DEFAULT 0 COMMENT '硬币',
  `token` int(11) NOT NULL DEFAULT 200 COMMENT '代金券',
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '个人描述',
  `identity` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '身份（小于40字符）'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户';

--
-- 转储表的索引
--

--
-- 表的索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`aid`);

--
-- 表的索引 `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`did`);

--
-- 表的索引 `jbeduzhb_feedback`
--
ALTER TABLE `jbeduzhb_feedback`
  ADD PRIMARY KEY (`fid`);

--
-- 表的索引 `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id';

--
-- 使用表AUTO_INCREMENT `discuss`
--
ALTER TABLE `discuss`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT COMMENT '讨论id';

--
-- 使用表AUTO_INCREMENT `jbeduzhb_feedback`
--
ALTER TABLE `jbeduzhb_feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT COMMENT '反馈编号';

--
-- 使用表AUTO_INCREMENT `login`
--
ALTER TABLE `login`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT COMMENT '登录id';

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
