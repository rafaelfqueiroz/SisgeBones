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
class UsuarioPersistence extends AbstractPersistence implements UsuarioDao {

    protected function conseguirNomeDaTabela() {
        return "Usuario";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Usuario();
            $model->setId($row["id"]);
            $model->setLogin($row["login"]);
            $model->setSenha($row["senha"]);
            $model->setTipo($row["tipo"]);
            $this->lista[] = $model;
        }        
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "id";
        }
        $columns[] = "login";
        $columns[] = "senha";
        $columns[] = "tipo";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "login = '{$model->getLogin()}'";
        $columns[] = "senha = '{$model->getSenha()}'";
        $columns[] = "tipo = '{$model->getTipo()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getLogin()}'";
        $values[] = "'{$model->getSenha()}'";
        $values[] = "'{$model->getTipo()}'";
        return implode(', ', $values);
    }

    public function encontrarPorLogin($login) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} WHERE login = '{$login}'");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }

    public function encontrarPorLoginESenha($login, $senha) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} 
        WHERE login = '{$login}' and senha = '{$senha}'");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
