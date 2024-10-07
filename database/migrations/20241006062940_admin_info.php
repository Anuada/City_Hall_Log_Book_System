<?php

require_once "util/database/DbMigration.php";

$migration = new DbMigration('admin_info');

$migration->addColumn('id', 'int', false, null, true)
    ->addColumn('username', 'varchar(255)')
    ->addColumn('password', 'varchar(255)')
    ->addColumn('created_at', "timestamp", false, 'CURRENT_TIMESTAMP')
    ->addPrimaryKey('id');

echo $migration->create();