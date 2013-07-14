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
            $model->setUsuario($row["idUsuario"]);
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
        $columns[] = "idUsuario";        
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '{$model->getNome()}'";
        $columns[] = "matricula = '{$model->getMatricula()}'";
        $columns[] = "curso = '{$model->getCurso()}'";
        $columns[] = "email = '{$model->getEmail()}'";        
        $columns[] = "eMonitor = '{$model->getEMonitor()}'";
        $columns[] = "idUsuario = '{$model->getUsuario()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getMatricula()}'";
        $values[] = "'{$model->getCurso()}'";
        $values[] = "'{$model->getEmail()}'";        
        $values[] = "'{$model->getEMonitor()}'";
        $values[] = "'{$model->getUsuario()}'";
        return implode(', ', $values);
    }
}

?>
