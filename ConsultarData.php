<?php


class ConsultarData extends Connect{
    
    private $DB;

    public function __construct($param) {
        $this->_DB = parent::__construct();
        
    }

    public function getData($flag,$criterio=''){
        $DB = new Connect();
        
        if($flag == 'P'){
            $sql = "SELECT placa, modelo, marca, color, destino, aprovado FROM pruebabogota";
            if(!empty($criterio)){
                $sql .= " WHERE CONCAT(placa,' ',modelo,' ',marca, ,color,' ',destino,' ',aprovado)LIKE '%".$criterio."%' ";
            }       
        $data = $DB->query($sql);
        $result = $data->fetchAll(PDO::FETCH_ASSOC);           
    }
    return $result;
}

    public function getDataSP($flag,$criterio='',$page,$regxpag){
//        $DB = new Connect();   
                $sql = " CALL dataGrid('".$flag.'","'.$criterio.'","'.$page.'","'.$regxpag."');";
                 
        $data = $this->_DB->query($sql);
        $result = $data->fetchAll(PDO::FETCH_ASSOC);           
    
    return $result;
}

    public function __getDataSP($flag,$criterio='',$page,$regxpag){
           
                $sql = "EXEC dataGrid ?,?,?,? ";
                 
        $data = $this->_DB->prepare($sql);
        $data->execute(array($flag,$criterio,$page,$regxpag));
        $data->nextRowset();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);           
    
    return $result;
    }
}
