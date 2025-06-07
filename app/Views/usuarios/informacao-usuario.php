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
    <style>
        :root {
            --primary-color: #bb4a04;
            --secondary-color: #f8f9fa;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .user-profile-card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: none;
        }
        
        .user-profile-header {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 1rem;
        }
        
        .table-user-info {
            background-color: white;
        }
        
        .table-user-info th {
            width: 30%;
            background-color: var(--secondary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #9a3e03;
            border-color: #9a3e03;
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }
        
        footer {
            background-color: var(--primary-color);
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
                            <a href="<?= base_url('usuarios/editar') ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Editar Perfil
                            </a>
                            
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
                    <div class="alert alert-info">
                        Você ainda não cadastrou nenhum endereço. Clique no botão acima para adicionar.
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal de Cadastro de Endereço -->
<div class="modal fade" id="modalEndereco" tabindex="-1" aria-labelledby="modalEnderecoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('enderecos/salvar') ?>" method="post" class="modal-content">
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
                        <input type="text" name="cep" id="cep" class="form-control" required maxlength="9" placeholder="00000-000" />
                    </div>
                    <div class="col-md-7 mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control" required maxlength="255" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" name="numero" id="numero" class="form-control" required maxlength="20" />
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" name="complemento" id="complemento" class="form-control" maxlength="100" />
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" required maxlength="100" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="estado" class="form-label">Estado (UF)</label>
                        <select name="estado" id="estado" class="form-select" required>
                        <option value="">Carregando estados...</option>
                    </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cidade" class="form-label">Município</label>
                        <select name="cidade" id="cidade" class="form-select" required>
                            <option value="">Selecione o município</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pais" class="form-label">País</label>
                    <input type="text" name="pais" id="pais" class="form-control" required maxlength="100" value="Brasil" />
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

<!-- Rodapé -->
    <footer>
        <div class="container">
            <small>© <?= date('Y') ?> GestorCheff - Simplificando a Gestão de Restaurantes</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Máscara para CEP
        document.getElementById('cep').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });
        
        // Máscara para telefone (se quiser adicionar)
    </script>

    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const estadoSelect = document.getElementById('estado');
        const cidadeSelect = document.getElementById('cidade');
        const cepInput = document.getElementById('cep');
        const logradouroInput = document.getElementById('logradouro');
        const bairroInput = document.getElementById('bairro');

        // Carrega estados via API IBGE
        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            .then(response => response.json())
            .then(estados => {
                // Ordena os estados pelo nome
                estados.sort((a, b) => a.nome.localeCompare(b.nome));
                estadoSelect.innerHTML = '<option value="">Selecione o estado</option>';
                estados.forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado.sigla;
                    option.textContent = estado.nome + ' (' + estado.sigla + ')';
                    estadoSelect.appendChild(option);
                });
            })
            .catch(() => {
                estadoSelect.innerHTML = '<option value="">Erro ao carregar estados</option>';
            });

        // Quando um estado é selecionado, carrega os municípios daquele estado
        estadoSelect.addEventListener('change', function () {
            const uf = this.value;
            cidadeSelect.innerHTML = '<option value="">Carregando municípios...</option>';

            if (!uf) {
                cidadeSelect.innerHTML = '<option value="">Selecione o município</option>';
                return;
            }

            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
                .then(response => response.json())
                .then(municipios => {
                    cidadeSelect.innerHTML = '<option value="">Selecione o município</option>';
                    municipios.sort((a, b) => a.nome.localeCompare(b.nome));
                    municipios.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.nome;
                        option.textContent = municipio.nome;
                        cidadeSelect.appendChild(option);
                    });

                    // Se o CEP já trouxe uma cidade, tenta selecionar ela
                    if (logradouroInput.dataset.cepCidade) {
                        cidadeSelect.value = logradouroInput.dataset.cepCidade;
                    }
                })
                .catch(() => {
                    cidadeSelect.innerHTML = '<option value="">Erro ao carregar municípios</option>';
                });
        });

        // Busca endereço pelo CEP usando ViaCEP API
        cepInput.addEventListener('blur', function () {
            let cep = this.value.replace(/\D/g, '');

            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            logradouroInput.value = data.logradouro || '';
                            bairroInput.value = data.bairro || '';
                            estadoSelect.value = data.uf || '';
                            logradouroInput.dataset.cepCidade = data.localidade || '';

                            // Dispara evento para carregar municípios e depois seta a cidade
                            estadoSelect.dispatchEvent(new Event('change'));

                            // Após carregar os municípios, define a cidade selecionada
                            const trySetCidade = () => {
                                if (cidadeSelect.options.length > 1) {
                                    cidadeSelect.value = data.localidade || '';
                                } else {
                                    setTimeout(trySetCidade, 100);
                                }
                            };
                            trySetCidade();

                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(() => alert('Erro ao consultar o CEP.'));
            }
        });

        // Máscara para CEP
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });
    });
    </script>
</body>
</html>