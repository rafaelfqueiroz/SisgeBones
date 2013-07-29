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
            $model->setId($row["idOsso"]);
            $model->setNome($row["nomeOsso"]);
            $model->setQuantidade($row["quantidadeOsso"]);
            $model->setCodigo($row["codigoOsso"]);
            $this->lista[] = $model;
        }        
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "idOsso";
        }
        $columns[] = "nomeOsso";
        $columns[] = "quantidadeOsso";
        $columns[] = "codigoOsso";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "nomeOsso = '{$model->getNome()}'";
        $columns[] = "quantidadeOsso = '{$model->getQuantidade()}'";
        $columns[] = "codigoOsso = '{$model->getCodigo()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getNome()}'";
        $values[] = "'{$model->getQuantidade()}'";
        $values[] = "'{$model->getCodigo()}'";
        return implode(', ', $values);
    }
    
    public function encontrarPorCodigo($codigo) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} WHERE codigoOsso = '{$codigo}'");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
