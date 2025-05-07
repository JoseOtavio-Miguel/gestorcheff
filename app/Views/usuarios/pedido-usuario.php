<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cardápio - GestorCheff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="mb-4 text-center">Cardápio</h2>

    <div class="row">
        <?php foreach ($itens_cardapio as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card-item">
                    <h5><?= esc($item['nome']) ?></h5>
                    <p><?= esc($item['descricao']) ?></p>
                    <p><strong>R$ <?= number_format($item['preco'], 2, ',', '.') ?></strong></p>
                    <button class="btn btn-success w-100" onclick="adicionarItem(<?= $item['id'] ?>, '<?= esc($item['nome']) ?>', <?= $item['preco'] ?>)">
                        Adicionar ao Pedido
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Carrinho -->
    <h4 class="mt-5">Itens no Pedido</h4>
    <form action="<?= base_url('pedidos/salvar') ?>" method="post">
        <table class="table table-bordered" id="tabelaPedido">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="d-flex justify-content-between">
            <strong>Total: R$ <span id="totalPedido">0.00</span></strong>
            <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
        </div>
        <!-- Input oculto para JSON do pedido -->
        <input type="hidden" name="itens" id="inputItens">
    </form>
</div>

<script>
    let pedido = [];

    function adicionarItem(id, nome, preco) {
        const existente = pedido.find(item => item.id === id);
        if (existente) {
            existente.quantidade++;
        } else {
            pedido.push({ id, nome, preco, quantidade: 1 });
        }
        renderPedido();
    }

    function removerItem(id) {
        pedido = pedido.filter(item => item.id !== id);
        renderPedido();
    }

    function renderPedido() {
        const tbody = document.querySelector("#tabelaPedido tbody");
        const totalSpan = document.getElementById("totalPedido");
        const inputItens = document.getElementById("inputItens");

        tbody.innerHTML = "";
        let total = 0;

        pedido.forEach(item => {
            const subtotal = item.quantidade * item.preco;
            total += subtotal;

            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${item.nome}</td>
                <td>${item.quantidade}</td>
                <td>R$ ${subtotal.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removerItem(${item.id})">Remover</button></td>
            `;
            tbody.appendChild(tr);
        });

        totalSpan.textContent = total.toFixed(2);
        inputItens.value = JSON.stringify(pedido);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
