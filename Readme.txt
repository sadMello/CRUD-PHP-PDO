Sistema CRUD de Pessoas com Docker
Este é um projeto simples de um sistema CRUD (Create, Read, Update, Delete) de pessoas, desenvolvido em PHP e MySQL, utilizando Docker para facilitar a configuração do ambiente de desenvolvimento.

Requisitos
Docker
Docker Compose
Instalação e Uso
Clone o repositório para o seu ambiente local.
Navegue até a pasta do projeto.
Construa e inicie os contêineres Docker com o comando:
docker-compose up -d
Acesse a aplicação pelo navegador em http://localhost:8080.
Na página inicial, você pode cadastrar uma nova pessoa preenchendo o formulário e clicando em "Cadastrar".
A lista de pessoas cadastradas será exibida na parte direita da página.
Para editar uma pessoa, clique no link "Editar" ao lado do registro desejado.
Para excluir uma pessoa, clique no link "Excluir" ao lado do registro desejado.
Para parar os contêineres, execute o comando:

docker-compose down