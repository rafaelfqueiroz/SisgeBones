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
            $model->id = $row["id"];
            $model->nome = $row["nome"];
            $model->matricula = $row["matricula"];
            $model->email = $row["email"];
            $model->senha = $row["senha"];
            $model->senha = $row["rg"];
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
        $columns[] = "senha";
        $columns[] = "rg";
        return implode(', ', $columns);
    }
    protected function listarColunasComValores($model) {
        $columns[] = "nome = '$model->nome'";
        $columns[] = "matricula = '$model->matricula'";
        $columns[] = "email = '$model->email'";
        $columns[] = "senha = '$model->senha'";
        $columns[] = "rg = '$model->rg'";
        return implode(', ', $columns);        
    }
    protected function listarValores($model) {
        $values[] = "'$model->id'";
        $values[] = "'$model->nome'";
        $values[] = "'$model->matricula'";
        $values[] = "'$model->email'";
        $values[] = "'$model->senha'";
        $values[] = "'$model->rg'";
        return implode(', ', $values);
    }
}

?>
