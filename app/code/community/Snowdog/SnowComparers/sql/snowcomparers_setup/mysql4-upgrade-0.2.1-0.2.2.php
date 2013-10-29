<?php

$installer = $this;
/* @var @installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

$installer->getConnection()
	->addColumn($installer->getTable('snowcomparers/scheme'), 'visibility', array(
		'nullable' => false,
		'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
		'default' => 0,
		'comment' => 'Visibility filter options'
	)
);

$installer->endSetup();
