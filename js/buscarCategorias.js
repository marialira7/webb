async function buscarCateg() {
    try {
        const response = await fetch('php/categorias.php');
        
        // Verifica se a resposta foi bem-sucedida
        if (!response.ok) {
            throw new Error(`Erro na requisição: ${response.statusText}`);
        }
        
        // Tenta converter a resposta em JSON
        const categ = await response.text();
        
        return JSON.parse(categ);
    } catch (error) {
        console.error('Erro ao buscar categorias:', error);
        return null;  // Pode retornar null ou tratar de outra forma
    }
}

export {buscarCateg};