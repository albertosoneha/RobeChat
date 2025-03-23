<?php
    $conn = mysqli_connect("localhost", "root", "", "robechat"); // host, usuário, senha, banco de dados
    if(!$conn){
        echo "Base de dados conectada!" . mysqli_connect_error(); // Se a conexão for bem sucedida, exibe a mensagem
    }
?>