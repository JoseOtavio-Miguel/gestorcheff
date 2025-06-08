<?php
namespace App\Controllers;
use App\Models\ItensCardapioModel;
use App\Models\UsuariosModel; 
use App\Models\ItensPedidoModel;
use App\Models\PedidosModel;
use CodeIgniter\Controller; 



class Pedidos extends BaseController {

    /**
     * Página de pedidos do restaurante
     * 
     * @param int $restauranteId
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index($restauranteId)
    {
        $pedidosModel = new \App\Models\PedidosModel();

        $pedidos = $pedidosModel->where('restaurante_id', $restauranteId)->orderBy('criado_em', 'DESC')->findAll();

        return view('restaurantes/pedidos-restaurante', [
            'pedidos' => $pedidos
        ]);
    }


    /**
     * Página de pedidos do usuário
    */
    public function salvar()
    {
        $pedidoModel = new PedidosModel();
        $itensPedidoModel = new ItensPedidoModel();
        $cardapioModel = new ItensCardapioModel();

        $usuarioId = session()->get('usuario_id'); // Usuário logado
        $enderecoId = $this->request->getPost('endereco_id'); // Enviado pelo modal no form
        $jsonItens = $this->request->getPost('itens');
        $itens = json_decode($jsonItens, true);

        // Validação básica
        if (!$usuarioId) {
            return redirect()->back()->with('error', 'Usuário não está logado.');
        }
        if (!$enderecoId) {
            return redirect()->back()->with('error', 'Endereço não selecionado.');
        }
        if (!$itens || count($itens) === 0) {
            return redirect()->back()->with('error', 'Nenhum item para salvar.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Criar o pedido
        $pedidoData = [
            'usuario_id'  => $usuarioId,
            'endereco_id' => $enderecoId,
            'status'     => 'pendente',
            'total'      => 0, // Será calculado abaixo
            'criado_em'  => date('Y-m-d H:i:s'),
        ];

        $pedidoId = $pedidoModel->insert($pedidoData);

        if (!$pedidoId) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Erro ao criar pedido.');
        }

        $totalPedido = 0;

        // Inserir itens do pedido
        foreach ($itens as $item) {
            if (!isset($item['id']) || !isset($item['quantidade'])) {
                continue;
            }

            $itemReal = $cardapioModel->find($item['id']);
            if (!$itemReal) {
                continue;
            }

            $quantidade = intval($item['quantidade']);
            $precoUnitario = floatval($itemReal['preco']);
            $precoTotal = $quantidade * $precoUnitario;
            $totalPedido += $precoTotal;

            $itensPedidoModel->insert([
                'pedido_id'      => $pedidoId,
                'cardapio_id'    => $item['id'],
                'quantidade'     => $quantidade,
                'preco_unitario' => $precoUnitario,
                'preco_total'    => $precoTotal,
                'criado_em'      => date('Y-m-d H:i:s'),
            ]);
        }

        // Atualizar total do pedido
        $pedidoModel->update($pedidoId, ['total' => $totalPedido]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Falha ao salvar o pedido e seus itens.');
        }

        return redirect()->to('/pedidos/rastrear/'.$pedidoId)
            ->with('success', 'Pedido #'.$pedidoId.' realizado com sucesso!');
    }


    /**
     * Rastrear pedidos do usuário
     */
    public function rastrear()
    {
        $pedidoModel = new PedidosModel();
        $usuarioId = session()->get('usuario_id');

        $pedidos = $pedidoModel->where('usuario_id', $usuarioId)
                      ->orderBy('criado_em', 'DESC')
                      ->findAll();


        return view('usuario/rastreio-pedidos', [
            'pedidos' => $pedidos
        ]);
    }


}

?>