# Agenda de Contatos

Um projetinho simples de agenda de contatos feito em PHP puro com MySQL. A ideia é cadastrar, visualizar, editar e remover contatos, como uma agenda telefônica daquelas antigas, só que rodando no navegador.

## Por que esse projeto existe

Cheguei na parte em que finalmente conectei o PHP com um banco de dados de verdade (MySQL via PDO) e o desafio era aplicar o famoso **CRUD** num projeto que fizesse sentido na prática.

Antes desse projeto, eu já tinha brincado com formulários e variáveis de superglobais do PHP (`$_POST`, `$_GET`, `$_SESSION`), mas tudo ficava na memória, sumia quando a página fechava. Agora os dados realmente são salvos e voltam quando eu abro a aplicação de novo. 

## O que aprendi colocando esse projeto de pé

- **Conexão com banco de dados usando PDO**: criar a conexão, configurar charset, ligar o modo de exceção pra ver os erros direito.
- **CRUD na prática**:
  - **Create** — `INSERT INTO contacts ...` no [config/process.php](config/process.php#L14-L35)
  - **Read** — `SELECT * FROM contacts` listando tudo no [index.php](index.php) e buscando um único contato por id no [show.php](show.php) / [edit.php](edit.php)
  - **Update** — `UPDATE contacts SET ...` no [config/process.php](config/process.php#L36-L61)
  - **Delete** — `DELETE FROM contacts WHERE id = :id` no [config/process.php](config/process.php#L62-L84)
- **Prepared statements com parâmetros nomeados** (`:name`, `:phone`, ...) — entendi por que é importante não concatenar variável direto na query 
- **Padrão Post/Redirect/Get**: depois de salvar algo no banco, redireciono com `header("Location: ...", true, 303)` pra evitar que o F5 reenvie o formulário e duplique contato.
- **Mensagens de feedback usando `$_SESSION`**: o usuário cria um contato, é redirecionado pra home, e vê a mensagem "Contato criado com sucesso!" — depois ela some.
- **Separar credenciais do código versionado**: o `config/database.php` está no `.gitignore` e existe um `config/database.example.php` que serve de modelo.
- **Escapar dados antes de imprimir** (`htmlspecialchars`) pra evitar XSS quando exibo dados que vieram do usuário.

## Como o projeto está organizado

```
17_agenda/
├── config/
│   ├── connection.php          # Cria a conexão PDO com o MySQL
│   ├── database.example.php    # Modelo das credenciais (esse vai pro Git)
│   ├── database.php            # Credenciais reais (esse fica fora do Git)
│   ├── process.php             # Onde toda a lógica de CRUD acontece
│   └── url.php                 # Monta a BASE_URL pra usar nos links
├── templates/
│   ├── header.php              # Cabeçalho com navbar
│   ├── footer.php              # Rodapé
│   └── backbtn.html            # Botão de voltar reutilizável
├── css/styles.css              # Estilos
├── img/logo.png
├── index.php                   # Lista todos os contatos
├── create.php                  # Formulário de novo contato
├── edit.php                    # Formulário de edição
└── show.php                    # Visualização de um contato
```

## Tecnologias usadas

- **PHP 8+** (puro, sem framework — a ideia é entender o que está acontecendo por baixo)
- **MySQL** via **PDO**
- **Bootstrap 5** e **Font Awesome** via CDN pra deixar o visual minimamente agradável
- **XAMPP** no Windows pra rodar localmente

## O que ainda dá pra evoluir

Esse é um projeto de aprendizado, então tem muita coisa que poderia melhorar. Algumas ideias que já anotei pra estudar mais pra frente:

- Adicionar autenticação (login de usuário) pra cada um ter sua própria agenda.
- Validar telefone com máscara no front e formato no back.
- Paginação na listagem quando tiver muitos contatos.
- Refatorar separando em camadas (algo tipo MVC) — hoje a lógica e a view se misturam um pouco.
- Migrar pra um framework (Laravel) quando eu chegar nessa parte do curso.

Mas por enquanto, o foco era fixar o CRUD e a conexão com banco — e isso eu sinto que entendi de verdade depois desse projeto.
