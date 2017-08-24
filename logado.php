
<?php
session_start();

require 'database.php';

//para conectar com o banco e nos dar a possibilidade de buscar no banco os dados do usuario

if(isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0 ) {
        $user = $results;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Menbros Cadastrados</title>
</head>
<body>
<!--condição para q quem não esteja logado acesse a página de menbros e também para exibir o nome do usuário na área da página-->
<?php
if(!empty($user)): ?>

    <br />Bemvindo. <?= $user['email'];?>
    <br /><br /> Login efetuado com sucesso !

    <br /><br />

    <a href="logout.php">Sair</a>

<?php else:	?>

    <h1>Por Favor Logar ou Fazer Registro</h1>

    <a href="login.php">Login</a> or
    <a href="register.php">Cadastrar</a>

<?php endif; ?>

</body>
</html>