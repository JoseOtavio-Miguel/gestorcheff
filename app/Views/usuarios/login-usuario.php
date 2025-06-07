<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="background: linear-gradient(135deg, #fde0c4, #f9c19b); padding-top: 80px; min-height: 100vh;">
    <div class="container mt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-center rounded-top-4">
                        <h2 class="mb-0 text-white"><i class="bi bi-box-arrow-in-right"></i> Login do Usuário</h2>
                    </div>
                    <div class="card-body p-5">
                        <!-- Mensagens de erro ou sucesso -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('usuarios/logar') ?>" method="post">
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="senha" class="form-label">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                                </div>
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary btn-lg w-75">
                                    <i class="bi bi-box-arrow-in-right"></i> Entrar
                                </button>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('usuarios/cadastro') ?>" class="btn btn-link">Criar Conta</a>
                                <a href="<?= base_url('usuarios/esqueci-senha') ?>" class="btn btn-link">Esqueceu a Senha?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer global fora da div principal -->
<footer class="bg-dark text-white text-center py-3">
    <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
</footer>

<?= $this->endSection() ?>
