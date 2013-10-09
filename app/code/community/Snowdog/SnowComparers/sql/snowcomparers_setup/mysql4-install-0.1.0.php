<?php

$installer = $this;

$installer->startSetup();

$installer->run("
-- DROP TABLE IF EXISTS `{$this->getTable('snowcomparers_schemas')}`;
CREATE TABLE IF NOT EXISTS `{$this->getTable('snowcomparers_schemas')}` (
  `scheme_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) DEFAULT NULL,
  `header` text,
  `footer` text,
  `content` text,
  `base` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `sku_filter` text,
  `category_filter` text,
  PRIMARY KEY  (`scheme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
