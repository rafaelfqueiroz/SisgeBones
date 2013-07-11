<?php

/**
 * Description of AdministradorPersistence
 *
 * @author RAFAEL
 */
class AdministradorPersistence extends AbstractPersistence implements AdministradorDao {

    protected function conseguirNomeDaTabela() {
        return "Administrador";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Administrador();
            $model->id = $row["id"];
            $model->nome = $row["nome"];
            $model->matricula = $row["matricula"];
            $model->email = $row["email"];
            $model->senha = $row["senha"];
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
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nome = '$model->nome'";
        $columns[] = "matricula = '$model->matricula'";
        $columns[] = "email = '$model->email'";
        $columns[] = "senha = '$model->senha'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'$model->id'";
        $values[] = "'$model->nome'";
        $values[] = "'$model->matricula'";
        $values[] = "'$model->email'";
        $values[] = "'$model->senha'";        
        return implode(', ', $values);
    }
}

?>
