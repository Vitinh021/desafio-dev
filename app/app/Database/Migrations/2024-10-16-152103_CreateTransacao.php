<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransacao extends Migration
{
    public function up()
    {
        // Criar tabela transacoes
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'tipo' => [
                'type' => 'INT',
                'null' => true,
            ],
            'data' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'valor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
                'null' => true,
            ],
            'cartao' => [
                'type' => 'VARCHAR',
                'constraint' => '12',
                'null' => true,
            ],
            'hora' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'dono_loja' => [
                'type' => 'VARCHAR',
                'constraint' => '14',
                'null' => true,
            ],
            'nome_loja' => [
                'type' => 'VARCHAR',
                'constraint' => '19',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('tipo', 'tipos_transacao', 'tipo', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transacoes');
    }

    public function down()
    {
        $this->forge->dropTable('transacoes', true);
    }
}
