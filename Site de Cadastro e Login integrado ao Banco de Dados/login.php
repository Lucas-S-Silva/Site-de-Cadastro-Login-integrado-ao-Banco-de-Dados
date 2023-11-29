<?php
include('conexao.php');

session_start();

if (isset($_POST['usuario2']) && isset($_POST['senhalog'])) {
    $email = $mysqli->real_escape_string($_POST['usuario2']);
    $senha = $mysqli->real_escape_string($_POST['senhalog']);

    $senha = hash('sha256', $senha); // Aplica o mesmo hash à senha fornecida para comparação no banco de dados

    $sql_code = "SELECT * FROM users WHERE nome = '$email' AND senha = '$senha'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: painel.php");
        exit();
    } else {
        echo "Falha ao logar! E-mail ou senha incorretos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
        <link
          href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
          rel="stylesheet"
        />
</head>
<body>
          <div class="login-box">
          <h1>Login</h1>
    <form action="" method="POST">
        
            <label>Usuario</label>
            <input type="text" name="usuario2">
      
            <label>Senha</label>
            <input type="password" name="senhalog">
        
            <button type="submit" name="logar">Entrar</button>
        
    </form>
    </div>
        <p class="para-2">
          Primeira vez? <a href="index.html">Se cadastre-se</a>
        </p>
</body>
</html>