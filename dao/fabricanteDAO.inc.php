<?php 
    //require_once("../classes/Fabricante.inc.php");
    require_once("conexao.inc.php");
    require_once("../utils/utils.inc.php");

    class FabricanteDAO {
        private $con;

        public function __construct(){
            $conexao = new Conexao();
            $this->con = $conexao->getConexao();
        }
        
        public function getTodosFabricantes() {
            $resultSet = $this->con->query("select * from fabricantes");

            //Array dinâmico
            $lista = array();

            while($row = $resultSet->fetch(PDO::FETCH_OBJ)){
                $lista[] = $row;
            }
            return $lista;
        }
    }