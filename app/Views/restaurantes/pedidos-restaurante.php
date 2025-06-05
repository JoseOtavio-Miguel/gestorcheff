<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - GestorCheff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4">Pedidos Recebidos</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pedidos)): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= esc($pedido['id']) ?></td>
                        <td><?= esc($pedido['cliente_nome']) ?></td>
                        <td><?= esc($pedido['cliente_telefone']) ?></td>
                        <td><?= esc($pedido['cliente_endereco']) ?></td>
                        <td>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></td>
                        <td>
                            <span class="badge 
                                <?= $pedido['status'] == 'aguardando' ? 'bg-warning' : '' ?>
                                <?= $pedido['status'] == 'preparando' ? 'bg-primary' : '' ?>
                                <?= $pedido['status'] == 'enviado' ? 'bg-info' : '' ?>
                                <?= $pedido['status'] == 'finalizado' ? 'bg-success' : '' ?>
                                <?= $pedido['status'] == 'cancelado' ? 'bg-danger' : '' ?>">
                                <?= ucfirst($pedido['status']) ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($pedido['criado_em'])) ?></td>
                        <td>
                            <!-- Botões futuros -->
                            <a href="<?= base_url('pedidos/detalhes/' . $pedido['id']) ?>" class="btn btn-sm btn-secondary">Ver</a>
                            <a href="<?= base_url('pedidos/editar/' . $pedido['id']) ?>" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">
            Nenhum pedido encontrado.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
