<?php
namespace App\Controllers;
use App\Models\UsuariosModel; // correto!
use CodeIgniter\Controller; // ou BaseController, depende de onde herdou


class Pedidos extends BaseController {

    public function index($restauranteId)
    {
        $pedidosModel = new \App\Models\PedidosModel();

        $pedidos = $pedidosModel->where('restaurante_id', $restauranteId)->orderBy('criado_em', 'DESC')->findAll();

        return view('restaurantes/pedidos-restaurante', [
            'pedidos' => $pedidos
        ]);
    }



        // Pedidos.php (Controller)
    public function salvar()
    {
        $pedidoModel = new \App\Models\PedidosModel();
        $itensModel = new \App\Models\ItensPedidoModel();

        $json = $this->request->getPost('itens');
        $itens = json_decode($json, true);

        if (!$itens) {
            return redirect()->back()->with('error', 'Nenhum item no pedido.');
        }

        // Cria pedido
        $pedidoId = $pedidoModel->insert([
            'usuario_id' => session()->get('usuario_id'),
            'status' => 'pendente',
            'data' => date('Y-m-d H:i:s')
        ]);

        // Insere itens
        foreach ($itens as $item) {
            $itensModel->insert([
                'pedido_id' => $pedidoId,
                'item_cardapio_id' => $item['id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco']
            ]);
        }

        return redirect()->to(base_url('usuario/pedidos'))->with('success', 'Pedido realizado com sucesso!');
    }
    
}

?>