<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Item do Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --light-color: #f5f6fa;
            --success-color: #00b894;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card-menu {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .card-menu:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #5649d1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.3);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
        }
        
        .file-upload-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
            color: #7f8c8d;
            text-align: center;
            transition: all 0.3s;
        }
        
        .file-upload-label:hover {
            border-color: var(--primary-color);
            background-color: #f0f0f0;
        }
        
        .file-upload-icon {
            font-size: 24px;
            margin-right: 10px;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 15px;
            display: none;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-menu">
                <div class="card-header text-center">
                    <h2 class="mb-0"><i class="fas fa-utensils me-2"></i>Cadastrar Novo Item</h2>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('cardapio/salvar/' . $restauranteId) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="restaurante_id" value="<?= $restauranteId ?>">

                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome do Item</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                <input type="text" name="nome" id="nome" class="form-control" required maxlength="100" placeholder="Ex: Filé Mignon com Molho de Vinho">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="form-label">Descrição</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                                <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="500" placeholder="Descreva o item em detalhes..."></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="preco" class="form-label">Preço</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">R$</span>
                                    <input type="number" step="0.01" name="preco" id="preco" class="form-control" required placeholder="0,00">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="categoria" class="form-label">Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-list"></i></span>
                                    <input type="text" name="categoria" id="categoria" class="form-control" required maxlength="50" placeholder="Ex: Prato Principal">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="imagem" class="form-label">Imagem do Item</label>
                            <div class="file-upload">
                                <label for="imagem" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <span>Clique para enviar ou arraste uma imagem</span>
                                </label>
                                <input type="file" name="imagem" id="imagem" class="file-upload-input" accept="image/*">
                            </div>
                            <img id="imagePreview" src="#" alt="Pré-visualização da imagem" class="preview-image">
                        </div>

                        <div class="mb-4">
                            <label for="disponivel" class="form-label">Disponibilidade</label>
                            <select name="disponivel" id="disponivel" class="form-select" required>
                                <option value="sim">Disponível</option>
                                <option value="nao">Indisponível</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Salvar Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Preview da imagem ao selecionar
    document.getElementById('imagem').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
    
    // Efeito de drag and drop
    const fileUpload = document.querySelector('.file-upload');
    const fileInput = document.querySelector('.file-upload-input');
    
    fileUpload.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUpload.querySelector('.file-upload-label').style.borderColor = '#6c5ce7';
        fileUpload.querySelector('.file-upload-label').style.backgroundColor = '#f0f0f0';
    });
    
    fileUpload.addEventListener('dragleave', () => {
        fileUpload.querySelector('.file-upload-label').style.borderColor = '#e0e0e0';
        fileUpload.querySelector('.file-upload-label').style.backgroundColor = '#f9f9f9';
    });
    
    fileUpload.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUpload.querySelector('.file-upload-label').style.borderColor = '#e0e0e0';
        fileUpload.querySelector('.file-upload-label').style.backgroundColor = '#f9f9f9';
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    });
</script>
</body>
</html>