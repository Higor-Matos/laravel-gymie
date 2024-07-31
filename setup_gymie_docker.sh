#! /bin/bash

# Define environment variables
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=gymie
DB_USERNAME=gymie
DB_PASSWORD=password

# Define project path
PROJECT_PATH=$(pwd)

# Set permissions for the local project directory
echo "Configurando permissões para o diretório do projeto..."
sudo chmod -R 777 $PROJECT_PATH

# Stop and remove containers, networks, and volumes
echo "Parando e removendo contêineres, redes e volumes existentes..."
docker-compose down -v

# Build and start Docker containers
echo "Construindo e iniciando contêineres Docker..."
docker-compose up --build -d

# Wait for MySQL to be ready
echo "Aguardando o MySQL ficar pronto..."
MYSQL_READY=false
for i in {1..30}; do
    if docker-compose exec mysql mysqladmin ping -h"$DB_HOST" --silent; then
        MYSQL_READY=true
        break
    fi
    echo "MySQL não está disponível - aguardando ($i/30)"
    sleep 5
done

if [ "$MYSQL_READY" = false ]; then
    echo "O MySQL falhou ao iniciar."
    docker-compose logs mysql
    exit 1
fi

# Create necessary directories and set permissions
echo "Criando diretórios necessários e configurando permissões..."
docker-compose exec app sh -c "mkdir -p /var/www/vendor && chown -R www-data:www-data /var/www/vendor"
docker-compose exec app sh -c "mkdir -p /var/www/storage && chown -R www-data:www-data /var/www/storage"
docker-compose exec app sh -c "mkdir -p /var/www/bootstrap/cache && chown -R www-data:www-data /var/www/bootstrap/cache"
docker-compose exec app sh -c "mkdir -p /var/www/html && chown -R www-data:www-data /var/www/html"

# Install composer dependencies
echo "Instalando dependências do composer..."
docker-compose exec app composer install

# Copy .env.example to .env
echo "Copiando .env.example para .env..."
cp .env.example .env

# Update .env with database details
echo "Atualizando .env com detalhes do banco de dados..."
sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" .env
sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

# Generate application key
echo "Gerando chave da aplicação..."
docker-compose exec app php artisan key:generate

# Run migrations and seed the database
echo "Executando migrações e populando o banco de dados..."
docker-compose exec app php artisan migrate --seed

# Set permissions for storage and cache inside container
echo "Configurando permissões para storage e cache dentro do contêiner..."
docker-compose exec app sh -c "chown -R www-data:www-data storage bootstrap/cache && chmod -R ug+rwx storage bootstrap/cache"

# Modify php-fpm listen directive
echo "Modificando diretiva listen do PHP-FPM..."
docker-compose exec app sh -c "sed -i 's/listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf"

# Restart php-fpm to apply changes
echo "Reiniciando PHP-FPM para aplicar alterações..."
docker-compose exec app sh -c "pkill -o -USR2 php-fpm"

# Create test PHP file
echo "Criando arquivo PHP de teste..."
docker-compose exec app sh -c "echo '<?php phpinfo(); ?>' > /var/www/html/test.php"

# Add cron job for scheduled tasks
echo "Adicionando cron job para tarefas agendadas..."
(crontab -l 2>/dev/null; echo "* * * * * cd $PROJECT_PATH && docker-compose exec app php artisan schedule:run >> /dev/null 2>&1") | crontab -

# Create robots.txt file
echo "Criando arquivo robots.txt..."
docker-compose exec app sh -c "echo -e 'User-agent: *\nDisallow: /admin/\nDisallow: /login/' > /var/www/public/robots.txt"

echo "Configuração do Laravel Gymie completa. Use as seguintes credenciais para fazer login:"
echo "Email: admin@gymie.in"
echo "Senha: password"
