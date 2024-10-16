## API para upload de arquivo e consulta de dados com persistência em banco

## Requisitos
- PHP 8
- Composer
- Mysql

## Instalação
```sh
#-- Clonar repositório --#
git clone https://github.com/Vitinh021/desafio-dev.git

#-- Gerar imagem Docker --#
docker compose build

#-- Subir imagem Docker --#
docker compose up -d

#-- Acessar conteiner para configurações  --#
docker exec -it <id_imagem> bash  ("Docker ps" para encontrar o <id_imagem>)

#-- Instalar depências --# 
composer install

#-- Criar pasta de cache para ser permitido rodar as migrations --# 
Caminho: \desafio-dev\app\writable -> criar pasta "cache"

#-- Migrations - banco de dados --# 
php spark migrate --all

```

## Acessar endpoints da API
[GET] [http://localhost:8080/public/listar](http://localhost:8080/public/listar)
[GET] [http://localhost:8080/public/listarLojas](http://localhost:8080/public/listarLojas)
[POST] [http://localhost:8080/public/upload](http://localhost:8080/public/upload)
- Anexar o arquivo.txt na aba de body:form-data
- Anexar na aba Headers uma "key=token e Value=123"
- Foi utilizado o Postman para tratar as requisições

