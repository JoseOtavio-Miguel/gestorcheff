<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Rastrear Pedidos - GestorCheff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .status-badge {
            font-size: 0.875rem;
            padding: 0.4rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-aguardando     { background-color: #ffc107; color: #000; }
        .status-preparando     { background-color: #0dcaf0; color: #000; }
        .status-enviado        { background-color: #0d6efd; color: #fff; }
        .status-finalizado     { background-color: #198754; color: #fff; }
        .status-cancelado      { background-color: #dc3545; color: #fff; }

        .pedido-card {
            border-left: 5px solid #0d6efd;
            background: #fff;
        }

        .item-nome {
            font-weight: 500;
        }
    </style>
</head>
<body>

<?= view('/layouts/navmenu') ?>

<div class="container py-5">
    <h1 class="mb-4"><i class="bi bi-truck me-2"></i>Meus Pedidos</h1>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-emoji-frown me-2"></i>Nenhum pedido encontrado.
        </div>
    <?php else: ?>
        <div class="accordion" id="accordionPedidos">
            <?php foreach ($pedidos as $index => $pedido): ?>
                <div class="card mb-3 pedido-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Pedido #<?= $pedido['id'] ?></h5>
                                <small class="text-muted">Feito em: <?= date('d/m/Y H:i', strtotime($pedido['data'])) ?></small>
                            </div>
                            <div>
                                <span class="status-badge status-<?= $pedido['status'] ?>">
                                    <?= ucfirst($pedido['status']) ?>
                                </span>
                            </div>
                        </div>

                        <?php if (!empty($pedido['itens'])): ?>
                            <ul class="mt-3 list-group list-group-flush">
                                <?php $total = 0; ?>
                                <?php foreach ($pedido['itens'] as $item): ?>
                                    <?php $subtotal = $item['quantidade'] * $item['preco_unitario']; ?>
                                    <?php $total += $subtotal; ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="item-nome"><?= esc($item['nome']) ?></div>
                                            <small class="text-muted"><?= $item['quantidade'] ?>x - R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></small>
                                        </div>
                                        <strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong>
                                    </li>
                                <?php endforeach; ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
