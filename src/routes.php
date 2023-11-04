<?php

namespace App;

use App\controllers\CardapioController;
use App\controllers\CategoriaController;
use App\controllers\CheckoutController;
use App\controllers\ClientesController;
use App\controllers\PedidoController;
use App\controllers\PedidoItensController;
use App\controllers\PreparoController;
use App\api\FastFoodApp;
use App\external\PdoConnect;

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$routes = [];

$fastFoodApp = new FastFoodApp();

// Home - Exibe o cardápio
$routes['/'] = [
    'GET' => function ($params = null) use ($fastFoodApp) {
        return $fastFoodApp->list(CardapioController::class);
    }
];

// Clientes
$routes['/clientes'] = [
    'POST' => function ($params = null) use ($data, $fastFoodApp) {
        return $fastFoodApp->create(ClientesController::class, $data);
    },
    'GET' => function ($params = null) use ($fastFoodApp){
        return $fastFoodApp->list(ClientesController::class, $params);
    }
];

$routes['/clientes/{id}'] = [
    'PUT' => function ($id) use ($data, $fastFoodApp) {
        return $fastFoodApp->update(ClientesController::class, $id, $data);
    },
    'DELETE' => function ($id) use($fastFoodApp) {
        return $fastFoodApp->delete(ClientesController::class, $id);
    },
    'GET' => function ($id) use($fastFoodApp) {
        return $fastFoodApp->show(ClientesController::class, $id);
    }
];

$routes['/clientes/cpf/{cpf}'] = [
    'GET' => function ($cpf) use($fastFoodApp) {
        return $fastFoodApp->query(ClientesController::class, $cpf, 'showByCpf');
    }
];

// Pedidos
$routes['/pedido'] = [
    'POST' => function ($params = null) use ($data, $fastFoodApp) {
        return $fastFoodApp->create(PedidoController::class, $data);
    },
    'GET' => function ($params = null) use ($fastFoodApp) {
        return $fastFoodApp->list(PedidoController::class);
    }
];

$routes['/pedidos'] = [
    'GET' => function ($params = null) use ($fastFoodApp) {
        return $fastFoodApp->query(PedidoController::class, [], 'pedidos');
    }
];

$routes['/pedido/{id}'] = [
    'PUT' => function ($id) use ($data, $fastFoodApp) {
        return $fastFoodApp->update(PedidoController::class, $id, $data);
    },
    'DELETE' => function ($id) use($fastFoodApp) {
        return $fastFoodApp->delete(PedidoController::class, $id);
    },
    'GET' => function ($id) use($fastFoodApp) {
        return $fastFoodApp->show(PedidoController::class, $id);
    }
];

$routes['/pedido-status'] = [
    'GET' => function ($params = null) use($fastFoodApp) {
        return $fastFoodApp->query(PedidoController::class, [], 'statusList');
    }
];

$routes['/pedido-status/{status}'] = [
    'GET' => function ($status) use($fastFoodApp) {
        return $fastFoodApp->query(PedidoController::class, ['status' => $status], 'listByStatus');
    }
];

// Cardapio
$routes['/cardapio'] = [
    'POST' => function ($params = null) use ($data, $fastFoodApp) {
        return $fastFoodApp->create(CardapioController::class, $data);
    },
    'GET' => function ($params = null) use($fastFoodApp) {
        return $fastFoodApp->list(CardapioController::class);
    }
];

$routes['/cardapio/{id}'] = [
    'PUT' => function ($id) use ($data, $fastFoodApp) {
        return $fastFoodApp->update(CardapioController::class, $id, $data);
    },
    'DELETE' => function ($id) use($fastFoodApp){
        return $fastFoodApp->delete(CardapioController::class, $id);
    },
    'GET' => function ($id) use($fastFoodApp){
        return $fastFoodApp->show(CardapioController::class, $id);
    }
];

// Categoria
$routes['/categorias-cardapio'] = [
    'GET' => function ($params = null) use($fastFoodApp) {
        return $fastFoodApp->query(CardapioController::class, [], 'categoriasList');
    }
];

$routes['/categorias-cardapio/{categoria}'] = [
    'GET' => function ($categoria) use($fastFoodApp) {
        return $fastFoodApp->query(CardapioController::class, ['categoria' => $categoria], 'listByCategoria');
    }
];

// Healthcheck
$routes['/healthcheck'] = [
    'GET' => function () {
        return json_encode(['status' => 'ok']);
    }
];


return $routes;

