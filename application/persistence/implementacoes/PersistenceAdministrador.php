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
            $model->setId($row["id"]);
            $model->setNome($row["nome"]);
            $model->setMatricula($row["matricula"]);
            $model->setEmail($row["email"]);
            $model->setModerador($row["moderador"]);
            
            $usuario = new Usuario();
            $usuario->setId($row["idUsuario"]);
            $usuario->setLogin($row["login"]);
            $usuario->setSenha($row["senha"]);
            $usuario->setTipo($row["tipo"]);
            
            $model->setUsuario($usuario);
            $this->lista[] = $model;
        }
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "id";
        }
        $columns[] = "nome";
        $columns[] = "matricula";
        $columns[] = "email";
        $columns[] = "moderador";
        $columns[] = "idUsuario";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '{$model->getNome()}'";
        $columns[] = "matricula = '{$model->getMatricula()}'";
        $columns[] = "email = '{$model->getEmail()}'";
        $columns[] = "moderador = '{$model->getModerador()}'";
        $columns[] = "idUsuario = '{$model->getUsuario()->getId()}'";
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
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} AS t 
        INNER JOIN Usuario AS u ON t.idUsuario = u.id WHERE idUsuario = {$idUsuario}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
