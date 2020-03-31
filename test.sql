CREATE TABLE IF NOT EXISTS `t_user` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `birthdate` varchar(12) NOT NULL, 
  `password` varchar(64) NOT NULL COMMENT '密码', 
  `email` varchar(30) NOT NULL COMMENT '邮箱', 
  `regtime` int(10) NOT NULL COMMENT '注册时间', 
  `secure_question_1` varchar(50) NOT NULL,
  `secure_question_1_answer` varchar(30) NOT NULL,
  `secure_question_2` varchar(50) NOT NULL,
  `secure_question_2_answer` varchar(30) NOT NULL,
  `secure_question_3` varchar(50) NOT NULL,
  `secure_question_3_answer` varchar(30) NOT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 