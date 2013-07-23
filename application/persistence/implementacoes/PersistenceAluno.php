<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoPersistence
 *
 * @author RAFAEL
 */
class AlunoPersistence extends AbstractPersistence implements AlunoDao{

    protected function conseguirNomeDaTabela() {
        return "Aluno";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Aluno();
            $model->setId($row["id"]);
            $model->setNome($row["nome"]);
            $model->setMatricula($row["matricula"]);
            $model->setCurso($row["curso"]);
            $model->setEmail($row["email"]);            
            $model->setEMonitor($row["eMonitor"]);
            $model->setAtivo($row["ativo"]);
            
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
        $columns[] = "curso";
        $columns[] = "email";
        $columns[] = "eMonitor";
        $columns[] = "ativo";
        $columns[] = "idUsuario";        
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '{$model->getNome()}'";
        $columns[] = "matricula = '{$model->getMatricula()}'";
        $columns[] = "curso = '{$model->getCurso()}'";
        $columns[] = "email = '{$model->getEmail()}'";        
        $columns[] = "eMonitor = '{$model->getEMonitor()}'";
        $columns[] = "ativo = '{$model->getAtivo()}'";
        $columns[] = "idUsuario = '{$model->getUsuario()->getId()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getMatricula()}'";
        $values[] = "'{$model->getCurso()}'";
        $values[] = "'{$model->getEmail()}'";        
        $values[] = "'{$model->getEMonitor()}'";
        $values[] = "'{$model->getAtivo()}'";
        $values[] = "'{$model->getUsuario()->getId()}'";
        return implode(', ', $values);
    }
    
    public function encontrarAlunoPorIdUsuario($idUsuario) {
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
        $this->criarComando("SELECT t.id, t.nome, t.matricula, t.curso, t.email, t.eMonitor, 
                t.idUsuario, t.ativo, u.login, u.senha, u.tipo FROM {$this->conseguirNomeDaTabela()} AS t 
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
        $this->criarComando("SELECT t.id, t.nome, t.matricula, t.curso, t.email, t.eMonitor, 
                t.idUsuario, t.ativo, u.login, u.senha, u.tipo FROM {$this->conseguirNomeDaTabela()} AS t 
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
