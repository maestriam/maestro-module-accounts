<p align="center">
    <img width="256" src="Resources/assets/imgs/accounts.png" alt="maestriam/samurai logo">
</p>

<h1 align="center">🔑 maestro/accounts</h1>

<p align="center">
  Gerencie identidades e autenticação de contas dentro do sistema. 
</p>

<br/>

# Conteúdo
- [Introdução](#intro)
- [Uso básico](#basic)
  - [Tipos de contas](#types)
    - [Criando novo tipo](#creating-type)
    - [Consultando tipos](#consulting-types)
- [Estrutura do módulo](#strucure)

<br/>

## <a id="intro"></a> Introdução
Módulo responsável de criar e gerenciar contas e garantir a identidade para as entidades dentro do sistema.  <br/>
Com ele, cada entidade vinculada ao módulo possui uma conta única que pode servir como autenticação ou não.  

<br/>

## <a id="basic"></a> Uso básico
### <a id="types"></a> Tipos de contas

#### <a id="creating-type"></a> Criando novo tipo

Cria um novo tipo de conta indicando seu nome e se as contas vinculadas a ele serão autenticadas ou não.
Por padrão todas as contas não serão autenticadas.
```php

$typeName = 'App/Models/User'

$isAuthenticable = true;

Accounts::type()->create($typeName, $isAuthenticable); // Retorna Type
```

Cria um novo tipo de conta dado um objeto. O nome do tipo será o nome da classe do objeto.  
```php
$user = new User();

Accounts::type()->create($user, true); // Retorna Type
```

#### <a id="consulting-types"></a> Consultando tipos

Retornar todos os tipos de contas.
```php
Accounts::type()->all(); // Retorna Collection
```

Pesquisa um tipo de conta por Id
```php
Accounts::type()->find(1); // Retorna Type
```
  
Pesquisa um tipo de conta por nome
```php
Accounts::type()->find('App/User'); // Retorna Type
```

Pesquisa um tipo de conta por um objeto
```php
$user = new User();

Accounts::type()->find($user); // Retorna Collection
```

Tenta encontrar um tipo de conta. Caso não encontre ele deverá ser criado.
```php
Accounts::type()->findOrCreate('App/Models/User'); // Retorna Type
```

Verifica se um tipo de conta existe cadastrados.
```php
Accounts::type()->isExists('App/Models/User'); // Retorna Collection
```

Faz o relacionamento entre dois objetos com trait HasAccount.  
Os objetos já precisam ter duas contas criadas previamente.  
```php
Accounts::account()->relate($childObjectWithAccount, $parentObjectWithAccount);
```

Retorna uma factory de tipos de conta
```php
Accounts::type()->factory(); // Retorna Type
```
<br/>

### <a id="accounts"></a> Contas

#### <a id="creating-account"></a> Criando nova conta

<br/>

### <a id="strucure"></a> Estrutura do módulo
A esturura de diretórios do módulo está organizado na seguinte forma:


```
.
|_ Database                 // Estrutura relacionada à banco de dados
|  |_ Factories             // Criação de mocks para testes em bancos       
|  |_ Migrations            // Criação das tabelas no banco de dados         
|  |_ Models                // Modelagem das entidades das tabelas no banco de dados     
|  |_ Seeders               // Inserção de registros no banco de dados
|_ Exceptions               // Arquivos de disparo de erros   
|_ Entities                 // Classes de ligação entre serviços do módulo e as entradas da aplicação  
|_ Http                     // Estrutura relacionada à entradas via Http
|  |_ Controllers           // Classes de controllers       
|  |_ Middleware            // Funcionalidades que devem ser executads entre a requisição e o controller
|  |_ Requests              // Validação de requisições Http     
|  |_ Routes                // Arquivos de configuração de rotas   
|_ Resources                // Estrutura relacionada à arquivos HTML e seus complementares 
|  |_ assets                // Arquivos JS, CSS ou imagens   
|  |_ config                // Arquivos de configurações do módulo
|  |_ lang                  // Arquivos de mensagens e suas traduções
|  |_ views                 // Arquivos de view Blade   
|  |_ docs                  // Arquivos de documentação markdown (.md)   
|_ Services                 // Estrutura relacionada à execução de serviços, rotinas e funcionalidades do módulo  
|  |_ Providers             // Classes que disponibiliza e iniciaa o módulo para a aplicação Laravel
|  |_ Fundamentals          // Classes com serviços de funcionalidades básicas do módulo (eg: CRUD)     
|_ Support                  // Estrutura relacionada à fornecimento de serviços a módulos terceiros 
|  |_ Facade                // Classe de faixada para disponibilizar serviços para outros módulos     
|  |_ Concerns              // Funcionalidades que são atribuidas em outras classes     
|  |_ Helpers               // Funções avulsas que podem ser chamadas globalmente     
|_ Tests                    // Estrutura de testes do módulo
```