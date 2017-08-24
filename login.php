<?php
session_start();

//para redireciona-lo caso já esteja logado
if(isset($_SESSION['user_id'])){
    header("Location: logado.php");
}

//incluindo o banco de dados
require 'database.php';

//verificando os dados no banco de dados
if(!empty($_POST['email']) && !empty($_POST['password'])):

    $records = $conn->prepare('SELECT * FROM users WHERE email = :email, AND password = :password');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    //verificar e direcionar a página de usuários
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id'];
        header("Location: logado.php");


    } else{
        $message = 'Os dados inseridos estão incorretos';
    }


endif;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login do Sistema</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
<!--para voltar a página raiz -->
<div class="header">
    <a href="index.php">Home Security</a>
</div>

<?php
if(!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<h1>Login</h1>
<span>ou <a href="register.php">Cadastrar</a></span>

<form method="POST" action="login.php">
    <input type="text" name="email" placeholder="Digite seu email" />
    <input type="password" name="password" placeholder="Digite sua senha" />
    <input type="submit"  value="Entrar" />
</form>
</body>
</html>