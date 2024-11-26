document.addEventListener('DOMContentLoaded', () => {
    const registerContainer = document.getElementById('register-container');
    const loginContainer = document.getElementById('login-container');

    const switchToLogin = document.getElementById('switch-to-login');
    const switchToRegister = document.getElementById('switch-to-register');

    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');

    // Alternar entre os formulários
    switchToLogin.addEventListener('click', () => {
        registerContainer.classList.add('hidden');
        loginContainer.classList.remove('hidden');
    });

    switchToRegister.addEventListener('click', () => {
        loginContainer.classList.add('hidden');
        registerContainer.classList.remove('hidden');
    });

    // Validação da senha
    function validarSenha(senha) {
        if (senha.length < 8) {
            return "A senha deve ter pelo menos 8 caracteres.";
        } else if (!/[A-Z]/.test(senha)) {
            return "A senha deve ter pelo menos uma letra maiúscula.";
        } else if (!/[0-9]/.test(senha)) {
            return "A senha deve ter pelo menos um número.";
        }
        return null; // Nenhum erro
    }

    // Submissão do formulário de registro
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const celular = document.getElementById('celular').value;
        const senha = document.getElementById('senha').value;

        // Validar a senha
        const erroSenha = validarSenha(senha);
        if (erroSenha) {
            alert(erroSenha);
            return; // Parar a submissão se a senha for inválida
        }
  //  http://127.0.0.1:8000/?action=users
        try {
            const response = await fetch('http://127.0.0.1:8000/?action=register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome, email, celular, senha }),
            });
        
          const result = await response.json();
          alert(result.message || result.error);
        } catch (error) {
            alert('Erro ao criar conta. Tente novamente.');
      }
    });

    // Submissão do formulário de login
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const senha = document.getElementById('login-senha').value;

        try {
            const response = await fetch('http://127.0.0.1:8000/?action=login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, senha }),
            });

            const result = await response.json();
            alert(result.message || result.error);
        } catch (error) {
            alert('Erro ao fazer login. Tente novamente.');
        }
    });
});
