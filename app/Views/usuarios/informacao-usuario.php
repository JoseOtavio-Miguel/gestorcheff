<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dados do Usuário | GestorCheff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Estilo Personalizado -->
    <link href="<?= base_url('css/informacao-usuario.css') ?>" type="text/css" rel="stylesheet" />
    
</head>

<body>

    <!-- Importa o Navmenu -->
    <?= view('/layouts/navmenu') ?>

    <!-- Conteúdo Principal -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="user-profile-card mb-5">
                    <!-- Cabeçalho do Perfil -->
                    <div class="user-profile-header">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($usuario['nome'] . '+' . $usuario['sobrenome']) ?>&background=random" 
                             alt="Avatar do usuário" class="user-avatar">
                        <h2><?= esc($usuario['nome']) ?> <?= esc($usuario['sobrenome']) ?></h2>
                        <p class="mb-0"><i class="bi bi-envelope-fill"></i> <?= esc($usuario['email']) ?></p>
                    </div>
                    
                    <!-- Informações do Usuário -->
                    <div class="p-4">
                        <h4 class="mb-4 text-primary"><i class="bi bi-person-badge-fill"></i> Informações Pessoais</h4>
                        
                        <table class="table table-user-info table-bordered">
                            <tbody>
                                <tr>
                                    <th><i class="bi bi-calendar-event"></i> Data de Nascimento</th>
                                    <td><?= esc($usuario['datanascimento']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-file-earmark-text"></i> CPF</th>
                                    <td><?= esc($usuario['cpf']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-telephone-fill"></i> Telefone</th>
                                    <td><?= esc($usuario['telefone']) ?? '<span class="text-muted">Não informado</span>' ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                                <i class="bi bi-pencil-square"></i> Editar Perfil
                            </button>
                                            
                            <!-- Botão para abrir modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEndereco">
                                <i class="bi bi-house-add"></i> Cadastrar Novo Endereço
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Seção de Endereços (pode ser adicionada dinamicamente) -->
                <div class="user-profile-card p-4">
                    <h4 class="mb-4 text-primary"><i class="bi bi-house-door-fill"></i> Meus Endereços</h4>
                    <div class="user-profile-card p-4">
                        <?php if (!empty($enderecos)): ?>
                            <ul class="list-group">
                                <?php foreach ($enderecos as $endereco): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row">
                                    <div>
                                        <?= esc($endereco['logradouro']) ?>, <?= esc($endereco['numero']) ?> -
                                        <?= esc($endereco['bairro']) ?>, <?= esc($endereco['cidade']) ?>/<?= esc($endereco['estado']) ?><br>
                                        CEP: <?= esc($endereco['cep']) ?>
                                    </div>
                                    <div class="mt-2 mt-md-0">
                                        <!-- Botão de editar -->
                                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#modalEditarEndereco<?= $endereco['id'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <!-- Formulário de exclusão -->
                                        <form action="<?= base_url('endereco/excluir/' . $endereco['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Você ainda não cadastrou nenhum endereço. Clique no botão acima para adicionar.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal de Cadastro de Endereço -->
<div class="modal fade" id="modalEndereco" tabindex="-1" aria-labelledby="modalEnderecoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('endereco/salvar') ?>" method="post" class="modal-content needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="modalEnderecoLabel"><i class="bi bi-house-add"></i> Novo Endereço</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <!-- Campo oculto para vincular ao usuário -->
                <input type="hidden" name="usuario_id" value="<?= esc($usuario['id']) ?>" />

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" required maxlength="9" 
                               placeholder="00000-000" pattern="\d{5}-\d{3}" />
                        <div class="invalid-feedback">
                            Por favor, insira um CEP válido no formato 00000-000.
                        </div>
                    </div>
                    <div class="col-md-7 mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control" required maxlength="255" />
                        <div class="invalid-feedback">
                            Por favor, informe o logradouro.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" name="numero" id="numero" class="form-control" required maxlength="20" />
                        <div class="invalid-feedback">
                            Por favor, informe o número.
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" name="complemento" id="complemento" class="form-control" maxlength="100" />
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" required maxlength="100" />
                        <div class="invalid-feedback">
                            Por favor, informe o bairro.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="estado" class="form-label">Estado (UF)</label>
                        <input type="text" name="estado" id="estado" class="form-control" readonly required />
                        <div class="invalid-feedback">
                            Estado é obrigatório.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cidade" class="form-label">Município</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" readonly required />
                        <div class="invalid-feedback">
                            Município é obrigatório.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pais" class="form-label">País</label>
                    <input type="text" name="pais" id="pais" class="form-control" required maxlength="100" value="Brasil" readonly />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Salvar Endereço
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Modal de Edição de Endereço -->
<?php foreach ($enderecos as $endereco): ?>
<div class="modal fade" id="modalEditarEndereco<?= $endereco['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('endereco/atualizar/' . $endereco['id']) ?>" method="post" class="modal-content needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Endereço</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="usuario_id" value="<?= esc($usuario['id']) ?>" />
                
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" value="<?= esc($endereco['cep']) ?>" 
                               class="form-control cep-input" required 
                               pattern="\d{5}-\d{3}" placeholder="00000-000" />
                        <div class="invalid-feedback">
                            Por favor, informe um CEP válido no formato 00000-000.
                        </div>
                    </div>
                    <div class="col-md-7 mb-3">
                        <label class="form-label">Logradouro</label>
                        <input type="text" name="logradouro" value="<?= esc($endereco['logradouro']) ?>" 
                               class="form-control" required readonly/>
                        <div class="invalid-feedback">
                            Por favor, informe o logradouro.
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Número</label>
                        <input type="text" name="numero" value="<?= esc($endereco['numero']) ?>" 
                               class="form-control" required />
                        <div class="invalid-feedback">
                            Por favor, informe o número.
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Complemento</label>
                        <input type="text" name="complemento" value="<?= esc($endereco['complemento']) ?>" 
                               class="form-control" />
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Bairro</label>
                        <input type="text" name="bairro" value="<?= esc($endereco['bairro']) ?>" 
                               class="form-control" required readonly/>
                        <div class="invalid-feedback">
                            Por favor, informe o bairro.
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" value="<?= esc($endereco['estado']) ?>" 
                               class="form-control estado-input" required readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" value="<?= esc($endereco['cidade']) ?>" 
                               class="form-control cidade-input" required readonly />
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">País</label>
                    <input type="text" name="pais" value="<?= esc($endereco['pais']) ?>" 
                           class="form-control" required readonly />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>


<!-- Modal para editar perfil do usuário -->
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('usuarios/atualizar/' . $usuario['id']) ?>" method="post" class="modal-content needs-validation" novalidate>
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarPerfilLabel">
                    <i class="bi bi-pencil-square"></i> Editar Perfil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?= esc($usuario['nome']) ?>" required maxlength="50" />
                        <div class="invalid-feedback">Informe o nome.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?= esc($usuario['sobrenome']) ?>" required maxlength="50" />
                        <div class="invalid-feedback">Informe o sobrenome.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="datanascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="datanascimento" id="datanascimento" class="form-control" value="<?= esc($usuario['datanascimento']) ?>" required />
                    <div class="invalid-feedback">Informe a data de nascimento.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= esc($usuario['email']) ?>" required maxlength="50" />
                    <div class="invalid-feedback">Informe um e-mail válido.</div>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" value="<?= esc($usuario['cpf']) ?>" required maxlength="14" readonly />
                    <div class="form-text text-muted">O CPF não pode ser alterado.</div>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="<?= esc($usuario['telefone']) ?>" maxlength="20" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>



<!-- Rodapé -->
    <footer>
        <div class="container">
            <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
        </div>
    </footer>


<!-- Script para manipulação do CEP -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Função para aplicar máscara de CEP
    function aplicarMascaraCEP(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length > 5) {
            value = value.substring(0, 5) + '-' + value.substring(5, 8);
        }
        input.value = value;
    }

    // Função para consultar CEP
    async function consultarCEP(cep, modal) {
        try {
            cep = cep.replace(/\D/g, '');
            if (cep.length !== 8) return false;
            
            // Adiciona classe de loading
            modal.querySelector('.cep-input').classList.add('loading');
            
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            if (!response.ok) throw new Error('CEP não encontrado');
            
            const data = await response.json();
            if (data.erro) throw new Error('CEP não encontrado');
            
            // Atualiza os campos do formulário
            modal.querySelector('[name="logradouro"]').value = data.logradouro || '';
            modal.querySelector('[name="bairro"]').value = data.bairro || '';
            modal.querySelector('.estado-input').value = data.uf || '';
            modal.querySelector('.cidade-input').value = data.localidade || '';
            
            return true;
        } catch (error) {
            console.error('Erro ao consultar CEP:', error);
            return false;
        } finally {
            modal.querySelector('.cep-input').classList.remove('loading');
        }
    }

    // Configura os eventos para cada modal de edição
    document.querySelectorAll('.modal').forEach(modal => {
        const cepInput = modal.querySelector('.cep-input');
        
        if (cepInput) {
            // Máscara de CEP durante a digitação
            cepInput.addEventListener('input', function() {
                aplicarMascaraCEP(this);
            });
            
            // Consulta CEP quando perde o foco
            cepInput.addEventListener('blur', async function() {
                if (this.value) {
                    const cepValido = await consultarCEP(this.value, modal);
                    if (!cepValido) {
                        // Mostra mensagem de erro apenas se o campo não estiver vazio
                        const errorElement = document.createElement('div');
                        errorElement.className = 'invalid-feedback d-block';
                        errorElement.textContent = 'CEP não encontrado. Verifique o número digitado.';
                        errorElement.id = 'cep-error';
                        
                        // Remove erro anterior se existir
                        const existingError = this.nextElementSibling;
                        if (existingError && existingError.id === 'cep-error') {
                            existingError.remove();
                        }
                        
                        this.insertAdjacentElement('afterend', errorElement);
                        this.classList.add('is-invalid');
                    } else {
                        // Remove mensagem de erro se existir
                        const errorElement = this.nextElementSibling;
                        if (errorElement && errorElement.id === 'cep-error') {
                            errorElement.remove();
                        }
                        this.classList.remove('is-invalid');
                    }
                }
            });
        }
    });
});
</script>

<style>
.loading {
    position: relative;
}

.loading::after {
    content: '';
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    border: 2px solid rgba(0,0,0,0.1);
    border-radius: 50%;
    border-top-color: #6c63ff;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: translateY(-50%) rotate(360deg); }
}

.invalid-feedback.d-block {
    display: block !important;
}
</style>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Elementos do formulário
        const cepInput = document.getElementById('cep');
        const logradouroInput = document.getElementById('logradouro');
        const bairroInput = document.getElementById('bairro');
        const estadoInput = document.getElementById('estado');
        const cidadeInput = document.getElementById('cidade');
        const paisInput = document.getElementById('pais');

        // Máscara para CEP (única implementação)
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });

        // Busca endereço pelo CEP usando ViaCEP API (versão otimizada)
        cepInput.addEventListener('blur', async function() {
            const cep = this.value.replace(/\D/g, '');
            
            if (cep.length !== 8) {
                if (cep.length > 0) {
                    showCepError('CEP deve conter 8 dígitos');
                }
                return;
            }

            try {
                // Mostrar loading
                cepInput.classList.add('loading');
                
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                
                if (!response.ok) throw new Error('Falha na consulta');
                
                const data = await response.json();
                
                if (data.erro) throw new Error('CEP não encontrado');
                
                // Preenche os campos
                logradouroInput.value = data.logradouro || '';
                bairroInput.value = data.bairro || '';
                estadoInput.value = data.uf || '';
                cidadeInput.value = data.localidade || '';
                paisInput.value = 'Brasil';
                
                // Limpa erros
                clearCepError();
                
            } catch (error) {
                console.error('Erro na consulta de CEP:', error);
                showCepError('CEP não encontrado. Verifique o número digitado.');
                
                // Limpa os campos
                logradouroInput.value = '';
                bairroInput.value = '';
                estadoInput.value = '';
                cidadeInput.value = '';
            } finally {
                cepInput.classList.remove('loading');
            }
        });

        // Validação do formulário
        document.querySelectorAll('.needs-validation').forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
        
        // Funções auxiliares
        function showCepError(message) {
            clearCepError();
            const errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback d-block';
            errorElement.textContent = message;
            errorElement.id = 'cep-error';
            cepInput.insertAdjacentElement('afterend', errorElement);
            cepInput.classList.add('is-invalid');
        }

        function clearCepError() {
            const existingError = document.getElementById('cep-error');
            if (existingError) existingError.remove();
            cepInput.classList.remove('is-invalid');
        }
    });
    </script>
</body>
</html>