<?php
namespace LogMon\Tests\LogConfig;

class LogConfigMysqlTest extends BaseLogConfigTest
{
	public $logConfigClass = '\LogMon\LogConfig\ConfigMysql';
	public static $connectionFactory = 'db.mysql.getConnection';
	public static $app;

	public function providerConfig()
	{
		$configSets = array(
			array(
				'host' => 'localhost',
				'port' => '3306',
				'charset' => 'utf8',
				'username' => 'root',
				'password' => 'root',
				'databaseName' => 'test',
				'collectionName' => 'logTable1',
				'fieldMapper' => (object) array(
					'unique' => (object) array('fieldName' => 'id', 'regex' => '(.*)'),
					'date' => (object) array('fieldName' => 'at', 'regex' => '(.*)'),
					'level' => (object) array('fieldName' => 'level', 'regex' => '(.*)'),
					'message' => (object) array('fieldName' => 'text', 'regex' => '(.*)')
				)
			)
		);

		return array($configSets);
	}

}
