<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('snowcomparers_schemas')}` ADD COLUMN `last_generated` DATETIME;
");

$installer->endSetup();
