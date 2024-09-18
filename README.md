# PainelAdmCasadapaz

# Clone o projeto
## git clone https://github.com/Ryan1590/CrudNiveisPessoas.git


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


## Para statar o servidor
### php artisan serve


## Execute o build do Vite
### npm run build


## editar arquivo . env 

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=laravelresetuser@gmail.com
MAIL_PASSWORD=hmbriwjlrjuoprxo
MAIL_ENCRYPTION=ssql
MAIL_FROM_ADDRESS="laravelresetuser@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
