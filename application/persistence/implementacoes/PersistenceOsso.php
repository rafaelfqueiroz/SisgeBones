<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OssoPersistence
 *
 * @author RAFAEL
 */
class OssoPersistence extends AbstractPersistence implements Osso {

    protected function conseguirNomeDaTabela() {
        return "Osso";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Osso();
            $model->id = $row["id"];
            $model->nome = $row["nome"];
            $model->matricula = $row["quantidade"];
            $model->email = $row["codigo"];
            $this->lista[] = $model;
        }
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "id";
        }
        $columns[] = "nome";
        $columns[] = "quantidade";
        $columns[] = "codigo";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '$model->nome'";
        $columns[] = "matricula = '$model->quantidade'";
        $columns[] = "email = '$model->codigo'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'$model->id'";
        $values[] = "'$model->nome'";
        $values[] = "'$model->quantidade'";
        $values[] = "'$model->codigo'";
        return implode(', ', $values);
    }
}

?>
