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
        return "emprestimo";
    }

    protected function dadosParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Emprestimo();
            $model->setId($row["idEmprestimo"]);
            $model->setDataEmprestimo($row["dataEmprestimo"]);
            $model->setDataDevolucao($row["dataDevolucao"]);
            $model->setQuantidade($row["quantidadeEmprestimo"]);
            $model->setStatus($row["statusEmprestimo"]);
            $usuario = new Usuario();
            $usuario->setId($row["idUsuarioEmprestimo"]);
            $usuario->setLogin($row["loginUsuario"]);
            $usuario->setSenha($row["senhaUsuario"]);
            $usuario->setTipo($row["tipoUsuario"]);
            if($usuario->getTipo() == 2) {
                $professor = new Professor();
                $professor->setId($row["idAluno"]);
                $professor->setNome($row["nomeAluno"]);
                $professor->setRg($row["cursoAluno"]);
                $professor->setMatricula($row["matriculaAluno"]);
                $professor->setEmail($row["emailAluno"]);
                $professor->setUsuario($usuario);
                $usuario->setReferente($professor);
            } else if ($usuario->getTipo() == 3) {
                $aluno = new Aluno();
                $aluno->setId($row["idAluno"]);
                $aluno->setNome($row["nomeAluno"]);
                $aluno->setCurso($row["cursoAluno"]);
                $aluno->setMatricula($row["matriculaAluno"]);
                $aluno->setEmail($row["emailAluno"]);
                $aluno->setAtivo($row["ativo"]);
                $aluno->setEMonitor($row["eMonitor"]);
                $aluno->setUsuario($usuario);
                $usuario->setReferente($aluno);
            }
            $model->setUsuario($usuario);
            $administrador = new Administrador();
            $administrador->setId($row["idAdministrador"]);
            $administrador->setNome($row["nomeAdministrador"]);
            $administrador->setMatricula($row["matriculaAdministrador"]);
            $administrador->setEmail($row["emailAdministrador"]);
            $administrador->setModerador($row["moderador"]);
            $model->setAdministrador($administrador);
            $this->lista[] = $model;
        }
    }

    protected function listarColunas($addpk) {
        if ($addpk) {
            $columns[] = "idEmprestimo";
        }
        $columns[] = "dataEmprestimo";
        $columns[] = "dataDevolucao";
        $columns[] = "quantidadeEmprestimo";
        $columns[] = "statusEmprestimo";
        $columns[] = "idUsuarioEmprestimo";      
        $columns[] = "idAdministradorEmprestimo";
        return implode(', ', $columns);
    }

    protected function listarColunasComValores($model) {
        $columns[] = "dataEmprestimo = '{$model->getDataEmprestimo()}'";
        $columns[] = "dataDevolucao = '{$model->getDataDevolucao()}'";
        $columns[] = "quantidadeEmprestimo = '{$model->getQuantidade()}'";
        $columns[] = "statusEmprestimo = '{$model->getStatus()}'";
        $columns[] = "idUsuarioEmprestimo = '{$model->getUsuario()->getId()}'";
        $columns[] = "idAdministradorEmprestimo = '{$model->getAdministrador()->getId()}'";
        return implode(', ', $columns);
    }

    protected function listarValores($model) {
        $values[] = "'{$model->getDataEmprestimo()}'";
        $values[] = "'{$model->getDataDevolucao()}'";
        $values[] = "'{$model->getQuantidade()}'";
        $values[] = "'{$model->getStatus()}'";
        $values[] = "'{$model->getUsuario()->getId()}'";        
        $values[] = "'{$model->getAdministrador()->getId()}'";        
        return implode(', ', $values);
    }
    
    public function salvar($entidade) {
        $this->abrirConexao();
        $this->criarComando("INSERT INTO {$this->conseguirNomeDaTabela()} ({$this->listarColunas(false)}) VALUES ({$this->listarValores($entidade)})");
        $this->executarComando();
        $success = $this->resultado;
        if ($success) {
            $this->criarComando("select * FROM (SELECT e.idEmprestimo, e.dataEmprestimo, 
        e.dataDevolucao, e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, 
        e.idAdministradorEmprestimo, u.loginUsuario, u.senhaUsuario,
        u.tipoUsuario, al.idAluno, al.nomeAluno,al.matriculaAluno,al.emailAluno,
        al.cursoAluno, al.ativo, al.eMonitor, a.idAdministrador,
        a.nomeAdministrador, a.matriculaAdministrador, a.emailAdministrador,
        a.idUsuarioAdministrador, a.moderador FROM emprestimo AS e INNER JOIN
        usuario AS u ON e.idUsuarioEmprestimo = u.idUsuario INNER JOIN
        administrador AS a ON e.idAdministradorEmprestimo = a.idAdministrador
        INNER JOIN aluno AS al ON e.idUsuarioEmprestimo = al.idUsuarioAluno
        UNION
        SELECT e.idEmprestimo, e.dataEmprestimo, e.dataDevolucao,
        e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, e.idAdministradorEmprestimo,
        u.loginUsuario, u.senhaUsuario, u.tipoUsuario, p.idProfessor,
        p.nomeProfessor, p.matriculaProfessor, p.emailProfessor, p.rgProfessor,
        idUsuarioProfessor, u.idUsuario, a.idAdministrador, a.nomeAdministrador,
        a.matriculaAdministrador, a.emailAdministrador, a.idUsuarioAdministrador,
        a.moderador FROM emprestimo AS e INNER JOIN usuario AS u ON
        e.idUsuarioEmprestimo = u.idUsuario INNER JOIN administrador AS a ON
        e.idAdministradorEmprestimo = a.idAdministrador INNER JOIN professor AS
        p ON e.idUsuarioEmprestimo = p.idUsuarioProfessor) a ORDER BY
        idEmprestimo DESC LIMIT 1");
            $this->executarComando();
            if (gettype($this->resultado) != "boolean") {
                $this->dadosParaModel();
            }
            $emprestimoRegistrado = $this->lista[0];            
            foreach ($entidade->getOssos() as $osso) {
                $qtdEmprestado = $_SESSION["sContador"][$osso->getId()];
                $this->criarComando("INSERT INTO osso_emprestimo
                (idOssoOsso_Emprestimo, idEmprestimoOsso_Emprestimo, quantidadeOsso_Emprestimo) VALUES 
                ({$osso->getId()}, {$emprestimoRegistrado->getId()}, {$qtdEmprestado})");
                $this->executarComando();
            }
            $this->fecharConexao();
        } else {
            $this->fecharConexao();
        }
        return $this->resultado;
    }
    public function listar() {
        $this->abrirConexao();
        $this->criarComando("SELECT e.idEmprestimo, e.dataEmprestimo, 
        e.dataDevolucao, e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, 
        e.idAdministradorEmprestimo, u.loginUsuario, u.senhaUsuario,
        u.tipoUsuario, al.idAluno, al.nomeAluno,al.matriculaAluno,al.emailAluno,
        al.cursoAluno, al.ativo, al.eMonitor, a.idAdministrador,
        a.nomeAdministrador, a.matriculaAdministrador, a.emailAdministrador,
        a.idUsuarioAdministrador, a.moderador FROM emprestimo AS e INNER JOIN
        usuario AS u ON e.idUsuarioEmprestimo = u.idUsuario INNER JOIN
        administrador AS a ON e.idAdministradorEmprestimo = a.idAdministrador
        INNER JOIN aluno AS al ON e.idUsuarioEmprestimo = al.idUsuarioAluno
        UNION
        SELECT e.idEmprestimo, e.dataEmprestimo, e.dataDevolucao,
        e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, e.idAdministradorEmprestimo,
        u.loginUsuario, u.senhaUsuario, u.tipoUsuario, p.idProfessor,
        p.nomeProfessor, p.matriculaProfessor, p.emailProfessor, p.rgProfessor,
        idUsuarioProfessor, u.idUsuario, a.idAdministrador, a.nomeAdministrador,
        a.matriculaAdministrador, a.emailAdministrador, a.idUsuarioAdministrador,
        a.moderador FROM emprestimo AS e INNER JOIN usuario AS u ON
        e.idUsuarioEmprestimo = u.idUsuario INNER JOIN administrador AS a ON
        e.idAdministradorEmprestimo = a.idAdministrador INNER JOIN professor AS
        p ON e.idUsuarioEmprestimo = p.idUsuarioProfessor");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
//        var_dump($this->persistencia->listar());
//        exit();
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function listarPendentes() {
        $this->abrirConexao();
        $this->criarComando("SELECT e.idEmprestimo, e.dataEmprestimo, 
        e.dataDevolucao, e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, 
        e.idAdministradorEmprestimo, u.loginUsuario, u.senhaUsuario,
        u.tipoUsuario, al.idAluno, al.nomeAluno,al.matriculaAluno,al.emailAluno,
        al.cursoAluno, al.ativo, al.eMonitor, a.idAdministrador,
        a.nomeAdministrador, a.matriculaAdministrador, a.emailAdministrador,
        a.idUsuarioAdministrador, a.moderador FROM emprestimo AS e INNER JOIN
        usuario AS u ON e.idUsuarioEmprestimo = u.idUsuario INNER JOIN
        administrador AS a ON e.idAdministradorEmprestimo = a.idAdministrador
        INNER JOIN aluno AS al ON e.idUsuarioEmprestimo = al.idUsuarioAluno WHERE e.statusEmprestimo = 1
        UNION
        SELECT e.idEmprestimo, e.dataEmprestimo, e.dataDevolucao,
        e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, e.idAdministradorEmprestimo,
        u.loginUsuario, u.senhaUsuario, u.tipoUsuario, p.idProfessor,
        p.nomeProfessor, p.matriculaProfessor, p.emailProfessor, p.rgProfessor,
        idUsuarioProfessor, u.idUsuario, a.idAdministrador, a.nomeAdministrador,
        a.matriculaAdministrador, a.emailAdministrador, a.idUsuarioAdministrador,
        a.moderador FROM emprestimo AS e INNER JOIN usuario AS u ON
        e.idUsuarioEmprestimo = u.idUsuario INNER JOIN administrador AS a ON
        e.idAdministradorEmprestimo = a.idAdministrador INNER JOIN professor AS
        p ON e.idUsuarioEmprestimo = p.idUsuarioProfessor WHERE e.statusEmprestimo = 1");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    
    public function encontrarPorId($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT e.idEmprestimo, e.dataEmprestimo, 
        e.dataDevolucao, e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, 
        e.idAdministradorEmprestimo, u.loginUsuario, u.senhaUsuario,
        u.tipoUsuario, al.idAluno, al.nomeAluno,al.matriculaAluno,al.emailAluno,
        al.cursoAluno, al.ativo, al.eMonitor, a.idAdministrador,
        a.nomeAdministrador, a.matriculaAdministrador, a.emailAdministrador,
        a.idUsuarioAdministrador, a.moderador FROM emprestimo AS e INNER JOIN
        usuario AS u ON e.idUsuarioEmprestimo = u.idUsuario INNER JOIN
        administrador AS a ON e.idAdministradorEmprestimo = a.idAdministrador
        INNER JOIN aluno AS al ON e.idUsuarioEmprestimo = al.idUsuarioAluno 
        WHERE e.idEmprestimo = {$entidade->getId()}
        UNION
        SELECT e.idEmprestimo, e.dataEmprestimo, e.dataDevolucao,
        e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, e.idAdministradorEmprestimo,
        u.loginUsuario, u.senhaUsuario, u.tipoUsuario, p.idProfessor,
        p.nomeProfessor, p.matriculaProfessor, p.emailProfessor, p.rgProfessor,
        idUsuarioProfessor, u.idUsuario, a.idAdministrador, a.nomeAdministrador,
        a.matriculaAdministrador, a.emailAdministrador, a.idUsuarioAdministrador,
        a.moderador FROM emprestimo AS e INNER JOIN usuario AS u ON
        e.idUsuarioEmprestimo = u.idUsuario INNER JOIN administrador AS a ON
        e.idAdministradorEmprestimo = a.idAdministrador INNER JOIN professor AS
        p ON e.idUsuarioEmprestimo = p.idUsuarioProfessor 
        WHERE e.idEmprestimo = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->lista = NULL;
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }

    public function listarEmprestimosUsuario($usuario) {
        $this->abrirConexao();
        $this->criarComando("SELECT e.idEmprestimo, e.dataEmprestimo, 
        e.dataDevolucao, e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, 
        e.idAdministradorEmprestimo, u.loginUsuario, u.senhaUsuario,
        u.tipoUsuario, al.idAluno, al.nomeAluno,al.matriculaAluno,al.emailAluno,
        al.cursoAluno, al.ativo, al.eMonitor, a.idAdministrador,
        a.nomeAdministrador, a.matriculaAdministrador, a.emailAdministrador,
        a.idUsuarioAdministrador, a.moderador FROM emprestimo AS e INNER JOIN
        usuario AS u ON e.idUsuarioEmprestimo = u.idUsuario INNER JOIN
        administrador AS a ON e.idAdministradorEmprestimo = a.idAdministrador
        INNER JOIN aluno AS al ON e.idUsuarioEmprestimo = al.idUsuarioAluno WHERE
        e.idUsuarioEmprestimo = {$usuario->getId()}
        UNION
        SELECT e.idEmprestimo, e.dataEmprestimo, e.dataDevolucao,
        e.statusEmprestimo, e.quantidadeEmprestimo, e.idUsuarioEmprestimo, e.idAdministradorEmprestimo,
        u.loginUsuario, u.senhaUsuario, u.tipoUsuario, p.idProfessor,
        p.nomeProfessor, p.matriculaProfessor, p.emailProfessor, p.rgProfessor,
        idUsuarioProfessor, u.idUsuario, a.idAdministrador, a.nomeAdministrador,
        a.matriculaAdministrador, a.emailAdministrador, a.idUsuarioAdministrador,
        a.moderador FROM emprestimo AS e INNER JOIN usuario AS u ON
        e.idUsuarioEmprestimo = u.idUsuario INNER JOIN administrador AS a ON
        e.idAdministradorEmprestimo = a.idAdministrador INNER JOIN professor AS
        p ON e.idUsuarioEmprestimo = p.idUsuarioProfessor WHERE
        e.idUsuarioEmprestimo = {$usuario->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
    public function dadosOssoEmprestimoParaModel() {
        while ($row = mysql_fetch_array($this->resultado)) {
            $model = new Osso();
            $model->setId($row["idOsso"]);
            $model->setNome($row["nomeOsso"]);
            $model->setCodigo($row["codigoOsso"]);
            $model->setQuantidade($row["quantidadeOsso"]);
            $model->setQtdDisponivel($row["disponivelOsso"]);
            $model->setQtdEmprestada($row["quantidadeOsso_Emprestimo"]);
            $this->lista[] = $model;
        }
    }
    public function listarOssosDeEmprestimo($entidade) {
        $this->abrirConexao();
        $this->criarComando("SELECT * FROM osso_emprestimo as oe INNER JOIN osso
        AS o ON oe.idOssoOsso_Emprestimo = o.idOsso WHERE idEmprestimoOsso_Emprestimo = {$entidade->getId()}");
        $this->executarComando();
        if (gettype($this->resultado) != "boolean") {
            $this->dadosOssoEmprestimoParaModel();
        }
        $this->fecharConexao();
        return $this->lista;
    }
}

?>
