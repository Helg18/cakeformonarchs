<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table kerss_sizechart(
sizechart_id int not null auto_increment, 
name varchar(100),
image varchar(100),
description text,
status int(11) default 1,
primary key(sizechart_id));		
SQLTEXT;

$installer->run($sql);
$installer->endSetup();
	 