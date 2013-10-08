<?php
namespace LogMon\LogConfig;

class Manager
{
	/**
	 * builds a logConfig object from raw object
	 * 
	 * @param \Silex\Application $app 
	 * @param object $project 
	 * @static
	 * @access public
	 * @return LogMon\LogConfig\IConfig
	 * @trows If storage type is unknown or logConfig cannot be created.
	 */
	public static function build(\Silex\Application $app, $rawConfig)
	{
		if (!is_object($rawConfig)) 
			throw new \InvalidArgumentException(
				"The argument 'project' must be an object.");
		
		switch ($rawConfig->storageType) {
			case 'textFile':
				$logConfig = new ConfigTextFile($app);
				break;
			case 'mongodb':
				$logConfig = new ConfigMongodb($app);
				break;
			case 'mysql':
				$logConfig = new ConfigMysql($app);
				break;
			default:
				throw new \Exception(
					sprintf("The storage type is unknown: '%s'"
						, $rawConfig->storageType)
				);
		}

		unset($rawConfig->storageType);
		foreach($rawConfig as $parameter => $value)
			$logConfig->$parameter = $value;

		try{
			$logConfig->test();
			return $logConfig;
		} catch (\Exception $e) {
			throw $e;
		}
	}
}