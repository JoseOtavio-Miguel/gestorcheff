<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Usuário - GestorCheff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilo -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            background-color: #bb4a04;
            color: white;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>

<body>

    <!-- Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <!-- Conteúdo Principal -->
    <main class="container py-5">
        <div class="row g-5 align-items-center">

            <!-- Saudação -->
            <div class="col-lg-5">
                <h2 class="fw-bold mb-3">Olá, <?= session()->get('usuario_nome') ?>! 👋</h2>
                <p class="lead">Aqui você pode fazer seus pedidos, acompanhar entregas e visualizar seus dados.</p>
            </div>

            <!-- Ações do Usuário -->
            <div class="col-lg-7">
                <div class="row g-4">

                    <!-- Fazer Pedido -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-primary"><i class="bi bi-cart-plus-fill"></i> Fazer Pedido</h4>
                                <p>Escolha pratos deliciosos e monte seu pedido.</p>
                            </div>
                            <a href="<?= base_url('cardapiousuario/cardapio') ?>" class="btn btn-primary btn-lg w-100 mt-3">
                                <i class="bi bi-bag-plus-fill"></i> Fazer Pedido
                            </a>
                        </div>
                    </div>

                    <!-- Rastrear Pedidos -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-warning"><i class="bi bi-truck"></i> Rastrear</h4>
                                <p>Acompanhe o status dos seus pedidos em tempo real.</p>
                            </div>
                            <a href="<?= base_url('pedidos/rastrear') ?>" class="btn btn-warning btn-lg w-100 mt-3">
                                <i class="bi bi-search"></i> Rastrear Pedido
                            </a>
                        </div>
                    </div>

                    <!-- Meus Dados -->
                    <div class="col-md-12 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-info"><i class="bi bi-person-lines-fill"></i> Meus Dados</h4>
                                <p>Veja suas informações e atualize quando necessário.</p>
                            </div>
                            <a href="<?= base_url('usuarios/informacao') ?>" class="btn btn-info btn-lg w-100 mt-3">
                                <i class="bi bi-person-vcard"></i> Ver Meus Dados
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- Rodapé Fixo -->
    <footer>
        <div class="container">
            <small>© <?= date('Y') ?> GestorCheff - Plataforma do Usuário</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
