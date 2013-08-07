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
        return "aluno";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Aluno();
            $model->setId($row["idAluno"]);
            $model->setNome($row["nomeAluno"]);
            $model->setMatricula($row["matriculaAluno"]);
            $model->setCurso($row["cursoAluno"]);
            $model->setEmail($row["emailAluno"]);            
            $model->setEMonitor($row["eMonitor"]);
            $model->setAtivo($row["ativo"]);
            
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
            $columns[] = "idAluno";
        }
        $columns[] = "nomeAluno";
        $columns[] = "matriculaAluno";
        $columns[] = "cursoAluno";
        $columns[] = "emailAluno";
        $columns[] = "eMonitor";
        $columns[] = "ativo";
        $columns[] = "idUsuarioAluno";        
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nomeAluno = '{$model->getNome()}'";
        $columns[] = "matriculaAluno = '{$model->getMatricula()}'";
        $columns[] = "cursoAluno = '{$model->getCurso()}'";
        $columns[] = "emailAluno = '{$model->getEmail()}'";        
        $columns[] = "eMonitor = '{$model->getEMonitor()}'";
        $columns[] = "ativo = '{$model->getAtivo()}'";
        $columns[] = "idUsuarioAluno = '{$model->getUsuario()->getId()}'";
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
        $this->criarComando("SELECT * FROM aluno AS t INNER JOIN usuario AS u ON
        t.idUsuarioAluno = u.idUsuario WHERE idUsuarioAluno = {$idUsuario}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function listarComoUsuario() {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM aluno AS t INNER JOIN usuario AS u ON
        t.idUsuarioAluno = u.idUsuario");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function encontrarPorId($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM aluno AS t INNER JOIN usuario AS u ON
        t.idUsuarioAluno = u.idUsuario WHERE t.idAluno = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }

    public function listarMonitores() {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM aluno AS t INNER JOIN usuario AS u ON
        t.idUsuarioAluno = u.idUsuario WHERE eMonitor = 1");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
