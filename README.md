Pequeno sistema construido sobre o frameWok Laravel
Para fins de teste de seleção

Instruções para fazer rodar.

No caso em ambiente Windows usar.

. Um interpletador de PHP que ultilia MySQL -> XAMPP para ultilizar o Laravel
. Na pasta raiz do projeto rodar os sequintes comnado

1 - composer update
2 - npm install
3 - configurar o arquivo .env para colocar o nome do database loguin e senha
4 - rodar o comando 

    php artisan migrate:fresh
    para criar as tabelas no banco de dados

5 - Ao fim das instalações rodar o comando Laravel
    
    php artisan serve

  Esse comando apresenta a URL no localhost
  -> http://127.0.0.1:8000/
  copie e cole no navegador
  A pagina mostrara uma tela que consome a api api-poligonos
  onde se pode cadastrar um Triângulo e um Retângulo e tambem pode se obter
  a soma das areas de todos poligonos cadastrados.
