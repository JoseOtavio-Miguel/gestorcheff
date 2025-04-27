<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>GestorCheff - Plataforma de Restaurantes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilo Personalizado -->
    <style>
        footer {
            background-color: #bb4a04;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <!-- Importa o Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <!-- Conteúdo Principal -->
    <div class="container content-wrapper py-5">
        <div class="row g-5 align-items-center">

            <!-- Bloco de Boas-Vindas (AGORA SOLTO) -->
            <div class="col-lg-5">
                <h1 class="display-5 fw-bold mb-4">Bem-vindo ao <span class="text-warning">GestorCheff</span></h1>
                <p class="lead mb-4">A plataforma inteligente para gerenciar seu restaurante com eficiência, estilo e praticidade.
                Aqui você encontra todas as ferramentas que precisa para crescer!</p>
            </div>

            <!-- Blocos de Menu -->
            <div class="col-lg-7">
                <div class="row g-4">

                    <!-- Bloco Login -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-primary"><i class="bi bi-person-circle"></i> Login</h4>
                                <p>Acesse o sistema e gerencie seu restaurante!</p>
                            </div>
                            <a href="<?= base_url('usuarios/login') ?>" class="btn btn-primary btn-lg w-100 mt-3">
                                <i class="bi bi-box-arrow-in-right"></i> Entrar
                            </a>
                        </div>
                    </div>

                    <!-- Bloco Cadastro Usuário -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-warning"><i class="bi bi-person-plus-fill"></i> Novo Usuário</h4>
                                <p>Cadastre-se e aproveite nossos recursos exclusivos.</p>
                            </div>
                            <a href="<?= base_url('usuarios/cadastro') ?>" class="btn btn-warning btn-lg w-100 mt-3">
                                <i class="bi bi-pencil-square"></i> Cadastrar-se
                            </a>
                        </div>
                    </div>

                    <!-- Bloco Cadastro Restaurante -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-danger"><i class="bi bi-shop-window"></i> Cadastrar Restaurante</h4>
                                <p>Registre seu restaurante na nossa plataforma.</p>
                            </div>
                            <a href="<?= base_url('restaurantes/cadastro') ?>" class="btn btn-danger btn-lg w-100 mt-3">
                                <i class="bi bi-shop-window"></i> Cadastrar Restaurante
                            </a>
                        </div>
                    </div>

                    <!-- Bloco Gerenciar Restaurante -->
                    <div class="col-md-6 d-flex">
                        <div class="main-block w-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="mb-3 text-success"><i class="bi bi-gear-fill"></i> Gerenciar Restaurante</h4>
                                <p>Controle cardápios, pedidos, entregas e muito mais.</p>
                            </div>
                            <a href="<?= base_url('restaurantes/login') ?>" class="btn btn-success btn-lg w-100 mt-3">
                                <i class="bi bi-gear-fill"></i> Começar
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
