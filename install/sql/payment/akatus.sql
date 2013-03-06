CREATE TABLE IF NOT EXISTS `oc_nip` (
  `nip_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transacao_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `cartaocredito` (
  `id_cartaoCredito` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `bandeiraCartao` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `titularCartao` varchar(1000) NOT NULL,
  `numeroCartao` varchar(1000) NOT NULL,
  `validadeCartao` varchar(1000) NOT NULL,
  `codCartao` varchar(1000) NOT NULL,
  `nascimentoTitular` varchar(1000) NOT NULL,
  `telefoneTitular` varchar(1000) NOT NULL,
  `CPFTitular` varchar(11000) NOT NULL,
  PRIMARY KEY (`id_cartaoCredito`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;