<?php

class Pessoa
{
    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro como Banco de dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico: " . $e->getMessage();
        }
    }

    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios ORDER BY id DESC"); // DESC = decrescente
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC = array associativo e economizar memoria
        return $res;
    }

    public function cadastrarPessoa($nome, $email, $senha)
    {
        $cmd = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":s", $senha);
            $cmd->execute();
            return true;
        }
    }

    public function excluirPessoa($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    public function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC); // transformar num array associativo
        return $res;
    }

    public function atualizarDados($id, $nome, $email, $senha)
    {

        $cmd = $this->pdo->prepare("UPDATE usuarios SET nome = :n, email = :e, senha = :s WHERE id = :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":s", $senha);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
}
