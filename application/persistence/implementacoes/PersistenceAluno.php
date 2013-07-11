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
            $model->id = $row["id"];
            $model->nome = $row["nome"];
            $model->matricula = $row["matricula"];
            $model->email = $row["email"];
            $model->senha = $row["senha"];
            $model->curso = $row["curso"];
            $model->eMonitor = $row["monitor"];
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
        $columns[] = "curso";
        $columns[] = "monitor";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '$model->nome'";
        $columns[] = "matricula = '$model->matricula'";
        $columns[] = "email = '$model->email'";
        $columns[] = "senha = '$model->senha'";
        $columns[] = "curso = '$model->curso'";
        $columns[] = "monitor = '$model->eMonitor'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'$model->id'";
        $values[] = "'$model->nome'";
        $values[] = "'$model->matricula'";
        $values[] = "'$model->email'";
        $values[] = "'$model->senha'";
        $values[] = "'$model->curso'";
        $values[] = "'$model->monitor'";
        return implode(', ', $values);
    }
}

?>
