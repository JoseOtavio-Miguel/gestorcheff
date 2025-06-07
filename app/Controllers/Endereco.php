<?php

namespace App\Controllers;

use App\Models\EnderecoModel;
use App\Models\UsuarioModel;


class Endereco extends BaseController
{
    public function salvar()
    {
        $model = new EnderecoModel();

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

        // Verifica se já existe um endereço igual
        $existe = $model->where([
            'usuario_id' => $data['usuario_id'],
            'cep'        => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero'     => $data['numero'],
        ])->first();

        if ($existe) {
            return redirect()->back()->with('error', 'Endereço já cadastrado.');
        }

        $model->save($data);
        return redirect()->to('/usuarios/informacao')->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function editar($id)
    {
        $model = new EnderecoModel();
        $endereco = $model->find($id);

        if (!$endereco || $endereco['usuario_id'] !== session()->get('usuario_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Endereço não encontrado');
        }

        return view('enderecos/editar', ['endereco' => $endereco]);
    }

    public function excluir($id)
    {
        $model = new EnderecoModel();
        $endereco = $model->find($id);

        if ($endereco && $endereco['usuario_id'] == session()->get('usuario_id')) {
            $model->delete($id);
            return redirect()->to('/usuarios/informacao')->with('success', 'Endereço excluído com sucesso.');
        }

        return redirect()->to('/usuarios/informacao')->with('error', 'Endereço não encontrado ou acesso negado.');
    }

    public function atualizar($id)
    {
        $model = new EnderecoModel();

        $data = [
            'id'         => $id,
            'usuario_id' => $this->request->getPost('usuario_id'),
            'cep'        => $this->request->getPost('cep'),
            'logradouro' => $this->request->getPost('logradouro'),
            'numero'     => $this->request->getPost('numero'),
            'complemento'=> $this->request->getPost('complemento'),
            'bairro'     => $this->request->getPost('bairro'),
            'cidade'     => $this->request->getPost('cidade'),
            'estado'     => $this->request->getPost('estado'),
            'pais'       => $this->request->getPost('pais'),
        ];

        // Verifica duplicidade (excluindo o próprio id atual)
        $existe = $model->where([
            'usuario_id' => $data['usuario_id'],
            'cep'        => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero'     => $data['numero'],
        ])->where('id !=', $id)->first();

        if ($existe) {
            return redirect()->back()->with('error', 'Já existe outro endereço com esses dados.');
        }

        $model->save($data);
        return redirect()->to('/usuarios/informacao')->with('success', 'Endereço atualizado com sucesso!');
    }


}
