<?php

namespace Core;

class PDOFactory
{
	public static function getMysqlConnection()
	{
		// $db = new \PDO('mysql:host=db5000272356.hosting-data.io;dbname=dbs265834', 'dbu439460', 'D!oGod!@LLo2828#%6^*');
		$db = new \PDO('mysql:host=localhost;dbname=blogpro', 'root', 'root');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
