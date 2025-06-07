<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Fundo com gradiente, altura mínima e espaçamento -->
<div style="background: linear-gradient(135deg, #fde0c4, #f9c19b); padding-top: 80px; min-height: 100vh;">
    <div class="container py-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-danger text-center text-white rounded-top-4">
                        <h2 class="mb-0"><i class="bi bi-shop-window"></i> Cadastro de Restaurante</h2>
                    </div>
                    <div class="card-body p-5">

                        <!-- Mensagens -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('restaurantes/cadastrar') ?>" method="post">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Restaurante</label>
                                <input type="text" class="form-control form-control-lg" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição do Restaurante</label>
                                <textarea class="form-control form-control-lg" id="descricao" name="descricao" rows="3"></textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input type="text" class="form-control form-control-lg" id="cnpj" name="cnpj" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control form-control-lg" id="telefone" name="telefone" required>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control form-control-lg" id="rua" name="rua" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control form-control-lg" id="cidade" name="cidade" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="estado" class="form-label">Estado (UF)</label>
                                    <input type="text" class="form-control form-control-lg" id="estado" name="estado" maxlength="2" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="text" class="form-control form-control-lg" id="cep" name="cep" required>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control form-control-lg" id="senha" name="senha" required>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-danger btn-lg w-75">
                                    <i class="bi bi-shop"></i> Cadastrar Restaurante
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rodapé fixo ou padrão -->
<footer class="bg-dark text-white text-center py-3">
    <small>© <?= date('Y') ?> GestorCheff - Plataforma de Gestão para Restaurantes</small>
</footer>

<?= $this->endSection() ?>
