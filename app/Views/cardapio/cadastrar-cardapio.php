<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Item do Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Cadastrar Novo Item do Cardápio</h2>

    <form action="<?= base_url('cardapio/salvar/' . $restauranteId) ?>" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="restaurante_id" value="<?= $restauranteId ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Item</label>
            <input type="text" name="nome" id="nome" class="form-control" required maxlength="100">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="500"></textarea>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" name="categoria" id="categoria" class="form-control" required maxlength="50">
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
        </div>

        <div class="mb-3">
            <label for="disponivel" class="form-label">Disponível?</label>
            <select name="disponivel" id="disponivel" class="form-select" required>
                <option value="sim">Sim</option>
                <option value="nao">Não</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Item</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
