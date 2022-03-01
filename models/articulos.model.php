<?php 
	/**
	 * 
	 */

	require_once 'conexion/conexion.php';
	require_once 'conexion/conexion_Sap.php';
	class ArticuloModel
	{
		private $noIdentificardor=null;
		private $ClaveArticulo=null;
		private $con=null;
		private $conSap=null;
		function __construct()
		{
			$this->con=new Conexion();
			$this->conSap=new Conexion_Sap();
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

    	public function verifySB1()
    	{
    		return $this->conSap->veryfyCon();
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

    	public function buscarArticuloSap()
    	{
    		$sql="SELECT T1." . Chr(34) . "ItemCode". Chr(34) . " FROM DB.OBCD T0  INNER JOIN DB.OITM T1 ON T0.". Chr(34) . "ItemCode". Chr(34) . " = T1.". Chr(34) . "ItemCode". Chr(34) . " WHERE T0.". Chr(34) . "BcdCode". Chr(34) . "='$this->noIdentificardor'";
			$this->conSap->connect();
			$rs=$this->conSap->getData($sql);
			if (count($rs)>0) {
				$this->setClaveArticulo($rs[0]['ItemCode']);
			}else {
				$this->setClaveArticulo(NULL);
			}
			 
			$this->conSap->close();
    	}
}

// $objArticulos=new ArticuloModel();
// $objArticulos->setNoIdentificardor('7506240607632');
// $objArticulos->buscarArticulo();

?>