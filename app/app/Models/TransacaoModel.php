<?php

namespace App\Models;

use CodeIgniter\Model as M;

class TransacaoModel extends M {

    protected $table = "transacoes";
    protected $primaryKey = "id";
    protected $allowedFields = ['tipo', 'data', 'valor', 'cpf', 'cartao', 'hora', 'dono_loja', 'nome_loja'];
}