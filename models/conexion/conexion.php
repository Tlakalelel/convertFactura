<?php   
    // $serverName = "192.168.1.63";
    // $database = "SAP";
    // $uid = 'sa';
    // $pwd = 'Z3r0C001X';

    /**
     * 
     */
    class Conexion
    {
    	private $host;
    	private $usuario;
    	private $pass;
    	private $db;
    	private $connection;
    	
    	function __construct($host, $usuario, $pass, $db)
    	{
    		$this->host = $host;
        	$this->usuario = $usuario;
        	$this->pass = $pass;
        	$this->db = $db;
    	}

    	/*CONECT TO DATABASE*/
    	function connect()
    	{
    	

    				$opciones = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
    				try {
    						$this->connection = new PDO(
            						'sqlsrv:server=' . $this->host . ';database=' . $this->db,
        		    				$this->usuario,
        		    				$this->pass,
        		    				$opciones
				
        					);	
    				} catch (Exception $e) {
    					
    				}
    				
    		
    		
    	}

    	public function veryfyCon($value='')
    	{
    		$var="off";
    		$opciones = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
    				try {
    						$this->connection = new PDO(
            						'sqlsrv:server=' . $this->host . ';database=' . $this->db,
        		    				$this->usuario,
        		    				$this->pass,
        		    				$opciones
				
        					);
        			$var="on";	
    		 } catch (Exception $e) {
    					
    		 }
    		 return $var;
    	}

    	public function veryfyConOff($value='')
    	{
    		
    	}

    	/*EXECUTE SELECT*/
    	function getData($sql)
    	{
 	
 	   	    $data = array();
 	   	    $result = $this->connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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