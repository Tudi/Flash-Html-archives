# MySQL-Front Dump 2.5
#
# Host: localhost   Database: chat
# --------------------------------------------------------
# Server version 4.0.16-nt

USE chat;


#
# Table structure for table 'msgs'
#

DROP TABLE IF EXISTS `msgs`;
CREATE TABLE `msgs` (
  `msg` text,
  `uid` tinyint(3) unsigned default '0',
  `mid` int(5) unsigned NOT NULL auto_increment,
  `m_time` varchar(19) default NULL,
  `type` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`mid`),
  UNIQUE KEY `id` (`mid`),
  KEY `id_2` (`mid`)
) TYPE=MyISAM COMMENT='itten vannak tarolva a msg-ek';



#
# Dumping data for table 'msgs'
#

INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=348&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : toltsuk meg az oldalt", "1", "348", "2005-2-2-23-22-7", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=349&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : miert toltodik annyit", "1", "349", "2005-2-2-23-22-17", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=350&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : na ?", "1", "350", "2005-2-2-23-24-3", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=352&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : tralala", "1", "352", "2005-2-2-23-33-26", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=353&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : hugacsaka", "1", "353", "2005-2-2-23-33-31", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=382&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : &lt;input type=image src=./smile/smile.gif &gt;&lt;input type=image src=./smile/biggrin.gif &gt;&lt;input type=image src=./smile/sad.gif &gt;&lt;input type=image src=./smile/wink.gif &gt;&lt;input type=image src=./smile/tongue.gif &gt;&lt;input type=image src=./smile/devil.gif &gt;&lt;input type=image src=./smile/dead.gif &gt;&lt;input type=image src=./smile/smokin.gif &gt;&lt;input type=image src=./smile/pukey.gif &gt;&lt;input type=image src=./smile/cool.gif &gt;&lt;input type=image src=./smile/aua.gif &gt;&lt;input type=image src=./smile/rotfl.gif &gt;", "1", "382", "2005-2-3-16-1-43", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=383&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : &lt;input type=image src=./smile/aua.gif &gt; =&gt; &lt;input type=image src=./smile/rotfl.gif &gt; =&gt; &lt;input type=image src=./smile/biggrin.gif &gt;", "1", "383", "2005-2-3-16-2-19", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=384&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : ez nem is refreshelodik ?", "1", "384", "2005-2-3-16-38-22", "1");
INSERT INTO `msgs` (`msg`, `uid`, `mid`, `m_time`, `type`) VALUES("&lt;a href=&quot;msg_info.php?uid=1&amp;msg_id=385&quot; target=&quot;_blank&quot; style=&quot;color:#FFffff;background-color: #000000;font-weight: 1;&quot;&gt;a&lt;/a&gt; : teszt az egesz", "1", "385", "2005-02-03-23-54-11", "1");


#
# Table structure for table 'users'
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(5) unsigned NOT NULL auto_increment,
  `msg_sent` int(3) unsigned NOT NULL default '0',
  `u_group` varchar(20) NOT NULL default 'user',
  `u_name` varchar(20) NOT NULL default 'elfelejtettem',
  `u_acces` int(3) unsigned NOT NULL default '1',
  `u_nick` varchar(10) NOT NULL default 'nobody',
  `u_passw` varchar(30) NOT NULL default '',
  `nick_style` varchar(200) NOT NULL default '',
  `u_email` varchar(20) NOT NULL default 'nem is letezik inter',
  `u_comment` varchar(50) NOT NULL default 'atlatszo vagyok mint az uveg',
  `u_refrt` tinyint(3) unsigned NOT NULL default '1',
  `show_nr_msgs` int(4) unsigned NOT NULL default '100',
  `kuld_style` varchar(50) default NULL,
  `kapott_style` varchar(50) default NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `uid` (`uid`),
  KEY `uid_2` (`uid`)
) TYPE=MyISAM COMMENT='itt vannak a regisztralt user-ek';



#
# Dumping data for table 'users'
#

INSERT INTO `users` (`uid`, `msg_sent`, `u_group`, `u_name`, `u_acces`, `u_nick`, `u_passw`, `nick_style`, `u_email`, `u_comment`, `u_refrt`, `show_nr_msgs`, `kuld_style`, `kapott_style`) VALUES("1", "0", "admin", "Jozsa Istvan", "1000", "a", "a", "color:#FFffff;background-color: #000000;font-weight: 1;", "nem is letezik inter", "atlatszo vagyok mint az uveg", "5", "100", "color:#ff0000", "background-color:#00ff00");
