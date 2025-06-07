<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cardápio - GestorCheff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilo Personalizado -->
    <style>
        :root {
            --primary-color: #bb4a04;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --light-gray: #f5f5f5;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
        }
        
        .header-cardapio {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
            text-align: center;
            border-radius: 0 0 20px 20px;
        }
        
        .categoria-title {
            margin: 3rem 0 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            font-weight: 600;
            color: var(--primary-color);
            position: relative;
        }
        
        .categoria-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100px;
            height: 2px;
            background-color: var(--primary-color);
        }
        
        .card-item {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            background-color: white;
        }
        
        .card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .card-img-top {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--primary-color);
        }
        
        .card-text {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .btn-add {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
        }
        
        .btn-add:hover {
            background-color: #9a3e03;
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-carrinho {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(187, 74, 4, 0.4);
            z-index: 1055;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-carrinho:hover {
            transform: scale(1.1);
            background-color: #9a3e03;
            color: white;
        }
        
        .badge-carrinho {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
        
        .offcanvas-header {
            background-color: var(--primary-color);
            color: white;
        }
        
        .offcanvas-title {
            font-weight: 600;
        }
        
        .btn-close-white {
            filter: invert(1);
        }
        
        .table-carrinho th {
            background-color: var(--light-gray);
        }
        
        .btn-remove {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        
        .total-pedido {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .btn-finalizar {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-finalizar:hover {
            background-color: #9a3e03;
            transform: translateY(-2px);
            color: white;
        }
        
        .empty-cart {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
        
        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }
        
        .cardapio-image {
            max-width: 200px;
            margin: 0 auto 2rem;
            display: block;
        }
    </style>
</head>
<body>

    <!-- Importa o Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <!-- Cabeçalho do Cardápio -->
    <div class="header-cardapio">
        <div class="container">
            <img src="https://cdn-icons-png.flaticon.com/512/706/706164.png" alt="Ícone de cardápio" class="cardapio-image">
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
                        <div class="card-item">
                            <img src="<?= $item['imagem'] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80' ?>" 
                                class="card-img-top" alt="<?= esc($item['nome']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($item['nome']) ?></h5>
                                <p class="card-text"><?= esc($item['descricao']) ?></p>
                                <div class="price">R$ <?= number_format($item['preco'], 2, ',', '.') ?></div>
                                <button class="btn btn-add"
                                        onclick="adicionarItem(<?= $item['id'] ?>, '<?= esc($item['nome']) ?>', <?= $item['preco'] ?>)">
                                    <i class="bi bi-cart-plus me-2"></i>Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botão flutuante do carrinho -->
    <button class="btn-carrinho"
            data-bs-toggle="offcanvas" data-bs-target="#carrinhoOffcanvas">
        <i class="bi bi-cart3"></i>
        <span class="badge-carrinho" id="contadorItens">0</span>
    </button>

    <!-- Offcanvas do carrinho -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carrinhoOffcanvas" aria-labelledby="carrinhoLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="carrinhoLabel">
                <i class="bi bi-cart3 me-2"></i>Seu Pedido
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('pedidos/salvar') ?>" method="post">
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
                    <div id="carrinhoVazio" class="empty-cart">
                        <i class="bi bi-cart-x"></i>
                        <p>Seu carrinho está vazio</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center my-4">
                    <strong class="total-pedido">Total: R$ <span id="totalPedido">0.00</span></strong>
                </div>
                
                <input type="hidden" name="itens" id="inputItens">
                <button type="submit" class="btn btn-finalizar w-100" id="btnFinalizar" disabled>
                    <i class="bi bi-check-circle me-2"></i>Finalizar Pedido
                </button>
            </form>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="mt-5">
        <div class="container py-3">
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

        function adicionarItem(id, nome, preco) {
            const existente = pedido.find(item => item.id === id);
            if (existente) {
                existente.quantidade++;
            } else {
                pedido.push({ id, nome, preco, quantidade: 1 });
            }
            renderPedido();
            
            // Feedback visual
            const btn = event.target;
            btn.innerHTML = '<i class="bi bi-check2 me-2"></i>Adicionado';
            btn.classList.remove('btn-add');
            btn.classList.add('btn-success');
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-cart-plus me-2"></i>Adicionar';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-add');
            }, 1000);
        }

        function removerItem(id) {
            pedido = pedido.filter(item => item.id !== id);
            renderPedido();
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
                    <td>${item.nome}</td>
                    <td>${item.quantidade}</td>
                    <td>R$ ${subtotal.toFixed(2)}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-outline-danger btn-remove" 
                                onclick="removerItem(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            totalSpan.textContent = total.toFixed(2);
            contador.textContent = totalItens;
            inputItens.value = JSON.stringify(pedido);
            
            // Mostra/oculta elementos conforme o carrinho
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