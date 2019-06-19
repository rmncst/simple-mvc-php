# SIMPLE MVC PHP
Esse projeto foi realizado com o objetivo de explicitar a teoria e aplicação do MVC ( MODEL VIEW CONTROLLER ) para aprendizes no nível inicial. 
Sendo assim, o mesmo foi construído de maneiro simplista e rudimentar, não levando em considerações recursos essenciais do php como o composer e todo a grande gama de opções de pacotes existentes em toda comunidade php
Sendo assim, reforço aqui, esse projeto não é indicado para ser aplicado em ambientes de produção ou projetos reais, somente para fins acadêmicos

## ESTRUTURA DO FRAMEWORK
Esse framework está organizado da seguinte maneira:
* conf  
  * settings.json
  * menu.json
* core  
* public  
* src
  * Controller
  * Data
  * Model
  * View
  
Os diretórios `core` e `public` contém arquivos com lógicas necessárias para o framework funcionar, logo não será necessário os alunos se preocuparem com os mesmos por enquanto. 
O que deve ser observado são os diretórios `conf` e o diretório `src` para o desenvolvimento da sua aplicação.

### CONF
Esse diretório contém arquivos necessários para a configuração dos parâmetros da aplicação. A seguir a descrição dos mesmos:
 * `menu.json` - Esse arquivo é utilizado para a configuração do menu da aplicação, assim como o link e os ícones do mesmo. A seguinr um exemplo de configuração de menu:
 ```javascript
 {
  "menu": [ // Todo o conteúdo da configuração deverá vir dentro dessa chave
    {
      "label": "Home", // Nome que irá ser exibido na tela do sistema
      "icon": "fas fa-fw fa-tachometer-alt", // ícone que será exibido no meno basedo no font-awesome. Procurar os ícones disponíveis [clincando aqui](https://fontawesome.com/icons)
      "link": "/Home/Index", // Link que será disparado quando for clicado
      "children": null // Sub menus contendo a mesma estrutura que esta qe estou explicando. Lembrando que so poderá haver 1 nível do submenu
    },
    {
      "label": "Cadastros",
      "icon": "fas fa-fw fa-tachometer-alt",
      "link": null,
      "children": [
        {
          "label": "Alunos",
          "icon": null,
          "link": "/Aluno/Index"
        }
      ]
    },
    {
      "label": "Sair",
      "icon": "fas fa-fw fa-chart-area",
      "link": "/Home/Sair",
      "children": null
    }
  ]
}
 ```
 * `settings.json` - Nessa arquivo, você poderá configurar sua conexão com o banco de dados. Veja um exmplo de configuração:
 ```javascript
 {
    "database" : {
        "default" : {
            "host" : "127.0.0.1", // Endereço do servidor de banco de dados 
            "port" : "3306", // Porta do Serviço de banco de dados
            "user" : "root", // usuário de acesso ao banco de dados
            "password" : "p@ssw0rd", // senha de acesso ao banco de dados
            "dbname" : "media", // nome do banco de dados
            "driver" : "mysql" // driver de acesso ( não alterar a não ser que deseje trabalhar com outro SGBD )
        }
    } , ...
}
```

## MVC
Model View Controller é um padrão de projetos que visa a sepração de conceitos e a comunicação entre os componentes de um sistema via a denpendência das interfaces de comunicação entre os Mesmos.

Sendo assim, cabe ao **Controller (e action)** intepretar uma requisição, selecionar o modelo e view adequado de dados preenchê-las. Ao **Modelo**, cabe a responsabilidade de representar um conjunto lógico de dados que pode ser utilizado para aplica regras de negócio, salvar dados em um banco e servir de interface de comunicação para a controller e view. E a **View**, cabe a responsabilidade de apresentar dados no dispositivo de saída ( monitor ) através de um modelo que deverá ser preenchido e entrega a ela. 

### Controller e Action
Os Controllers serão os responsáveis por mapeas as requisições em funcionalidades específicas, por isso, são os primeiros agentes que atuam toda vez que uma requisição ocorre. Todos os controllers devem estar dentro do diretório `src\Controller` e devem ter o sufixo `Controller.php` sem excessão. 

Basicamente, toda vez que uma request é executada, a URI da request será processada e mapeada dentro do sistema para um Controller->Action. Por exemplo, veja a seguintes url:
> http://simple-mvc.php.com/Aluno/Lista 
Essa url, é composta por dois elementes:
 * Server Address: http://simple-mvc.php.com
 * URI: /Aluno/Lista
De acordo com a URI, o sistema irá invocar uma action em uma determinada controller. No caso acima, o sistema irá tentar executar o método `lista()` em um controller chamado `AlunoController`. Sendo assim, deverá haver o controller `src\Controller\AlunoController.php` e dentro do conteúdo do mesmo, deve haver a seguinte função:
```php
<?php
namespace Application\Controller;

class AlunoController {
    public function lista() {        
        return view('view/lista');
    }
    // ....   
}
```
Caso seja necessário obter algum parâmetro via segmento de url, pode-se declarar declarar os parâmetros na action, e de forma posicional, eles serão vinculados através da url. Segue um exemplo a seguinr:

> https://myapp.com/Home/Hello/Ramon/Tarde
```php
<?php
namespace Application\Controller;

class HomeController {
    public function hello($name, $period) {        
        $message = "Olá {$name}, tenha um bom(a) {$period}";
        return view('view/lista', ['message' => $message]);
    }
    // ....   
}
```
Saída esperada:
> Olá **Ramon** , tenha um bom(a) **tarde**

### MODEL

O Model é um objeto que representa um papel importantíssimo dentro do contexto do MVC, e deve ser entido como uma interface de comunicação entre um `Controller` e uma `View`, e deve ser entendido como um objeto que agrupa todas as informação referente a algo de maneiro lógica. 
Por exemplo, suponhamos que exista o objeto `MusicModel`, representado a seguir
```php
<?php
namespace Application\Model\Music;

class Music {
    public $id;
    public $name;
    public $artist;
    public $duration;
    public $link;
    public $allMusics = [];   
}
```
Esse objeto contém todas as informações necessárias para representar uma Música dentro do contexto do sistema, e um array que poderá conter vários registros de uma mesma música.
Sendo assin, considere a action a seguir:
```php
<?php
namespace Application\Controller;
use Application\Model\Music\Music;

class MusicController {
    public function index() {        
        $musicData = new MusicData();
        $model = new Music();
        $model->allMusics = $musicData->query();
        return view('music/index',$model);
    }
    
    public function edit($id) {
        $model = new Music();
        $data = (new MusicData())->find('id = '.$id);
        $model->id = $data['id'];
        $model->name = $data['name'];
        $model->duration = $data['duration'];
        $model->link = $data['link'];

        return view('music/form', $model);
    }

}
```
A action index, é responsável por listar todas as músicas cadastradas no sistema. Por isso, utilizamos a modelo `MusicModel` para receber todas as músicas e enviá-las para a `View`. Já a action edit, é responsável por fornecer ao usuário dados de uma música para que o mesmo possa alterá-la. Para isso buscamos no banco, preenchemos nosso `MusicModel` e enviamos para a view.
Assim, temos um modelo que pode servir de ponte de comunicação em todas as situações com nossas views.

### VIEW
As views, como dito anteriormente, tem a responsabilidade de apresentar as informações aos seus usuários através do dispositivo de saída. Todas as views devem estar dentro do diretório `src/View` obrigatoriamente e devem conter a extensão `.view.php`

As views contém html, e todo o conteúdo php necessário para a exibição dos dados dinâmico. Por padrão, toda view tem o objeto `$model`, que conterá os dados que o controller retornar ( ver na seção anterior ).  Sendo assim, veja o código da view `('music\index')` a seguir:

```php
<?php if(!($model instanceof \Application\Model\Music\Music)) { throw new Exception('Error'); } ?>

<div class="row">
    <div class="col-md-10">
        <h3>Gerênciar Músicas</h3>
    </div>
    <div class="col-md-2">
        <a class="btn btn-primary btn-xs" href="/Music/Form">
            Nova Musica
        </a>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>Musica</th>
                    <th>Duração</th>
                    <th>Link</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->allMusics as $music) {  ?>
                    <tr>
                        <td><?= $music['name'] ?></td>
                        <td><?= $music['duration'] ?></td>
                        <td><?= $music['link'] ?></td>
                        <td>
                            <a href="/Music/Edit/<?= $music['id'] ?>">Edit</a>
                            <a  href="/Music/Delete/<?= $music['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
```
É importante que todas as classes Data, sejam criadas dentro do diretório `src\Model` 
 
 ### DATA
 
Para facilitar acesso ao banco de dados, existe uma forma mais simples de construirmos nosso persistência de dados. É através da classe
`TableGateway`. Com ela, você precisa ter configurado a conexão com o banco de dados no arquivo `conf/settings.json` e setar o nome da tabela n banco de dados que deseja manipular. A seguir, um exemplo da tabela `music`: 

```php
<?php
namespace Application\Data;
use Core\TableGateway;

class MusicData extends TableGateway
{
    public function __construct()
    {
        parent::__construct('music');
    }
}

```
Observe que foi necessário criar uma classe, no caso MusicData, extender da Cassse `Core\TableGateway` e setar o nome da tabela no construtor da classe ` parent::__construct('music');`. Feito isso, uma vez que todos os parâmetros estejam corretos, basta você instanciar a classe e pronto, terá acesso a todas as funçoes de banco básicas referente aquela tabela:
  * Buscar Todos -> `$musicData->queryAll()`
  * Buscar por Id -> `$musicData->find('id = '.$id)`
  * Inserir -> `$musicData->insert(['nome' => 'Take on me' , 'duration' => 123]);`
  * Alterar -> `$musicData->insert(['nome' => 'Take on me' , 'duration' => 123] , 'id = ' . $fields['id']);`
  * Excluir -> `$musicData->delete('id = '.$id);`
É importante que todas as classes Data, sejam criadas dentro do diretório `src\Data` 
