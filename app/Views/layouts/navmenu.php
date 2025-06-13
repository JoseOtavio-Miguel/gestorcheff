<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>GestorCheff - Plataforma de Restaurantes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Importa a folha de estilo CSS -->
    <link rel="stylesheet" href="<?= '../public/css/style.css' ?>">
</head>

<body>
   <!-- Navbar Superior -->
   <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #bb4a04;">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/home') ?>">

                <i class="bi bi-egg-fried me-2"></i>GestorCheff
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-house-door me-1"></i> Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurantes/home"><i class="bi bi-shop me-1"></i> Restaurante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-people me-1"></i> Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-info-circle me-1"></i> Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-envelope me-1"></i> Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>