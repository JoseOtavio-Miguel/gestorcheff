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

                        <!-- Exibe mensagens de erro gerais -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Exibe erros de validação -->
                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('usuarios/cadastrar') ?>" method="post" class="needs-validation" novalidate>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('nome')) ? 'is-invalid' : '' ?>" 
                                           id="nome" name="nome" value="<?= old('nome') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('nome')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nome') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="sobrenome" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('sobrenome')) ? 'is-invalid' : '' ?>" 
                                           id="sobrenome" name="sobrenome" value="<?= old('sobrenome') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('sobrenome')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sobrenome') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                           id="email" name="email" value="<?= old('email') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('telefone')) ? 'is-invalid' : '' ?>" 
                                           id="telefone" name="telefone" value="<?= old('telefone') ?>">
                                    <?php if (isset($validation) && $validation->hasError('telefone')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('telefone') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('cpf')) ? 'is-invalid' : '' ?>" 
                                           id="cpf" name="cpf" value="<?= old('cpf') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('cpf')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cpf') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="datanascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('datanascimento')) ? 'is-invalid' : '' ?>" 
                                           id="datanascimento" name="datanascimento" value="<?= old('datanascimento') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('datanascimento')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('datanascimento') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('senha')) ? 'is-invalid' : '' ?>" 
                                       id="senha" name="senha" required>
                                <?php if (isset($validation) && $validation->hasError('senha')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('senha') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-3">
                                <label for="confirmasenha" class="form-label">Confirme a Senha</label>
                                <input type="password" class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('confirmasenha')) ? 'is-invalid' : '' ?>" 
                                       id="confirmasenha" name="confirmasenha" required>
                                <?php if (isset($validation) && $validation->hasError('confirmasenha')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('confirmasenha') ?>
                                    </div>
                                <?php endif; ?>
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

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Validação do lado do cliente
document.addEventListener('DOMContentLoaded', function() {
    // Máscaras para os campos
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');
    
    // Máscara para CPF
    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 3) value = value.substring(0, 3) + '.' + value.substring(3);
            if (value.length > 7) value = value.substring(0, 7) + '.' + value.substring(7);
            if (value.length > 11) value = value.substring(0, 11) + '-' + value.substring(11);
            e.target.value = value.substring(0, 14);
        });
    }
    
    // Máscara para telefone
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) value = '(' + value;
            if (value.length > 3) value = value.substring(0, 3) + ') ' + value.substring(3);
            if (value.length > 10) value = value.substring(0, 10) + '-' + value.substring(10);
            e.target.value = value.substring(0, 15);
        });
    }
    
    // Validação do formulário
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    // Validação de senha
    const senhaInput = document.getElementById('senha');
    const confirmaSenhaInput = document.getElementById('confirmasenha');
    
    if (senhaInput && confirmaSenhaInput) {
        confirmaSenhaInput.addEventListener('input', function() {
            if (senhaInput.value !== confirmaSenhaInput.value) {
                confirmaSenhaInput.setCustomValidity('As senhas não coincidem');
            } else {
                confirmaSenhaInput.setCustomValidity('');
            }
        });
    }
});
</script>
<?= $this->endSection() ?>