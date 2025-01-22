document.addEventListener('DOMContentLoaded', () => {
    const editButton = document.querySelector('.editar');
    const nome = document.getElementById('input_user');
    const email = document.getElementById('input_email');
    const tel = document.getElementById('input_telefone');


    // Processamento
    editButton.addEventListener('click', async () => {
        
        if (!nome || !email || !tel) {
            alert('Preencha todos os campos!');
            return;
        }
        const formdata = new FormData();

        formdata.append('nome', nome.value);
        formdata.append('email', email.value);
        formdata.append('tel', tel.value);

        const request = await fetch('php/salvarUsuario.php', {
            method: 'POST',
            body: formdata
        })

        if (!request.ok) {
            alert('Erro ao salvar os dados!');
            return;
        };

        window.location.href = 'perfil.php';

    })

    // Faz a requisição Ajax e preenche os dados com o JSON
    mostrarDados().then(async function(data) {
        nome.value = data.username;
        email.value = data.email;
        tel.value = data.telefone;
    });

    // Funções
    async function mostrarDados() {
        try {
            const response = await fetch('php/dadosUsuario.php');
        
            if (response.ok) {
                const data = await response.json(); 
                return data;
            }
        
        } catch (error) {
            console.error('Erro ao buscar os dados do usuário: ', error);
        }
    }

});