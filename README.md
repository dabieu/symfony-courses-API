# API Rest de cursos online com Symfony

  

Esse projeto foi desenvolvido como um desafio para a empresa **match mt**.

  

## 🚀 Começando

  

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

  

### 📋 Pré-requisitos

  
  

  

* [GIT](https://git-scm.com/downloads)

* [Docker](https://www.docker.com/)

  

### 🔧 Instalação

  

Primeiro faça um clone desse repositório em seu ambiente local.

  

  

```

git clone https://github.com/dabieu/symfony-courses-API.git

```

  

Após clonar o repositório, entre na pasta do projeto e no seu terminal insira o comando:

  

```

docker-compose up

```

Agora precisamos instalar as dependências do projeto:

  

```

docker-compose exec php composer install

```

Agora iremos criar nossa base de dados:

  

```

docker-compose exec php bin/console doctrine:database:create

```
Executar as migrations criando a estrutura do banco:
```

docker-compose exec php bin/console doctrine:migrations:migrate

```
Gerar chaves de acesso JWT:
```

docker-compose exec php bin/console lexik:jwt:generate-keypair

```

Nesse ponto, precisaremos inserir um registro no banco de dados com informações de usuário para autenticação via JWT. Para isso acesse o phpmyadmin através da url **localhost:8080**.

Utilize o arquivo *insert_user.sql* disponível na pasta do projeto para realizar um insert na tabela *user*

  ### Pronto!
  Agora a API deve estar devidamente configurada e pronta para uso. A documentação da API se encontra disponível em: [Documentação API](https://documenter.getpostman.com/view/18024596/UVeFMRrW)



  

## 🛠️ Construído com

  

* [Symfony](https://symfony.com/) - O framework PHP utilizado

* [MySQL](https://www.mysql.com/) - Banco de dados

* [Composer](https://getcomposer.org/) - Gerente de Dependência

* [Apache](https://www.apache.org/) - Servidor

  

## ✒️ Autores

  

* **Daniel Cardoso** - *Desenvolvimento completo* - [dabieu](https://github.com/dabieu)

  

## 🎁 Expressões de gratidão

  

* Gostaria de agradecer ao pessoal da match mt pela oportunidade de participar deste processo seletivo.

  

---