<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfessorPersistence
 *
 * @author RAFAEL
 */
class ProfessorPersistence extends AbstractPersistence implements ProfessorDao{
    
    protected function conseguirNomeDaTabela() {
        return "Professor";
    }
    protected function dadosParaModel() {        
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Professor();
            $model->setId($row["id"]);
            $model->setNome($row["nome"]);
            $model->setMatricula($row["matricula"]);
            $model->setEmail($row["email"]);
            $model->setRg($row["rg"]);
                        
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
        $columns[] = "rg";
        $columns[] = "idUsuario";
        return implode(', ', $columns);
    }
    protected function listarColunasComValores($model) {
        $columns[] = "nome = '{$model->getNome()}'";
        $columns[] = "matricula = '{$model->getMatricula()}'";
        $columns[] = "email = '{$model->getEmail()}'";
        $columns[] = "rg = '{$model->getRg()}'";
        $columns[] = "idUsuario = '{$model->getUsuario()->getId()}'";
        return implode(', ', $columns);
    }
    protected function listarValores($model) {
        var_dump($model);
        echo "<br/>";echo "<br/>";  
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getMatricula()}'";
        $values[] = "'{$model->getEmail()}'";
        $values[] = "'{$model->getRg()}'";
        $values[] = "'{$model->getUsuario()->getId()}'";
        return implode(', ', $values);
    }
    
    public function encontrarProfessorPorIdUsuario($idUsuario) {
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
    
    public function listarComoUsuario() {
        $this->abrirConexao();
        $this->criarComando("SELECT t.id, t.nome, t.matricula, t.email, t.rg, t.idUsuario,
                u.login, u.senha, u.tipo FROM {$this->conseguirNomeDaTabela()} AS t 
        INNER JOIN Usuario AS u ON t.idUsuario = u.id");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function encontrarPorId($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT t.id, t.nome, t.matricula, t.email, t.rg, t.idUsuario,
                u.login, u.senha, u.tipo FROM {$this->conseguirNomeDaTabela()} AS t 
        INNER JOIN Usuario AS u ON t.idUsuario = u.id WHERE t.id = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
