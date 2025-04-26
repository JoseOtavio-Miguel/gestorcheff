<?php

namespace App\Controllers;

use App\Models\RestaurantesModel;
use CodeIgniter\Controller;

class Restaurantes extends Controller
{
    public function cadastro()
    {
        return view('restaurantes/cadastro-restaurante');
    }

    public function cadastrar()
    {
        $restaurantes = new RestaurantesModel();

        // Pega os dados do formulário
        $data = [
            'nome'        => $this->request->getPost('nome'),
            'descricao'   => $this->request->getPost('descricao'),
            'cnpj'        => $this->request->getPost('cnpj'),
            'telefone'    => $this->request->getPost('telefone'),
            'email'       => $this->request->getPost('email'),
            'rua'         => $this->request->getPost('rua'),
            'cidade'      => $this->request->getPost('cidade'),
            'estado'      => strtoupper($this->request->getPost('estado')),
            'cep'         => $this->request->getPost('cep'),
            'status'      => $this->request->getPost('status') ?? 'ativo',
            'senha'       => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT), // <--- cuidado aqui, já falo disso abaixo
        ];

        if ($restaurantes->save($data)) {
            return redirect()->to('/restaurantes/cadastro')->with('success', 'Restaurante cadastrado com sucesso!');
        } else {
            return redirect()->to('/restaurantes/cadastro')->with('error', 'Erro ao cadastrar restaurante.');
        }
    }

    public function login()
    {
        return view('restaurantes/login-restaurante');
    }

    public function logar()
    {
        $restaurantes = new \App\Models\RestaurantesModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $restaurante = $restaurantes->where('email', $email)->first();

        if ($restaurante && password_verify($senha, $restaurante['senha'])) {
            // Login bem-sucedido
            session()->set([
                'restaurante_id' => $restaurante['id'],
                'restaurante_nome' => $restaurante['nome'],
                'logged_in_restaurante' => true,
            ]);

            return redirect()->to(base_url('home'))->with('success', 'Login realizado com sucesso!');

        } else {
            // Falha no login
            return redirect()->to('/restaurantes/login-restaurante')->with('error', 'E-mail ou senha inválidos.');
        }
    }

}
