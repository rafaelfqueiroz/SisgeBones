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
            $model->setId($row["idUsuario"]);
            $model->setLogin($row["loginUsuario"]);
            $model->setSenha($row["senhaUsuario"]);
            $model->setTipo($row["tipoUsuario"]);
            $this->lista[] = $model;
        }        
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "idUsuario";
        }
        $columns[] = "loginUsuario";
        $columns[] = "senhaUsuario";
        $columns[] = "tipoUsuario";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "loginUsuario = '{$model->getLogin()}'";
        $columns[] = "senhaUsuario = '{$model->getSenha()}'";
        $columns[] = "tipoUsuario = '{$model->getTipo()}'";
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
        $this->criarComando("SELECT * FROM Usuario WHERE loginUsuario = '{$login}'");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }

    public function encontrarPorLoginESenha($login, $senha) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM Usuario WHERE loginUsuario = '{$login}'
        and senhaUsuario = '{$senha}'");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
