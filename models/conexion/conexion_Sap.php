<?php 

/**
 * summary
 */

require_once '../config/config.php';
 class Conexion_Sap
    {
    	private $host;
    	private $usuario;
    	private $pass;
    	private $db;
    	private $connection;
    	
    	function __construct()
    	{
    		$this->host = SERVER_OD;
        	$this->usuario = USER_OD;
        	$this->pass = PSSWD_OD;
        	$this->db = BD_OD;
    	}

    	/*CONECT TO DATABASE*/
    	function connect()
    	{
    				try {
    						
    						$this->connection = new PDO($this->host,$this->usuario,$this->pass);

    				} catch (Exception $e) {
    						
    				}	
    	}

    	public function veryfyCon()
    	{
    		$var="off";
    	
    				try {
    						$this->connection = new PDO($this->host,$this->usuario,$this->pass);
        			$var="on";	
    		 } catch (Exception $e) {
    					
    		 }
    		 return $var;
    	}

    	/*EXECUTE SELECT*/
    	function getData($sql)
    	{
 	   	    $data = array();
            $sql=str_replace("DB", $this->db, $sql);
            // echo $sql;
 	   	    $result = $this->connection->prepare($sql);
 			$error = $this->connection->errorInfo();
    	    
    	    if ($error[0] === "00000") {
    	    	
    	        $result->execute();
    	        if ($result->rowCount() > 0) {
    	            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    	            	array_push($data, $row);
    	            }
    	        }
    	    } else {
    	    	
    	        $data=array("error"=>"error");
    	    }
    	    return $data;
    	}
    	/*EXECUTE DELETE UPDATE INSERT*/
    	function executeInstruction($sql)
    	{
 	   	    $result = $this->connection->prepare($sql);
 	   	    $error = $this->connection->errorInfo();
 	
    	    if ($error[0] === "00000") {
    	        $result->execute();
    	        return $result->rowCount() > 0;
    	    } else {
    	        return false;
    	    }
    	}
    	/*CLOSE CONECTION DATABASE*/
    	function close()
    	{
    	    $this->connection = null;
    	}
    }

?>