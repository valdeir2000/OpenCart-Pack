CREATE TABLE IF NOT EXISTS `oc_moip_nasp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transacao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `status_pagamento` int(11) NOT NULL,
  `cod_moip` int(11) NOT NULL,
  `forma_pagamento` int(11) NOT NULL,
  `tipo_pagamento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_consumidor` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `parcelas` int(255) NOT NULL DEFAULT '0',
  `cartao_bin` int(255) NOT NULL DEFAULT '0',
  `cartao_final` int(255) NOT NULL DEFAULT '0',
  `cartao_bandeira` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Indefinido',
  `cofre` varchar(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Indefinido',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2047 ;
	
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
  `CPFTitular` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_cartaoCredito`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;