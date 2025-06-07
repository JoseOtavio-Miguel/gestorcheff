<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Item do Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Item do Cardápio</h2>

    <form action="<?= base_url('cardapio/atualizar/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="restaurante_id" value="<?= $item['restaurante_id'] ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Item</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= esc($item['nome']) ?>" required maxlength="100">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="500"><?= esc($item['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="<?= esc($item['preco']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" name="categoria" id="categoria" class="form-control" value="<?= esc($item['categoria']) ?>" required maxlength="50">
        </div>

        
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem (opcional)</label><br>
            <?php if (!empty($item['imagem'])): ?>
                <img src="<?= base_url('uploads/' . $item['imagem']) ?>" alt="Imagem atual" class="img-thumbnail mb-2" width="150">
                <p><small>Arquivo atual: <strong><?= esc($item['imagem']) ?></strong></small></p>

                <!-- Checkbox para remover imagem -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="remover_imagem" id="remover_imagem" value="1">
                    <label class="form-check-label" for="remover_imagem">
                        Remover imagem atual
                    </label>
                </div>
            <?php else: ?>
                <p><small>Nenhuma imagem cadastrada.</small></p>
            <?php endif; ?>
            <input type="file" name="imagem" id="imagem" class="form-control">
        </div>


        <div class="mb-3">
            <label for="disponivel" class="form-label">Disponível?</label>
            <select name="disponivel" id="disponivel" class="form-select" required>
                <option value="sim" <?= $item['disponivel'] === 'sim' ? 'selected' : '' ?>>Sim</option>
                <option value="nao" <?= $item['disponivel'] === 'nao' ? 'selected' : '' ?>>Não</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Atualizar Item</button>
    </form>
</div>
</body>
</html>
