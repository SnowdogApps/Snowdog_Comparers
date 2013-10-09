<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `{$this->getTable('snowcomparers_schemas')}` ADD COLUMN `store_id` INT;
");

$installer->endSetup();
