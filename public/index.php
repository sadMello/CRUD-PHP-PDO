<?php
require_once 'pessoa.php';
$p = new Pessoa("CRUD", "db", "root", "root");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CADASTRO DE PESSOAS</title>
    <link rel=stylesheet href="estilo.css">
</head>

<body>
    <?php
    if (isset($_POST['nome'])) { //clicou no botão cadastrar ou editar

        //-------------------EDITAR-------------------
        if (isset($_GET['id_up']) && !empty($_GET['id_up'])) {
            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            //verificar se está preenchido
            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $p->atualizarDados($id_upd, $nome, $email, $senha);
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
                exit;
            } else {
    ?>
                <div class="aviso">
                    <h4>Preencha todos os campos!</h4>
                </div>
                <?php
            }
        }
        //-------------------CADASTRAR-------------------
        else {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            //verificar se está preenchido
            if (!empty($nome) && !empty($email) && !empty($senha)) {
                if (!$p->cadastrarPessoa($nome, $email, $senha)) {
                ?>
                    <div class="aviso">
                        <h4>Email já cadastrado</h4>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="aviso">
                    <h4>Preencha todos os campos!</h4>
                </div>
    <?php
            }
        }
    }
    ?>
    <?php
    if (isset($_GET['id_up'])) { // se a pessoa clicou em editar
        $id_update = addslashes($_GET['id_up']); // proteção contra sql injection
        $res = $p->buscarDadosPessoa($id_update);
    }
    ?>
    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php if (isset($res)) {
                                                                echo $res['nome'];
                                                            } ?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if (isset($res)) {
                                                                    echo $res['email'];
                                                                } ?>">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" value="<?php if (isset($res)) {
                                                                        echo $res['senha'];
                                                                    } ?>">
            <input type="submit" value="<?php if (isset($res)) {
                                            echo "Atualizar";
                                        } else {
                                            echo "Cadastrar";
                                        } ?>">
        </form>
    </section>
    <section id="direita">
        <table>
            <tr>
                <td>NOME</td>
                <td>EMAIL</td>
                <td>SENHA</td>
                <td>AÇÕES</td>
            </tr>
            <?php
            $dados = $p->buscarDados();
            if (count($dados) > 0) {
                for ($i = 0; $i < count($dados); $i++) {
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id") {
                            echo "<td>" . $v . "</td>";
                        }
                    }
            ?>
                    <td>
                        <a href="index.php?id_up=<?php echo $dados[$i]['id']; ?>">Editar</a>
                        <a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a>
                    </td>
                <?php
                    echo "</tr>";
                }
            } else {
                ?>
                <div class="aviso">
                    <h4>Ainda não há pessoas cadastradas!</h4>
                </div>
            <?php
            }
            ?>
        </table>
    </section>
</body>

</html>

<?php
if (isset($_GET['id'])) {
    $id_pessoa = addslashes($_GET['id']); // proteção contra sql injection
    $p->excluirPessoa($id_pessoa);
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit;
}
?>