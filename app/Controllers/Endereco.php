<?php

namespace App\Controllers;

use App\Models\EnderecoModel;

class Endereco extends BaseController
{
    public function salvar()
    {
        $model = new EnderecoModel();

        // Pega os dados do formulário via POST
        $data = [
            'usuario_id'  => $this->request->getPost('usuario_id'),
            'logradouro'  => $this->request->getPost('logradouro'),
            'numero'      => $this->request->getPost('numero'),
            'complemento' => $this->request->getPost('complemento'),
            'bairro'      => $this->request->getPost('bairro'),
            'cidade'      => $this->request->getPost('cidade'),
            'estado'      => $this->request->getPost('estado'),
            'cep'         => $this->request->getPost('cep'),
            'pais'        => $this->request->getPost('pais'),
        ];

        // Você pode colocar uma validação simples aqui, por exemplo:
        if (empty($data['usuario_id']) || empty($data['logradouro']) || empty($data['numero'])) {
            return redirect()->back()->with('error', 'Campos obrigatórios não preenchidos.');
        }

        // Salva os dados
        $model->save($data);

        // Redireciona para a página desejada (exemplo: painel do usuário)
        return redirect()->to('/usuarios/painelUsuario')->with('success', 'Endereço cadastrado com sucesso!');
    }
}
