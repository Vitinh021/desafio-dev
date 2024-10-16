<?php

namespace App\Services;

use App\Models\TransacaoModel;
use DateTime;
use Exception;

class TransacaoService
{
   private $transacaoModel;

   public function __construct()
   {
      $this->transacaoModel = new TransacaoModel();
   }

   //lista todas transacoes
   public function listarTransacoes()
   {
      return $this->transacaoModel->findAll();
   }

   //lista as tracacoes por loja e calcula o saldo
   public function listarTransacoesPorLoja()
   {
      return $this->transacaoModel->select('transacoes.nome_loja, SUM(CASE WHEN tipos_transacao.sinal = "+" THEN transacoes.valor ELSE -transacoes.valor END) as Saldo')
         ->join('tipos_transacao', 'tipos_transacao.tipo = transacoes.tipo')
         ->groupBy('transacoes.nome_loja')
         ->findAll();
   }

   //salva os dados do arquivo na base
   public function importarArquivo($file)
   {
      $fileContent = $this->lerArquivo($file);
      if (!$fileContent) {
         throw new Exception('Falha ao ler o arquivo.');
      }

      foreach ($fileContent as $line) {
         $data = $this->parsearDadosTransacao($line);

         try {
            $this->transacaoModel->insert($data);
         } catch (Exception $e) {
            throw new Exception('Erro ao inserir transação: ' . $e->getMessage());
         }
      }

      return ['response' => 'success', 'msg' => 'Arquivo importado com sucesso!'];
   }

   private function lerArquivo($file)
   {
      $fileContent = [];
      $handle = fopen($file, 'r');

      if ($handle) {
         while (($line = fgets($handle)) !== false) {
            $fileContent[] = $line;
         }
         fclose($handle);
         return $fileContent;
      }

      return false;
   }

   private function parsearDadosTransacao($line)
   {
      return [
         'tipo' => intval(substr($line, 0, 1)),
         'data' => DateTime::createFromFormat('Ymd', substr($line, 1, 8))->format('Y-m-d'),
         'valor' => (floatval(substr($line, 9, 10)) / 100),
         'cpf' => substr($line, 19, 11),
         'cartao' => substr($line, 30, 12),
         'hora' => DateTime::createFromFormat('His', substr($line, 42, 6))->format('H:i:s'),
         'dono_loja' => trim(substr($line, 48, 14)),
         'nome_loja' => trim(substr($line, 62, 19))
      ];
   }
}
