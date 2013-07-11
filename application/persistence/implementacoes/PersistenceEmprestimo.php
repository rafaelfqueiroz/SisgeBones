<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmprestimoPersistence
 *
 * @author RAFAEL
 */
class EmprestimoPersistence extends AbstractPersistence implements EmprestimoDao{

    protected function conseguirNomeDaTabela() {
        return "Emprestimo";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Emprestimo();
            $model->id = $row["id"];
            $model->dataEmprestimo = $row["dataEmprestimo"];
            $model->dataDevolucao = $row["dataDevolucao"];
            $model->emprestante = $row["idEmprestante"];
            $model->osso = $row["idOsso"];
            $model->administrador = $row["idAdministrador"];
            $this->lista[] = $model;
        }
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "id";
        }
        $columns[] = "dataEmprestimo";
        $columns[] = "dataDevolucao";
        $columns[] = "emprestante";
        $columns[] = "osso";
        $columns[] = "administrador";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "dataEmprestimo = '$model->dataEmprestimo'";
        $columns[] = "dataDevolucao = '$model->dataDevolucao'";
        $columns[] = "emprestante = '$model->emprestante'";
        $columns[] = "osso = '$model->osso'";
        $columns[] = "administrador = '$model->administrador'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'$model->id'";
        $values[] = "'$model->dataEmprestimo'";
        $values[] = "'$model->dataDevolucao'";
        $values[] = "'$model->emprestante'";
        $values[] = "'$model->osso'";        
        $values[] = "'$model->administrador'";        
        return implode(', ', $values);
    }
}

?>
