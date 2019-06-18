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

Basicamente, toda vez que uma request é executada, a URI da request será processada e mapeada dentro do sistema para um Controller->View. Por exemplo, veja a seguintes url:
> http://simple-mvc.php.com/Aluno/Lista 
Essa url, é composta por dois elementes:
 * Server Address: http://simple-mvc.php.com
 * URI: /Aluno/Lista
De acordo com a URI, o sistema irá invocar uma action em uma determinada controller. No caso acima, o sistema irá tentar executar o método `lista()` em um controller chamado `AlunoController`
 
 
