<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTipoTransacao extends Migration
{
    public function up()
    {
                // Criar tabela tipos_transacao
                $this->forge->addField([
                    'id' => [
                        'type' => 'INT',
                        'unsigned' => true,
                        'auto_increment' => true,
                    ],
                    'tipo' => [
                        'type' => 'INT',
                        'null' => false,
                        'unique' => true
                    ],
                    'descricao' => [
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => false,
                    ],
                    'natureza' => [
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => false,
                    ],
                    'sinal' => [
                        'type' => 'CHAR',
                        'constraint' => '1',
                        'null' => false,
                    ],
                ]);
                $this->forge->addPrimaryKey('id');
                $this->forge->createTable('tipos_transacao');
        
                // Inserir dados iniciais na tabela tipos_transacao
                $data = [
                    ['tipo' => 1, 'descricao' => 'Débito', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 2, 'descricao' => 'Boleto', 'natureza' => 'Saída', 'sinal' => '-'],
                    ['tipo' => 3, 'descricao' => 'Financiamento', 'natureza' => 'Saída', 'sinal' => '-'],
                    ['tipo' => 4, 'descricao' => 'Crédito', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 5, 'descricao' => 'Recebimento Empréstimo', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 6, 'descricao' => 'Vendas', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 7, 'descricao' => 'Recebimento TED', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 8, 'descricao' => 'Recebimento DOC', 'natureza' => 'Entrada', 'sinal' => '+'],
                    ['tipo' => 9, 'descricao' => 'Aluguel', 'natureza' => 'Saída', 'sinal' => '-'],
                ];
                $this->db->table('tipos_transacao')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('tipos_transacao', true);
    }
}
