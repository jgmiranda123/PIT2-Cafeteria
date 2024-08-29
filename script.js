document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(event) {
        const confirmAction = confirm("Tem certeza que deseja excluir este produto?");
        if (!confirmAction) {
            event.preventDefault();
        }
    });
});

    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('input[type="number"]');
        const totalElement = document.getElementById('total');

        inputs.forEach(input => {
            input.addEventListener('input', calcularTotal);
        });

        function calcularTotal() {
            let total = 0;
            inputs.forEach(input => {
                const quantidade = parseInt(input.value) || 0; // Se a quantidade não for um número, considera 0
                const preco = parseFloat(input.closest('tr').querySelector('td:nth-child(2)').textContent.replace('R$ ', '').replace(',', '.')) || 0;
                total += quantidade * preco;
            });
            totalElement.textContent = total.toFixed(2).replace('.', ',');
        }
    });

document.getElementById('preco').addEventListener('input', function(e) {
    let value = e.target.value;

    // Remove todos os caracteres que não são dígitos
    value = value.replace(/\D/g, '');

    // Adiciona as casas decimais
    value = (value / 100).toFixed(2);

    // Substitui ponto por vírgula e coloca separador de milhar
    value = value.replace('.', ',');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Adiciona o símbolo de moeda R$
    e.target.value = 'R$ ' + value;
});
