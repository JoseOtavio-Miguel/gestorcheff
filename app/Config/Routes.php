<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*     Bloco Home      */
/* ------------------- */

// Página Home 
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
/* ------------------- */



/*  Bloco Restaurante  */
/* ------------------- */

// Página para cadastro de restaurante
$routes->get('/restaurantes/cadastro', 'Restaurantes::cadastro');

// Cadastrar restaurante
$routes->post('restaurantes/cadastrar', 'Restaurantes::cadastrar');

// Página de login do restaurante
$routes->get('restaurantes/login','Restaurantes::login');

// Logar restaurante
$routes->post('restaurantes/logar', 'Restaurantes::logar');

// Painel do restaurante
$routes->get('painel/(:num)', 'Restaurantes::painel/$1');

// Página de Edição do Restaurante
$routes->get('restaurantes/editar/(:num)', 'Restaurantes::editar/$1');

// Atualizar Informações do Restaurante
$routes->post('restaurantes/atualizar/(:num)', 'Restaurantes::atualizar/$1');
/* ------------------- */


/*    Bloco Usuário    */
/* ------------------- */

// Página para Registro do Usuario 
$routes->get('usuarios/cadastro', 'Usuarios::cadastro');

// Criar Usuarios
$routes->post('usuarios/cadastrar', 'Usuarios::cadastrar');

// Página para Login do Usuário 
$routes->get('usuarios/login', 'Usuarios::login');

// Logar na Conta
$routes->post('usuarios/logar', 'Usuarios::logar');

//Deslogar da Conta
$routes->get('usuarios/logout', 'Usuarios::logout');

// Página contendo o painel do Usuário
$routes->get('usuarios/painel-usuario', 'Usuarios::painelUsuario');

// Informações do Usuário 
$routes->get('usuarios/informacao', 'Usuarios::informacao');

// Atualizar Informações do Usuário
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');

// Painel do Usuário
$routes->get('usuarios/painelUsuario', 'Usuarios::painelUsuario');
/* ------------------- */


/*   Bloco Cardápio    */
/* ------------------- */

// Página Principal de Cardapio
$routes->get('cardapio/(:num)', 'Cardapio::index/$1');

// Página de Cadastro 
$routes->get('cardapio/novo/(:num)', 'Cardapio::novo/$1');

// Cadastrar novo Cardapio
$routes->post('cardapio/salvar/(:num)', 'Cardapio::salvar/$1');

// Página de Listagem do Cardápio
$routes->get('cardapiousuario/cardapio', 'CardapioUsuario::cardapio');

// Página de Listagem do Cardápio do Restaurante
$routes->get('cardapio/painel/(:num)', 'Cardapio::painel/$1');

// Página de Edição do Cardápio
$routes->get('cardapio/editar/(:num)', 'Cardapio::editar/$1');

// Atualizar Cardápio
$routes->post('cardapio/atualizar/(:num)', 'Cardapio::atualizar/$1');

// Página de Listagem do Cardápio
$routes->get('cardapio/listar/(:num)', 'Cardapio::listar/$1');
/* ------------------- */

 
/*   Bloco Endereço    */
/* ------------------- */

$routes->get('api/enderecos/usuario/(:num)', 'Api\Enderecos::usuario/$1');


// Página de Cadastro do Endereço
$routes->post('endereco/salvar', 'Endereco::salvar');

// Página de Exclusao do Endereço
$routes->post('endereco/excluir/(:num)', 'Endereco::excluir/$1');

// Salvar Endereço do Usuário
$routes->get('/endereco/perfil', 'Endereco::perfil');

// Página de Edição do Endereço
$routes->post('endereco/atualizar/(:num)', 'Endereco::atualizar/$1');
/* ------------------- */


/* Bloco Pedidos */
/* ------------------- */

// Página de Pedidos do Restaurante
$routes->get('pedidos/(:num)', 'Pedidos::index/$1');

// Salvar Pedido
$routes->get('pedidos/rastrear', 'Pedidos::rastrear'); 

$routes->post('pedidos/salvar', 'Pedidos::salvar');
/* ------------------- */


/*   Bloco Relátorios  */
/* ------------------- */

// Página de Relatórios
$routes->get('relatorios', 'Relatorios::index');

// Sincronizar Relatórios (para uso administrativo)
$routes->get('relatorios/sincronizar', 'Relatorios::sincronizar');


// Rotas de Pedidos (adicionar no seu arquivo app/Config/Routes.php)

$routes->group('pedidos', function($routes) {
    // Rastreamento de pedidos pelo usuário
    $routes->get('rastrear', 'Pedidos::rastrear', ['as' => 'usuario.pedidos']);
    
    // Detalhes de um pedido específico
    $routes->get('detalhes/(:num)', 'Pedidos::detalhes/$1', ['as' => 'usuario.pedidos.detalhes']);
    
    // Cancelamento de pedido (via AJAX)
    $routes->post('cancelar', 'Pedidos::cancelar', ['as' => 'usuario.pedidos.cancelar']);
    
    // Salvar novo pedido (usado no checkout)
    $routes->post('salvar', 'Pedidos::salvar', ['as' => 'usuario.pedidos.salvar']);
});

// Rotas para o restaurante ver seus pedidos (se necessário)
$routes->group('restaurante', function($routes) {
    $routes->get('pedidos/(:num)', 'Pedidos::index/$1', ['as' => 'restaurante.pedidos']);
});