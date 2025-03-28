<?php

    include_once "config.php"; // Inclui o arquivo de configuração
    $fname = mysqli_real_escape_string($conn, $_POST['fname']); // Recebe o primeiro nome
    $lname = mysqli_real_escape_string($conn, $_POST['lname']); // Recebe o último nome
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Recebe o email
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Recebe a senha

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) { // Se todos os campos estiverem preenchidos
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // Se o email for válido
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email ='{$email}'"); // Verifica se o email já está cadastrado
            if(mysqli_num_rows($sql) > 0){ // Se o email já estiver cadastrado
                echo "$email - Este email já existe!"; // Exibe a mensagem
            }else{ 
                // se o arquivo foi carregado ou não
                if(isset($_FILES['image'])) { // Se o arquivo foi carregado
                    $img_name = $_FILES['image']['name']; // Recebe o nome da imagem
                    $tmp_name = $_FILES['image']['tmp_name']; // Recebe o nome temporário da imagem. e este nome é usado pra salvar/mover o arquivo no nosso diretório.
                    
                    // Explode a imagem e pega a extensão como jpg, png, jpeg
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); // Aqui pegamos a extensão da imagem do usuário
                    
                    $extensions = ['png', 'jpeg', 'jpg']; // Extensões permitidas
                    if(in_array($img_ext, $extensions) === true) { // Se a extensão da imagem for permitida
                        $time = time(); // Pega o tempo atual do usuário
                        $new_img_name = $time.$img_name; // Nome da imagem do usuário
                        
                        if(move_uploaded_file($tmp_name, "imgs/".$new_img_name)){ // Se a imagem for movida para o diretório
                            $status = 'Ativo agora'; // Status do usuário)
                            $random_id = rand(time(), 10000000); // ID do usuário
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')"); // Insere os dados do usuário no banco de dados
                            if($sql2){
                               $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); // Seleciona os dados do usuário
                                if(mysqli_num_rows($sql3) > 0) { // Se os dados do usuário existirem
                                   $row = mysqli_fetch_assoc($sql3); // Pega os dados do usuário
                                   $_SESSION['unique_id'] = $row['unique_id']; // Usando esta sessão que usamos o unique_id do usuário em outros arquivos PHP
                                   echo "sucesso"; // Exibe a mensagem
                                }
                            }else {
                                echo"Alguma coisa deu errado!";
                            }
                        }
                       
                    }else {
                        echo "Por favor, selecione uma imagem - PNG, JPEG, JPG!"; // Se não, exibe a mensagem
                    }
                
                }else {
                    echo "Por favor, selecione uma imagem!"; // Se não, exibe a mensagem
                }
            }
        }
    
    } else {
        echo "Por favor, preencha todos os campo!"; // Se não, exibe a mensagem
    }   
        

?>