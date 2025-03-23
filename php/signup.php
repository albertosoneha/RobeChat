<?php
include_once("config.php"); // Inclui o arquivo de configuração

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Se o método de requisição for POST
    $fname = isset($_POST['fname']) ? $_POST['fname'] : null;
    $lname = isset($_POST['lname']) ? $_POST['lname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if (!$fname || !$lname || !$email || !$password) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    $fname = mysqli_real_escape_string($conn, $_POST['fname']); // Recebe o primeiro nome
    $lname = mysqli_real_escape_string($conn, $_POST['lname']); // Recebe o último nome
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Recebe o email
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Recebe a senha

}