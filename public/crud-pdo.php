<?php


try {
    $pdo = new PDO("mysql:host=db;dbname=CRUD","root","root");
}
catch (PDOException $e) {
    echo "Error com banco de dados: " . $e->getMessage();
}
catch (Exception $e) {
    echo "Error genérico: " . $e->getMessage();
}

//-------------------CREATE-------------------

$res = $pdo->prepare("INSERT INTO usuarios(nome, email, senha) VALUES(:nome, :email, :senha)");

$res->bindValue(":nome","Wanderson");
$res->bindValue(":email","email@mail.com");
$res->bindValue(":senha","123456");

$res->execute();

$nome="MELLO";
$email="sim@sim.com";
$senha="123";

$res->bindValue(":nome",$nome);
$res->bindValue(":email",$email);
$res->bindValue(":senha",$senha);

$res->execute();

$pdo->query("INSERT INTO usuarios(nome, email, senha) VALUES('nome falso', 'miau@gato.com','calango')");


// -------------------DELETE----------------

$cmd = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
$cmd->bindValue(":id", 2);
$cmd->execute();

// -------------------UPDATE----------------

$cmd = $pdo->prepare("UPDATE usuarios SET email = :email WHERE id = :id");
$cmd->bindValue(":email", "lelelele@mello.com");
$cmd->bindValue(":id", 1);
$cmd->execute();

// -------------------READ----------------
$cmd = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$cmd->bindValue(":id", 1);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as $key => $value) {
    echo $key.": ".$value."<br>";
}


?>