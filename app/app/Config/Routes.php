<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('listar', 'TransacaoController::listar');
$routes->get('listarLojas', 'TransacaoController::listarPorLoja');
$routes->post('upload', 'TransacaoController::upload');