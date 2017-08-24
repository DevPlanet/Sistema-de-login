<?php

session_start();
//para redireciona-lo caso já esteja logado
if(isset($_SESSION['user_id'])){
    header("Location: logado.php");
}

require 'database.php';

$message ='';
if(!empty($_POST['email']) && !empty($_POST['password'])):

    // Enter the new user in the database
    $sql = "INSERT INTO users (email,password, confirm_password) VALUES (:email, :password, :confirm_password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

    if ($stmt->execute()):
        $message = 'Novo Usuário criado com sucesso';
    else:
        $message = 'Desculpe, algo deu errado ao registrar usuário';
    endif;

endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de ususários</title>
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

<h1>Cadastrar</h1>
<span>ou <a href="login.php">Faça seu login Aqui</a></span>


<form method="POST" action="register.php">
    <input type="text" name="email" placeholder="Digite um E-mail válido" />
    <input type="password" name="password" placeholder="Digite uma senha" />
    <input type="password" name="confirm_password" placeholder="Confirmar senha">
    <input type="submit"  value="Enviar Formulário" />
</form>
</body>
</html>