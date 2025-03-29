<?php

session_start(); // Inicia a sessão do usuário para armazenar os dados do usuário no servidor e manter o usuário logado

include_once "config.php"; // Inclui o arquivo de configuração para conectar ao banco de dados

// Recebendo os dados do formulário
$fname = mysqli_real_escape_string($conn, $_POST['fname']); // Recebe o primeiro nome do usuário apartir do formulário
$lname = mysqli_real_escape_string($conn, $_POST['lname']); // Recebe o último nome do usuário apartir do formulário
$email = mysqli_real_escape_string($conn, $_POST['email']); // Recebe o email do usuário apartir do formulário
$password = mysqli_real_escape_string($conn, $_POST['password']); // Recebe a senha do usuário apartir do formulário

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {  // se os campos estão preenchidos
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Se o email for válido
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'"); // Verifica se o email já está no banco de dados
        if (mysqli_num_rows($sql) > 0) { // Se o email já estiver no banco de dados
            echo "$email - Este email já existe!"; // Exibe mensagem de erro
        } else { //
            if (isset($_FILES['image'])) { // Se o arquivo foi carregado
                $img_name = $_FILES['image']['name']; // Recebe o nome da imagem 
                $tmp_name = $_FILES['image']['tmp_name']; // // Recebe o nome temporário da imagem

                // Explode a imagem e pega a extensão
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); // Pega a extensão da imagem

                $extensions = ['png', 'jpeg', 'jpg']; // Extensões permitidas
                if (in_array($img_ext, $extensions) === true) { // Se a extensão da imagem for permitida
                    $time = time(); // Pega o tempo atual
                    $new_img_name = $time . $img_name; // Cria um novo nome para a imagem

                    if (move_uploaded_file($tmp_name, "imgs/" . $new_img_name)) { // se a imagem for movida com sucesso
                        $status = 'Ativo agora'; // Define o status do usuário
                        $random_id = rand(time(), 10000000); // Gera um ID único para o usuário

                        // Insere os dados do usuário no banco de dados
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '" . password_hash($password, PASSWORD_DEFAULT) . "', '{$new_img_name}', '{$status}')");
                        
                        if ($sql2) { // Se os dados forem inseridos com sucesso
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); // Seleciona o usuário que acabou de se registrar
                            if (mysqli_num_rows($sql3) > 0) { // Se o usuário foi encontrado no banco de dados
                                $row = mysqli_fetch_assoc($sql3); // Pega os dados do usuário
                                $_SESSION['unique_id'] = $row['unique_id']; // Cria uma sessão com o ID único do usuário
                                echo "sucesso"; // Exibe mensagem de sucesso
                            }
                        } else {
                            echo "Algo deu errado ao salvar os dados!"; // se não conseguiu inserir os dados no banco de dados
                        }
                    } else {
                        echo "Falha ao mover a imagem!"; // se não conseguiu mover a imagem
                    }
                } else {
                    echo "Por favor, selecione uma imagem - jpg, jpeg, png!"; // se a extensão da imagem não for permitida
                }
            } else {
                echo "Por favor, selecione uma imagem!"; // se não foi carregada nenhuma imagem
            }
        }
    } else {
        echo "$email - Não é um email válido!"; // se o email não for válido
    }
} else {
    echo "Por favor, preencha todos os campos!"; // se algum campo estiver vazio
}
exit;