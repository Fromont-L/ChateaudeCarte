<?php
	class Database {
	private static $dbName = 'Chateau_de_Carte' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'fromont';
	private static $dbUserPassword = 'password';
	private static $cont = null; 
	/*public function __construct() { 
		die('Init function is not allowed');
	} */
	public static function connect() { 
		if ( null == self::$cont ) { 
			try { self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); }
			catch(PDOException $e) {
				die($e->getMessage());
		}
	}
		return self::$cont;
	}

	public function query($sql, $data = array()){
		$req = $this->connect()->prepare($sql);
		$req->execute($data);

		return $req;
	}

	public function insert($sql, $data = array()){
		$req = $this->connect()->prepare($sql);
		$req->execute($data);
	}
	

	public static function disconnect()
	{
		self::$cont = null;
	}
}

// Faire une connexion à notre fonction

?>