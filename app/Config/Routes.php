<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* Bloco Home */

// Página Home 
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');



/* Bloco Restaurante  */

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



/* Bloco Usuário */

// Página para Registro do Usuario 
$routes->get('usuarios/cadastro', 'Usuarios::cadastro');

// Página contendo o painel do Usuário
$routes->get('usuarios/painel-usuario', 'Usuarios::painelUsuario');

// Página para Login do Usuário 
$routes->get('usuarios/login', 'Usuarios::login');

// Criar Usuarios
$routes->post('usuarios/cadastrar', 'Usuarios::cadastrar');

// Logar na Conta
$routes->post('usuarios/logar', 'Usuarios::logar');

//Deslogar da Conta
$routes->get('usuarios/logout', 'Usuarios::logout');

// Informações do Usuário 
$routes->get('usuarios/informacao', 'Usuarios::informacao');



/* Bloco Cardapio */
// Página Principal de Cardapio
$routes->get('cardapio/(:num)', 'Cardapio::index/$1');

// Página de Cadastro 
$routes->get('cardapio/novo/(:num)', 'Cardapio::novo/$1');

// Cadastrar novo Cardapio
$routes->post('cardapio/salvar/(:num)', 'Cardapio::salvar/$1');

$routes->get('cardapiousuario/cardapio', 'CardapioUsuario::cardapio');

// routes.php
$routes->get('cardapio/painel/(:num)', 'Cardapio::painel/$1');

$routes->get('restaurantes/editar/(:num)', 'Restaurantes::editar/$1');
$routes->post('restaurantes/atualizar/(:num)', 'Restaurantes::atualizar/$1');

$routes->get('relatorios', 'Relatorios::index');

$routes->get('pedidos/(:num)', 'Pedidos::index/$1');

$routes->get('usuarios/painelUsuario', 'Usuarios::painelUsuario');


$routes->get('cardapio/editar/(:num)', 'Cardapio::editar/$1');
$routes->post('cardapio/atualizar/(:num)', 'Cardapio::atualizar/$1');
$routes->get('cardapio/listar/(:num)', 'Cardapio::listar/$1');
