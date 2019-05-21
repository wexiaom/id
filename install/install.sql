CREATE TABLE IF NOT EXISTS `forward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `domain` tinytext NOT NULL,
  `title` tinytext COMMENT '页面标题',
  `keywords` tinytext COMMENT '页面关键字',
  `description` varchar(800) DEFAULT NULL COMMENT '页面描述',
  `url` text COMMENT '页面地址',
  `mode` int(11) NOT NULL DEFAULT '0' COMMENT '跳转方式',
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` tinytext NOT NULL,
  `pass` tinytext NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;