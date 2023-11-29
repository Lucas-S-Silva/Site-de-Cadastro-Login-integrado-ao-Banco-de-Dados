<?php
include("conexao.php");
// Recupere os valores do formulário
$us1 = $_POST['usuario1'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if($senha == $confirmar_senha){
            
    $senha_hash = hash('sha256', $senha);
    $sql = "INSERT INTO users (nome, senha) VALUES ('$us1', '$senha_hash')";
    // Executa a query
        if ($mysqli->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro na inserção: ";
        }
        // Fecha a conexão
        $mysqli->close();
    header('Location: login.php');
         
 }else {
     header('Location: falha.html');   
 }

?>
