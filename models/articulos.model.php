<?php 
	/**
	 * 
	 */

	require_once 'conexion/conexion.php';
	require_once '../config/config.php';
	class ArticuloModel
	{
		private $noIdentificardor=null;
		private $ClaveArticulo=null;
		private $con=null;
		function __construct()
		{
			$this->con=new Conexion(SERVER,USER,PSSWD,BD);
		}


	
    	/**
    	 * @param mixed $noIdentificardor
    	 *
    	 * @return self
    	 */
    	public function setNoIdentificardor($noIdentificardor)
    	{
    	    $this->noIdentificardor = $noIdentificardor;
	    	return $this;
	    }
	
	    	/**
	    	 * @param mixed $ClaveArticulo
	    	 *
	    	 * @return self
	    	 */
	    public function setClaveArticulo($ClaveArticulo)
	    {
	    	 $this->ClaveArticulo = $ClaveArticulo;
	    	 return $this;
    	}

    	/**
    	 * @return mixed
    	 */
    	public function getClaveArticulo()
    	{
    	    return $this->ClaveArticulo;
    	}


    	public function verify()
    	{
    		return $this->con->veryfyCon();
    	}

    	public function buscarArticulo()
    	{
    		
    		$sql="SELECT codigo, ean FROM febrero2022 WHERE ean='$this->noIdentificardor'";
			$this->con->connect();
			$rs=$this->con->getData($sql);
			if (count($rs)>0) {
				$this->setClaveArticulo($rs[0]['codigo']);
			}else {
				$this->setClaveArticulo(NULL);
			}
			 
			$this->con->close();
    	}
}

// $objArticulos=new ArticuloModel();
// $objArticulos->setNoIdentificardor('7506240607632');
// $objArticulos->buscarArticulo();

?>