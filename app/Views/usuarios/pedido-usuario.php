<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cardápio - GestorCheff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Estilo Personalizado -->
    <link href="<?= base_url('css/pedido-usuario.css') ?>" type="text/css" rel="stylesheet" />
    <style>
        /* Estilo adicional para os seletores de quantidade */
        .quantidade-selector {
            width: 70px;
            display: inline-block;
        }
        
        .quantidade-selector input {
            text-align: center;
            padding: 0.25rem;
        }
        
        /* Ajustes para os cards de itens */
        .card-item {
            transition: transform 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .card-item:hover {
            transform: translateY(-5px);
        }
        
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .btn-add {
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Importa o Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <!-- Cabeçalho do Cardápio -->
    <div class="header-cardapio">
        <div class="container">
            <img src="https://cdn-icons-png.flaticon.com/512/706/706164.png" alt="Ícone de cardápio" class="cardapio-image" />
            <h1 class="display-4 fw-bold mb-3">Cardápio Digital</h1>
            <p class="lead mb-0">Sabores que encantam, experiências que ficam</p>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mb-5">
        <?php 
        // Agrupa os itens por categoria
        $categorias = [];
        foreach ($itens_cardapio as $item) {
            $categoria = $item['categoria'] ?? 'Outros';
            $categorias[$categoria][] = $item;
        }
        ?>

        <?php foreach ($categorias as $categoria => $itens): ?>
            <h3 class="categoria-title">
                <i class="bi bi-bookmark-fill me-2"></i><?= esc($categoria) ?>
            </h3>
            <div class="row g-4">
                <?php foreach ($itens as $item): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card-item shadow-sm">
                            <img src="<?= base_url(!empty($item['imagem']) ? $item['imagem'] : 'uploads/cardapio/default.png') ?>"
                                class="card-img-top img-fluid"
                                alt="<?= esc($item['nome']) ?>" />
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($item['nome']) ?></h5>
                                <p class="card-text text-muted"><?= esc($item['descricao']) ?></p>
                                <div class="price fw-bold mb-2">R$ <?= number_format($item['preco'], 2, ',', '.') ?></div>
                                <div class="d-flex align-items-center mt-auto">
                                    <div class="quantidade-selector me-2">
                                        <input type="number" min="1" max="20" value="1" 
                                            class="form-control form-control-sm quantidade-input" 
                                            id="qtd-<?= $item['id'] ?>">
                                    </div>
                                    <button class="btn btn-add btn-sm flex-grow-1"
                                        onclick="adicionarItem(event, <?= $item['id'] ?>, '<?= esc($item['nome']) ?>', <?= $item['preco'] ?>, '<?= esc($item['descricao']) ?>')">
                                        <i class="bi bi-cart-plus me-2"></i>Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botão flutuante do carrinho -->
    <button class="btn-carrinho" data-bs-toggle="offcanvas" data-bs-target="#carrinhoOffcanvas" aria-label="Abrir carrinho">
        <i class="bi bi-cart3"></i>
        <span class="badge-carrinho" id="contadorItens">0</span>
    </button>

    <!-- Offcanvas do carrinho -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carrinhoOffcanvas" aria-labelledby="carrinhoLabel">
        <div class="offcanvas-header bg-primary text-white">
            <h5 class="offcanvas-title" id="carrinhoLabel">
                <i class="bi bi-cart3 me-2"></i>Seu Pedido
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('pedidos/salvar') ?>" method="post" novalidate>
                <div id="carrinhoConteudo">
                    <table class="table table-carrinho" id="tabelaPedido">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qtd</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div id="carrinhoVazio" class="empty-cart text-center py-5">
                        <i class="bi bi-cart-x fs-1 text-muted"></i>
                        <p class="text-muted mt-2">Seu carrinho está vazio</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center my-4">
                    <strong class="total-pedido fs-5">Total: R$ <span id="totalPedido">0,00</span></strong>
                </div>
                
                <input type="hidden" name="itens" id="inputItens" />
                <button type="submit" class="btn btn-primary btn-lg w-100" id="btnFinalizar" disabled>
                    <i class="bi bi-check-circle me-2"></i>Finalizar Pedido
                </button>
            </form>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="mt-5 bg-light py-3">
        <div class="container text-center">
            <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let pedido = [];
        const carrinhoVazio = document.getElementById('carrinhoVazio');
        const tabelaPedido = document.getElementById('tabelaPedido');
        const btnFinalizar = document.getElementById('btnFinalizar');

        function adicionarItem(event, id, nome, preco, descricao) {
            event.preventDefault();
            const btn = event.currentTarget;
            const quantidade = parseInt(document.getElementById(`qtd-${id}`).value) || 1;

            const existente = pedido.find(item => item.id === id);
            if (existente) {
                existente.quantidade += quantidade;
            } else {
                pedido.push({ id, nome, preco, descricao, quantidade });
            }
            renderPedido();

            // Feedback visual no botão
            btn.innerHTML = '<i class="bi bi-check2 me-2"></i>Adicionado';
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-success');
            setTimeout(() => {
                btn.innerHTML = `<i class="bi bi-cart-plus me-2"></i>Adicionar`;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
            }, 1000);
        }

        function removerItem(id) {
            pedido = pedido.filter(item => item.id !== id);
            renderPedido();
        }

        function atualizarQuantidade(id, novaQuantidade) {
            const item = pedido.find(i => i.id === id);
            if (item) {
                if (novaQuantidade < 1) {
                    removerItem(id);
                } else {
                    item.quantidade = novaQuantidade;
                    renderPedido();
                }
            }
        }

        function renderPedido() {
            const tbody = tabelaPedido.querySelector("tbody");
            const totalSpan = document.getElementById("totalPedido");
            const inputItens = document.getElementById("inputItens");
            const contador = document.getElementById("contadorItens");

            tbody.innerHTML = "";
            let total = 0;
            let totalItens = 0;

            pedido.forEach(item => {
                const subtotal = item.quantidade * item.preco;
                total += subtotal;
                totalItens += item.quantidade;

                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>
                        <strong>${item.nome}</strong><br/>
                        <small class="text-muted">${item.descricao}</small>
                    </td>
                    <td>
                        <input type="number" min="1" max="20" value="${item.quantidade}" 
                            class="form-control form-control-sm quantidade-carrinho" 
                            onchange="atualizarQuantidade(${item.id}, parseInt(this.value))"
                            style="width: 70px;">
                    </td>
                    <td>R$ ${subtotal.toFixed(2).replace('.', ',')}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove" 
                                onclick="removerItem(${item.id})" aria-label="Remover ${item.nome}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            totalSpan.textContent = total.toFixed(2).replace('.', ',');
            contador.textContent = totalItens;
            inputItens.value = JSON.stringify(pedido);

            if (pedido.length > 0) {
                carrinhoVazio.style.display = 'none';
                tabelaPedido.style.display = 'table';
                btnFinalizar.disabled = false;
            } else {
                carrinhoVazio.style.display = 'block';
                tabelaPedido.style.display = 'none';
                btnFinalizar.disabled = true;
            }
        }
    </script>
</body>
</html>