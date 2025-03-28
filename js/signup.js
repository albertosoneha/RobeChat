const form = document.querySelector('.signup form'), // Pegando o formulário
continueBtn = form.querySelector('.button input'), // Pegando o botão de continuar
errorText = form.querySelector('.error-text'); // Pegando o texto de erro

form.onsubmit = (e)=> { // Quando o formulário for enviado
    e.preventDefault(); // Prevenindo o formulário de ser enviado
}

continueBtn.onclick = ()=> { // Quando o botão de continuar for clicado
    // Inicia-se uma requisição AJAX
   let xhr = new XMLHttpRequest(); // Criando uma nova requisição
    xhr.open("POST", "php/signup.php", true); // Abrindo a requisição
    xhr.onload = ()=> { // Quando a requisição for concluída
        if(xhr.readyState === XMLHttpRequest.DONE){ // Se a requisição for concluída
            if(xhr.status === 200){ // Se o status for 200
                let data = xhr.response; // Recebendo os dados do PHP
                if(data == "Sucesso"){

                }else{
                    errorText.textContent = data; // Mostrando o erro
                    errorText.style.display = "block"; // Mostrando o texto de erro
                }
            }
        }
    }
   // Enviando os dados do formulário para o PHP atraves do AJAX
    let formData = new FormData(form); // Criando um novo objeto de formulário
    xhr.send(formData); // Enviando os dados do formulário para o PHP
}