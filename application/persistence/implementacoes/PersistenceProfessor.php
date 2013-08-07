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
        return "professor";
    }
    protected function dadosParaModel() {        
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Professor();
            $model->setId($row["idProfessor"]);
            $model->setNome($row["nomeProfessor"]);
            $model->setMatricula($row["matriculaProfessor"]);
            $model->setEmail($row["emailProfessor"]);
            $model->setRg($row["rgProfessor"]);
                        
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
            $columns[] = "idProfessor";
        }
        $columns[] = "nomeProfessor";
        $columns[] = "matriculaProfessor";
        $columns[] = "emailProfessor";
        $columns[] = "rgProfessor";
        $columns[] = "idUsuarioProfessor";
        return implode(', ', $columns);
    }
    protected function listarColunasComValores($model) {
        $columns[] = "nomeProfessor = '{$model->getNome()}'";
        $columns[] = "matriculaProfessor = '{$model->getMatricula()}'";
        $columns[] = "emailProfessor = '{$model->getEmail()}'";
        $columns[] = "rgProfessor = '{$model->getRg()}'";
        $columns[] = "idUsuarioProfessor = '{$model->getUsuario()->getId()}'";
        return implode(', ', $columns);
    }
    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getMatricula()}'";
        $values[] = "'{$model->getEmail()}'";
        $values[] = "'{$model->getRg()}'";
        $values[] = "'{$model->getUsuario()->getId()}'";
        return implode(', ', $values);
    }
    
    public function encontrarProfessorPorIdUsuario($idUsuario) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM professor AS t INNER JOIN usuario AS 
        u ON t.idUsuarioProfessor = u.idUsuario WHERE idUsuarioProfessor = {$idUsuario}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function listarComoUsuario() {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM professor AS t 
        INNER JOIN usuario AS u ON t.idUsuarioProfessor = u.idUsuario");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function encontrarPorId($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} AS t 
        INNER JOIN usuario AS u ON t.idUsuarioProfessor = u.idUsuario WHERE 
        t.idProfessor = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
