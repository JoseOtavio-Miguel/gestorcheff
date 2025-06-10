<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h1 class="painel-title text-center mb-5 fw-bold">  Gerenciar Cardápio </h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-center">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Botões de Navegação -->
    <div class="text-center mb-4">
        <a href="<?= base_url('cardapio/painel/' . $restauranteId) ?>" class="btn btn-outline-secondary mb-2 w-75">
            ← Voltar
        </a>
        <a href="<?= base_url('cardapio/novo/' . $restauranteId) ?>" class="btn-custom btn btn-danger w-75">
            + Novo Item
        </a>
    </div>

    <!-- Lista de Itens do Cardápio -->
    <div class="row g-4">
        <?php foreach ($itens as $item): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 card-hover">
                    <div class="card-body text-center p-4">
                        <h4 class="fw-bold"><?= esc($item['nome']) ?></h4>
                        <p class="text-muted"><?= esc($item['descricao']) ?></p>
                        <h5 class="text-danger fw-bold mb-3">R$ <?= number_format($item['preco'], 2, ',', '.') ?></h5>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="<?= base_url('cardapio/editar/' . $item['id']) ?>" class="btn btn-warning btn-sm rounded-3 px-3">Editar</a>
                            <form method="post" action="<?= base_url('cardapio/excluir/' . $item['id']) ?>" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-3" onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($itens)): ?>
            <div class="text-center mt-5">
                <p class="text-muted">Nenhum item cadastrado ainda. Clique em <strong>+ Novo Item</strong> para começar!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Estilo Personalizado -->
<style>
    .painel-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeIn 1s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        transition: 0.3s;
        background: #ffe3c5;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<?= $this->endSection() ?>