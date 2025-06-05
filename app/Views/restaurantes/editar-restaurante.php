<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Restaurante</h2>

    <form action="<?= base_url('restaurantes/atualizar/' . $restaurante['id']) ?>" method="post">
        <input type="hidden" name="id" value="<?= $restaurante['id'] ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= esc($restaurante['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3"><?= esc($restaurante['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?= esc($restaurante['cnpj']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?= esc($restaurante['telefone']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= esc($restaurante['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" name="rua" id="rua" class="form-control" value="<?= esc($restaurante['rua']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="<?= esc($restaurante['cidade']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control" maxlength="2" value="<?= esc($restaurante['estado']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" id="cep" class="form-control" value="<?= esc($restaurante['cep']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="ativo" <?= $restaurante['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="inativo" <?= $restaurante['status'] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="<?= base_url('restaurantes') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
