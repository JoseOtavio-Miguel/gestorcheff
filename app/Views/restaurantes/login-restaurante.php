<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Fundo com gradiente + padding -->
<div style="background: linear-gradient(135deg, #fde0c4, #f9c19b); padding-top: 80px; min-height: 100vh;">
    <div class="container py-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-danger text-center text-white rounded-top-4">
                        <h2 class="mb-0"><i class="bi bi-door-closed"></i> Login de Restaurante</h2>
                    </div>
                    <div class="card-body p-5">

                        <!-- Exibir mensagens de erro ou sucesso -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('restaurantes/logar') ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control form-control-lg" id="senha" name="senha" required>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-danger btn-lg w-75">
                                    <i class="bi bi-box-arrow-in-right"></i> Entrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer global -->
<footer class="bg-dark text-white text-center py-3">
    <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
</footer>

<?= $this->endSection() ?>
