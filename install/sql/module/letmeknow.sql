DROP TABLE IF EXISTS `letmeknow`;
CREATE TABLE `letmeknow` (
  `letmeknow_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Customer Name',
  `email` varchar(200) NOT NULL COMMENT 'Customer Email',
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`letmeknow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;