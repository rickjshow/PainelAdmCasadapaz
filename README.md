# Clone o projeto
## git clone https://github.com/rickjshow/PainelAdmCasadapaz.git


## Acesse o projeto
### cd seuprojeto


## Instale as dependências e o framework
### composer install --no-scripts

## Para instalar a node modules
### npm install



## Copie o arquivo .env.example
### cp .env.example .env


## Crie uma nova chave para a aplicação
### php artisan key:generate


## Configurar o .env 

### exemplo:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=casadapaz
DB_USERNAME=root
DB_PASSWORD=


## Em seguida você deve configurar o arquivo .env e rodar as migrations com:
### php artisan migrate --seed


## Execute o build do Vite
### npm run build


## Para statar o servidor
### php artisan serve ou se for rodar o painel junto com o site usar o php artisan serve --port=8001


