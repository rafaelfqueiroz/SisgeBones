<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persistencia
 *
 * @author RAFAEL
 */
include_once '../../application/persistence/implementacoes/Conexao.php';

abstract class AbstractPersistence implements Dao{
    
    #@region: Atributos
    protected $conexao;
    protected $resultado;
    protected $lista;
    
    #@region: Configuração
    abstract protected function listarColunas($addpk);
    abstract protected function listarValores($model);
    abstract protected function listarColunasComValores($model);
    abstract protected function conseguirNomeDaTabela();
    abstract protected function dadosParaModel();


    #@region: Funções auxiliares
    
    protected function abrirConexao() {
       $this->conexao = new Conexao();
    }
    
    protected function fecharConexao() {
        $this->conexao = null;
    }
    
    protected function criarComando($query) {        
        $this->conexao->command = $query;
    }
    
    protected function executarComando() {        
        $this->resultado = mysql_query($this->conexao->command);
    }

    public function encontrarPorId($entidade) {        
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()} WHERE id = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }

    public function listar() {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM {$this->conseguirNomeDaTabela()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }    
    
    public function atualizar($entidade) {
        $this->abrirConexao();
        $this->criarComando("UPDATE {$this->conseguirNomeDaTabela()} SET {$this->listarColunasComValores($entidade)} WHERE id = {$entidade->getId()}");
        $this->executarComando();        
        $this->fecharConexao();
        return $this->resultado;
    }

    public function remover($entidade) {
        $this->abrirConexao();
        $this->criarComando("DELETE FROM {$this->conseguirNomeDaTabela()} WHERE id = {$entidade->getId()}");
        $this->executarComando();
        $this->fecharConexao();
        return $this->resultado; 
    }

    public function salvar($entidade) {               
        $this->abrirConexao();
        $this->criarComando("INSERT INTO {$this->conseguirNomeDaTabela()} ({$this->listarColunas(false)}) VALUES ({$this->listarValores($entidade)})");
        $this->executarComando();
        $this->fecharConexao();
        return $this->resultado;
    }
}

?>
