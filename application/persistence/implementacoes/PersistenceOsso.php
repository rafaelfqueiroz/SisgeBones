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
class OssoPersistence extends AbstractPersistence implements OssoDao {

    protected function conseguirNomeDaTabela() {
        return "Osso";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Osso();
            $model->setId($row["id"]);
            $model->setNome($row["nome"]);
            $model->setQuantidade($row["quantidade"]);
            $model->setEmail($row["codigo"]);
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
        $columns[] = "nome = '$model->getNome()'";
        $columns[] = "matricula = '$model->getQuantidade()'";
        $columns[] = "email = '$model->getCodigo()'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getQuantidade()}'";
        $values[] = "'{$model->getCodigo()}'";
        return implode(', ', $values);
    }
}

?>
