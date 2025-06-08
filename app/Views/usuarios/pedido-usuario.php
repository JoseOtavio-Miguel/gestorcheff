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
        
        /* Estilo para os endereços no modal */
        .endereco-option {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .endereco-option:hover {
            background-color: #f8f9fa;
            border-color: #0d6efd;
        }
        
        .endereco-option.selected {
            background-color: #e7f1ff;
            border-color: #0d6efd;
        }
        
        .endereco-detalhes {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <!-- Importa o Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <?php if (session()->has('usuario_id')): ?>
        <div class="alert alert-info text-center">
            Logado como: <strong><?= esc(session()->get('usuario_nome')) ?></strong> 
            (ID: <?= esc(session()->get('usuario_id')) ?>)
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            Usuário não autenticado.
        </div>
    <?php endif; ?>


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
                            <img 
                                src="<?= base_url(!empty($item['imagem']) ? $item['imagem'] : 'uploads/cardapio/default.png') ?>"
                                class="card-img-top img-fluid"
                                alt="<?= esc($item['nome']) ?>" />
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($item['nome']) ?></h5>
                                <p class="card-text text-muted"><?= esc($item['descricao']) ?></p>
                                <div class="price fw-bold mb-2">
                                    R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                                </div>
                                <div class="d-flex align-items-center mt-auto">
                                    <div class="quantidade-selector me-2">
                                        <input 
                                            type="number" min="1" max="20" value="1" 
                                            class="form-control form-control-sm quantidade-input" 
                                            id="qtd-<?= $item['id'] ?>">
                                    </div>
                                    <button 
                                        class="btn btn-add btn-sm flex-grow-1"
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
    <button 
        class="btn-carrinho" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#carrinhoOffcanvas" 
        aria-label="Abrir carrinho">
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
            <form id="formPedido" action="<?= base_url('pedidos/salvar') ?>" method="post">
                <input type="hidden" name="itens" id="inputItens" />
                <input type="hidden" name="endereco_id" id="enderecoSelecionado" />

                <!-- Carrinho -->
                <table class="table table-carrinho" id="tabelaPedido" style="display: none;">
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

                <!-- Total -->
                <div class="d-flex justify-content-between align-items-center my-4">
                    <strong class="total-pedido fs-5">Total: R$ <span id="totalPedido">0,00</span></strong>
                </div>

                <button type="button" class="btn btn-primary btn-lg w-100" id="btnFinalizar" disabled data-bs-toggle="modal" data-bs-target="#modalEnderecos">
                    <i class="bi bi-check-circle me-2"></i>Finalizar Pedido
                </button>
            </form>
        </div>
    </div>

    <!-- Modal de seleção de endereço -->
    <div class="modal fade" id="modalEnderecos" tabindex="-1" aria-labelledby="modalEnderecosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEnderecosLabel">
                        <i class="bi bi-geo-alt me-2"></i>Selecione o endereço de entrega
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <?php if (empty($enderecos)): ?>
                        <div class="alert alert-warning">
                            Nenhum endereço cadastrado. Por favor, cadastre um endereço antes de finalizar o pedido.
                        </div>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($enderecos as $endereco): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row">
                                    <div class="me-md-auto">
                                        <input type="radio" name="endereco" value="<?= $endereco['id'] ?>" class="form-check-input me-2" onclick="selecionarEndereco(this.closest('li'), <?= $endereco['id'] ?>)">
                                        <?= esc($endereco['logradouro']) ?>, <?= esc($endereco['numero']) ?>
                                        <?= esc($endereco['bairro']) ?>, <?= esc($endereco['cidade']) ?>/<?= esc($endereco['estado']) ?><br>
                                        <small class="text-muted">CEP: <?= esc($endereco['cep']) ?></small>
                                    </div>
                                    <div class="mt-2 mt-md-0 d-flex align-items-center gap-2">
                                        <!-- Botão Editar -->
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditarEndereco<?= $endereco['id'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Botão Excluir -->
                                        <form action="<?= base_url('endereco/excluir/' . $endereco['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>

                                <!-- Modal de edição individual (um por endereço) -->
                                <div class="modal fade" id="modalEditarEndereco<?= $endereco['id'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel<?= $endereco['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url('endereco/editar/' . $endereco['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditarLabel<?= $endereco['id'] ?>">
                                                        Editar Endereço
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Campos de edição rápida -->
                                                    <div class="mb-2">
                                                        <label class="form-label">Logradouro</label>
                                                        <input type="text" name="logradouro" class="form-control" value="<?= esc($endereco['logradouro']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Número</label>
                                                        <input type="text" name="numero" class="form-control" value="<?= esc($endereco['numero']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Bairro</label>
                                                        <input type="text" name="bairro" class="form-control" value="<?= esc($endereco['bairro']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Cidade</label>
                                                        <input type="text" name="cidade" class="form-control" value="<?= esc($endereco['cidade']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Estado</label>
                                                        <input type="text" name="estado" class="form-control" value="<?= esc($endereco['estado']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">CEP</label>
                                                        <input type="text" name="cep" class="form-control" value="<?= esc($endereco['cep']) ?>" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Complemento</label>
                                                        <input type="text" name="complemento" class="form-control" value="<?= esc($endereco['complemento']) ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i> Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="btnConfirmarEndereco" disabled>
                            <i class="bi bi-check-lg me-1"></i> Confirmar Endereço
                        </button>
                    </div>
                </div>

            </div>
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
        const inputItens = document.getElementById('inputItens');
        const contador = document.getElementById("contadorItens");
        const formPedido = document.getElementById("formPedido");
        const enderecoSelecionado = document.getElementById("enderecoSelecionado");
        const btnConfirmarEndereco = document.getElementById("btnConfirmarEndereco");
        const listaEnderecos = document.getElementById("listaEnderecos");

        // Modal de endereços - carrega os endereços quando aberto
        document.getElementById('modalEnderecos').addEventListener('show.bs.modal', function() {
            carregarEnderecos();
        });

        function carregarEnderecos() {
            const usuarioId = <?= session()->get('usuario_id') ?? 0 ?>;
            
            if (usuarioId === 0) {
                listaEnderecos.innerHTML = `
                    <div class="alert alert-danger">
                        Você precisa estar logado para visualizar seus endereços.
                    </div>
                `;
                return;
            }

            // Simulação de requisição AJAX para buscar endereços
            // Na implementação real, substitua por uma chamada AJAX para seu backend
            fetch(`<?= base_url('api/enderecos/usuario/') ?>${usuarioId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        listaEnderecos.innerHTML = `
                            <div class="alert alert-warning">
                                Nenhum endereço cadastrado. Por favor, cadastre um endereço antes de finalizar o pedido.
                            </div>
                        `;
                        btnConfirmarEndereco.disabled = true;
                        return;
                    }

                    let html = '<div class="row">';
                    data.forEach(endereco => {
                        html += `
                            <div class="col-md-6 mb-3">
                                <div class="endereco-option" onclick="selecionarEndereco(this, ${endereco.id})">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="endereco" 
                                            id="endereco-${endereco.id}" value="${endereco.id}">
                                        <label class="form-check-label" for="endereco-${endereco.id}">
                                            <strong>${endereco.apelido || 'Endereço'}</strong>
                                        </label>
                                    </div>
                                    <div class="endereco-detalhes mt-2">
                                        <p class="mb-1">${endereco.logradouro}, ${endereco.numero}</p>
                                        <p class="mb-1">${endereco.bairro}</p>
                                        <p class="mb-1">${endereco.cidade} - ${endereco.estado}</p>
                                        <p class="mb-0">CEP: ${endereco.cep}</p>
                                        ${endereco.complemento ? `<p class="mb-0">Complemento: ${endereco.complemento}</p>` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    listaEnderecos.innerHTML = html;
                })
                .catch(error => {
                    console.error('Erro ao carregar endereços:', error);
                    listaEnderecos.innerHTML = `
                        <div class="alert alert-danger">
                            Ocorreu um erro ao carregar seus endereços. Por favor, tente novamente.
                        </div>
                    `;
                    btnConfirmarEndereco.disabled = true;
                });
        }

        function selecionarEndereco(elemento, enderecoId) {
            // Remove a classe 'selected' de todos os endereços
            document.querySelectorAll('.endereco-option').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Adiciona a classe 'selected' ao endereço clicado
            elemento.classList.add('selected');
            
            // Marca o radio button correspondente
            const radio = elemento.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Habilita o botão de confirmar
            btnConfirmarEndereco.disabled = false;
            
            // Armazena o ID do endereço selecionado
            enderecoSelecionado.value = enderecoId;
        }

        // Configura o botão de confirmar endereço
        btnConfirmarEndereco.addEventListener('click', function() {
            if (!enderecoSelecionado.value) {
                alert('Por favor, selecione um endereço para entrega');
                return;
            }
            
            // Fecha o modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalEnderecos'));
            modal.hide();
            
            // Submete o formulário
            formPedido.submit();
        });

        function adicionarItem(event, id, nome, preco, descricao) {
            try {
                event.preventDefault();
                console.log('Adicionar item:', id, nome, preco, descricao);
            } catch (err) {
                console.error('Erro em adicionarItem:', err);
            }

            let quantidadeInput = document.getElementById(`qtd-${id}`);
            let quantidade = parseInt(quantidadeInput.value);

            if (isNaN(quantidade) || quantidade < 1) quantidade = 1;
            if (quantidade > 20) quantidade = 20;

            const existente = pedido.find(item => item.id === id);
            if (existente) {
                existente.quantidade += quantidade;
                if (existente.quantidade > 20) existente.quantidade = 20;
            } else {
                pedido.push({ id, nome, preco, descricao, quantidade });
            }

            renderPedido();

            quantidadeInput.value = 1;

            const btn = event.currentTarget;
            btn.innerHTML = '<i class="bi bi-check2 me-2"></i>Adicionado';
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-success');

            if (btn._timeoutId) clearTimeout(btn._timeoutId);

            btn._timeoutId = setTimeout(() => {
                btn.innerHTML = `<i class="bi bi-cart-plus me-2"></i>Adicionar`;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
                btn._timeoutId = null;
            }, 1000);
        }

        function removerItem(id) {
            pedido = pedido.filter(item => item.id !== id);
            renderPedido();
        }

        function atualizarQuantidade(id, novaQuantidade) {
            if (isNaN(novaQuantidade) || novaQuantidade < 1) {
                removerItem(id);
                return;
            }
            if (novaQuantidade > 20) novaQuantidade = 20;

            const item = pedido.find(i => i.id === id);
            if (item) {
                item.quantidade = novaQuantidade;
                renderPedido();
            }
        }

        function renderPedido() {
            const tbody = tabelaPedido.querySelector("tbody");

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
                        <input 
                            type="number" min="1" max="20" value="${item.quantidade}" 
                            class="form-control form-control-sm quantidade-carrinho" 
                            onchange="atualizarQuantidade(${item.id}, parseInt(this.value))"
                            style="width: 70px;">
                    </td>
                    <td>R$ ${subtotal.toFixed(2).replace('.', ',')}</td>
                    <td class="text-end">
                        <button 
                            type="button" 
                            class="btn btn-outline-danger btn-sm btn-remove" 
                            onclick="removerItem(${item.id})" 
                            aria-label="Remover ${item.nome}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
                document.getElementById("contadorItens").textContent = totalItens;
                document.getElementById("btnFinalizar").disabled = pedido.length === 0;
                document.getElementById("tabelaPedido").style.display = pedido.length > 0 ? 'table' : 'none';
                document.getElementById("carrinhoVazio").style.display = pedido.length === 0 ? 'block' : 'none';
                document.getElementById("totalPedido").textContent = total.toFixed(2).replace('.', ',');

            });

            // Atualiza total formatado com vírgula
            document.getElementById("totalPedido").textContent = total.toFixed(2).replace('.', ',');

            // Atualiza contador do botão carrinho
            contador.textContent = totalItens;

            // Atualiza input hidden com array simplificado (id e quantidade)
            const itensParaEnvio = pedido.map(({ id, quantidade }) => ({ id, quantidade }));
            inputItens.value = JSON.stringify(itensParaEnvio);

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