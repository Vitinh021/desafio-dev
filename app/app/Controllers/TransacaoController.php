<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Exception;
use App\Services\TransacaoService;
use App\Utils\Validacoes;

class TransacaoController extends ResourceController
{
   private $transacaoService;
   private $validacoes;

   public function __construct()
   {
      $this->transacaoService = new TransacaoService();
      $this->validacoes = new Validacoes();
   }

   // Listar todas as transações
   public function listar()
   {
      try {
         $data = $this->transacaoService->listarTransacoes();
         return $this->respond($data);
      } catch (Exception $e) {
         return $this->failServerError('Erro ao listar transações.');
      }
   }

   // Listar transações agrupadas por loja
   public function listarPorLoja()
   {
      try {
         $data = $this->transacaoService->listarTransacoesPorLoja();
         return $this->respond($data);
      } catch (Exception $e) {
         return $this->failServerError('Erro ao listar transações por loja.');
      }
   }

   // Upload do arquivo CNAB
   public function upload()
   {

      if(!$this->validacoes->validartoken($this->request->getHeaderLine('token'))){
         return $this->fail('Token inválido, você não tem permissão para importar arquivos.');
      }

      $file = $this->request->getFile('file');

      if (!$file || !$file->isValid() || $file->getExtension() !== 'txt') {
         return $this->fail('Formato de arquivo inválido. Por favor, envie um arquivo .txt.');
      }

      try {
         $resultado = $this->transacaoService->importarArquivo($file);
         return $this->respond($resultado);
      } catch (Exception $e) {
         return $this->failServerError('Erro ao processar o arquivo.');
      }
   }
}
