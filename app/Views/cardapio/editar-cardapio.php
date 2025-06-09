<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item do Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #f8f9fa;
            --dark-color: #343a40;
            --light-color: #ffffff;
            --success-color: #28a745;
        }
        
        body {
            background-color: #f5f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            max-width: 800px;
            background: var(--light-color);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        
        h2 {
            color: var(--dark-color);
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
        }
        
        .img-thumbnail {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: transform 0.3s;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.05);
        }
        
        .btn-success {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-success:hover {
            background-color: #5a52e0;
            transform: translateY(-2px);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .file-upload-input {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
        }
        
        .file-upload-label {
            display: block;
            padding: 0.5rem 1rem;
            background: var(--secondary-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            border: 1px dashed #ced4da;
        }
        
        .file-upload-label:hover {
            background: #e9ecef;
        }
        
        .section-card {
            background: var(--light-color);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-edit me-2"></i>Editar Item do Cardápio</h2>
        <a href="<?= base_url('cardapio') ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <form action="<?= base_url('cardapio/atualizar/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="restaurante_id" value="<?= $item['restaurante_id'] ?>">

        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Informações Básicas
            </div>
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Item</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= esc($item['nome']) ?>" required maxlength="100">
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="500"><?= esc($item['descricao']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="<?= esc($item['preco']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" value="<?= esc($item['categoria']) ?>" required maxlength="50">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-image"></i> Imagem do Produto
            </div>
            
            <div class="mb-3">
                <?php if (!empty($item['imagem'])): ?>
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('uploads/' . $item['imagem']) ?>" alt="Imagem atual" class="img-thumbnail me-3" width="120">
                        <div>
                            <p class="mb-1"><small>Arquivo atual:</small></p>
                            <p class="mb-2"><strong><?= esc($item['imagem']) ?></strong></p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remover_imagem" id="remover_imagem" value="1">
                                <label class="form-check-label" for="remover_imagem">
                                    Remover imagem atual
                                </label>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-light mb-3">
                        <i class="fas fa-info-circle me-2"></i> Nenhuma imagem cadastrada
                    </div>
                <?php endif; ?>
                
                <label for="imagem" class="form-label">Alterar imagem</label>
                <div class="file-upload">
                    <label for="imagem" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Escolher arquivo...
                    </label>
                    <input type="file" name="imagem" id="imagem" class="file-upload-input">
                </div>
                <small class="text-muted">Formatos suportados: JPG, PNG (Máx. 2MB)</small>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-toggle-on"></i> Disponibilidade
            </div>
            
            <div class="mb-3">
                <label for="disponivel" class="form-label">Status do Item</label>
                <select name="disponivel" id="disponivel" class="form-select" required>
                    <option value="sim" <?= $item['disponivel'] === 'sim' ? 'selected' : '' ?>>Disponível</option>
                    <option value="nao" <?= $item['disponivel'] === 'nao' ? 'selected' : '' ?>>Indisponível</option>
                </select>
                <small class="text-muted">Itens indisponíveis não serão exibidos para os clientes</small>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-2"></i> Atualizar Item
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar nome do arquivo selecionado
    document.getElementById('imagem').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Nenhum arquivo selecionado';
        document.querySelector('.file-upload-label').innerHTML = 
            `<i class="fas fa-cloud-upload-alt me-2"></i> ${fileName}`;
    });
</script>
</body>
</html>