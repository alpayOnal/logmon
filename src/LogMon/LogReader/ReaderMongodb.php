<?php
namespace LogMon\LogReader;

class ReaderMongodb
	extends Reader
	implements IReader
{

	public function fetch()
	{
		if (!$this->isInitialized)
			$this->initialize();
		
		$conf = $this->logConfig;
		$queryBuilder =  $this->connection->createQueryBuilder();
		$queryBuilder
			->limit($this->limit);

		$cursor = $queryBuilder->getQuery()->execute();
		return $cursor;
	}
}
