<?php
/**
 * Description of Conexao
 *
 * @author RAFAEL
 */
class Conexao {
    #$Region: Atributos
    
    protected $link;
    protected $dbselected;
    protected $command;
    
    #@Region: Propriedades
    public function __get($attr) {
        return $this->$attr;
    }
    
    public function __set($attr, $value) {
        $this->$attr = $value;
    }
    
    #@Region: Construtores
    public function __construct() {
        $this->link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ('Não possível se conectar ao servidor. Verifique o arquivo config.php.');
        $this->dbselected = mysql_select_db(DB_NAME, $this->link) or die ('O banco de dados não existe. Execute o script.');
    }
    
    public function __destruct() {        
//        mysql_close($this->link);
    }
}

?>
