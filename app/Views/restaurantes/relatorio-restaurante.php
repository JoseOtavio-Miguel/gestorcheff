<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatórios dos Restaurantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Relatórios dos Restaurantes</h2>

    <table id="tabela-relatorios" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Restaurante</th>
                <th>Total de Pedidos</th>
                <th>Receita Total</th>
                <th>Avaliação Média</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relatorios as $relatorio): ?>
                <tr>
                    <td><?= esc($relatorio['nome_restaurante']) ?></td>
                    <td><?= esc($relatorio['total_pedidos']) ?></td>
                    <td>R$ <?= number_format($relatorio['receita_total'], 2, ',', '.') ?></td>
                    <td><?= esc($relatorio['avaliacao_media']) ?></td>
                    <td><?= esc($relatorio['criado_em']) ?></td>
                    <td><?= esc($relatorio['atualizado_em']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- JS do Bootstrap e DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tabela-relatorios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            }
        });
    });
</script>

</body>
</html>
