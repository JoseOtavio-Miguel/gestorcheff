<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Fundo gradiente bonito -->
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #fde0c4, #f9c19b); padding-top: 80px;">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold"><i class="bi bi-person-plus-fill" style="color: #d28519;"></i> Criar Nova Conta</h1>
            <p class="lead">Cadastre-se para aproveitar todos os recursos do GestorCheff.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 p-4" style="background-color: #f8f9fa;">
                    <div class="card-body">

                        <form action="<?= base_url('usuarios/cadastrar') ?>" method="post">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sobrenome" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control form-control-lg" id="sobrenome" name="sobrenome" required>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control form-control-lg" id="telefone" name="telefone">
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control form-control-lg" id="cpf" name="cpf" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="datanascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control form-control-lg" id="datanascimento" name="datanascimento" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control form-control-lg" id="senha" name="senha" required>
                            </div>

                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-warning btn-lg rounded-3">
                                    <i class="bi bi-save-fill"></i> Cadastrar Conta
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="small">Já possui conta? <a href="<?= base_url('usuarios/login') ?>" class="text-decoration-none text-warning">Entrar</a></p>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
