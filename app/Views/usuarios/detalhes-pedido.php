<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="container py-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detalhes do Pedido #<?= $pedido['id'] ?></h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informações do Pedido</h5>
                    <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($pedido['criado_em'])) ?></p>
                    <p><strong>Status:</strong> 
                        <span class="badge <?= getStatusBadgeClass($pedido['status']) ?>">
                            <?= ucfirst($pedido['status']) ?>
                        </span>
                    </p>
                    <p><strong>Valor Total:</strong> R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></p>
                </div>
                <div class="col-md-6">
                    <h5>Informações de Entrega</h5>
                    <p><strong>Endereço:</strong> <?= esc($pedido['cliente_endereco']) ?></p>
                    <p><strong>Telefone:</strong> <?= esc($pedido['cliente_telefone']) ?></p>
                </div>
            </div>

            <h5 class="mb-3">Itens do Pedido</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($itens)): ?>
                            <?php foreach ($itens as $item): ?>
                                <tr>
                                    <td><?= esc($item['item_nome']) ?></td>
                                    <td><?= $item['quantidade'] ?></td>
                                    <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                                    <td>R$ <?= number_format($item['preco_total'], 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4">Nenhum item encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <?php if (in_array($pedido['status'], ['aguardando', 'preparando'])): ?>
                    <button class="btn btn-danger cancelar-pedido" data-pedido-id="<?= $pedido['id'] ?>">
                        <i class="bi bi-x-circle"></i> Cancelar Pedido
                    </button>
                <?php endif; ?>
                <a href="<?= base_url('pedidos/rastrear') ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar para Meus Pedidos
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelarPedidoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Cancelamento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Deseja mesmo cancelar este pedido? Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-danger" id="confirmarCancelamento">Confirmar Cancelamento</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    let pedidoId;

    $('.cancelar-pedido').click(function () {
        pedidoId = $(this).data('pedido-id');
        $('#cancelarPedidoModal').modal('show');
    });

    $('#confirmarCancelamento').click(function () {
        $.post('<?= base_url('pedidos/cancelar') ?>', {
            pedido_id: pedidoId,
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        }, function (res) {
            if (res.success) {
                location.reload();
            } else {
                alert(res.message || 'Erro ao cancelar pedido');
            }
        }).fail(function () {
            alert('Erro ao comunicar com o servidor.');
        });
    });
});
</script>
<?= $this->endSection() ?>
