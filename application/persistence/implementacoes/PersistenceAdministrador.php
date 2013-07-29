<?php

/**
 * Description of AdministradorPersistence
 *
 * @author RAFAEL
 */
class AdministradorPersistence extends AbstractPersistence implements AdministradorDao {

    protected function conseguirNomeDaTabela() {
        return "Administrador";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Administrador();
            $model->setId($row["idAdministrador"]);
            $model->setNome($row["nomeAdministrador"]);
            $model->setMatricula($row["matriculaAdministrador"]);
            $model->setEmail($row["emailAdministrador"]);
            $model->setModerador($row["moderador"]);
            
            $usuario = new Usuario();
            $usuario->setId($row["idUsuario"]);
            $usuario->setLogin($row["loginUsuario"]);
            $usuario->setSenha($row["senhaUsuario"]);
            $usuario->setTipo($row["tipoUsuario"]);
            
            $model->setUsuario($usuario);
            
            $this->lista[] = $model;
        }
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "idAdministrador";
        }
        $columns[] = "nomeAdministrador";
        $columns[] = "matriculaAdministrador";
        $columns[] = "emailAdministrador";
        $columns[] = "moderador";
        $columns[] = "idUsuarioAdministrador";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nomeAdministrador = '{$model->getNome()}'";
        $columns[] = "matriculaAdministrador = '{$model->getMatricula()}'";
        $columns[] = "emailAdministrador = '{$model->getEmail()}'";
        $columns[] = "moderador = '{$model->getModerador()}'";
        $columns[] = "idUsuarioAdministrador = '{$model->getUsuario()->getId()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getMatricula()}'";
        $values[] = "'{$model->getEmail()}'";
        $values[] = "'{$model->getModerador()}'";
        $values[] = "'{$model->getUsuario()->getId()}'";
        return implode(', ', $values);
    }
    
    public function encontrarAdministradorPorIdUsuario($idUsuario) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM Administrador AS t INNER JOIN Usuario 
        AS u ON t.idUsuarioAdministrador = u.idUsuario WHERE idUsuarioAdministrador = {$idUsuario}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function listarComoUsuario() {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM Administrador AS t 
        INNER JOIN Usuario AS u ON t.idUsuarioAdministrador = u.idUsuario");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function encontrarPorId($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM Administrador AS t INNER JOIN Usuario 
        AS u ON t.idUsuarioAdministrador = u.idUsuario WHERE t.idAdministrador = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
