<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RobéChat - aplicativo web de chat em tempo real</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat em tempo real</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Primeiro Nome</label>
                        <input type="text" name="fname" placeholder="Primero Nome" required>
                    </div>
                    <div class="field input">
                        <label>Último Nome</label>
                        <input type="text" name="lname" placeholder="Último Nome" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Insira o seu email" required>
                </div>
                <div class="field input">
                    <label>Senha</label>
                    <input type="password" name="password" placeholder="Insira a sua nova senha" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Selecione uma imagem</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continuar para o Chat">
                </div>
            </form>
            <div class="link">Já se inscreveu? <a href="#">Entrar</a></div>
        </section>
    </div>

    <script src="js/pass-show-hide.js"></script>
    <script src="js/signup.js"></script>
</body>

</html>