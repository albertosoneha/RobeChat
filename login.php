<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat App em tempo real</header>
            <form action="#">
                <div class="error-txt">Isto é uma mensagem de erro!</div>
                <div class="field input">
                    <label>Email</label>
                    <input type="email" placeholder="Insira o seu email">
                </div>
                <div class="field input">
                    <label>Senha</label>
                    <input type="password" placeholder="Insira a senha">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continuar para o Chat">
                </div>
            </form>
            <div class="link">Ainda não se inscreveu? <a href="#">Inscrever-se agora</a></div>
        </section>
    </div>
    <script src="js/pass-show-hide.js"></script>
</body>
</html>