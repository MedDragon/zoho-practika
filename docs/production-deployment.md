Інструкція з розгортання проєкту у production-середовищі
1. Вимоги до апаратного забезпечення
   Архітектура: x86_64 (AMD64)
   Мінімальні системні ресурси:

CPU: 2 ядра (рекомендовано: 4 ядра)

RAM: мінімум 2 ГБ (рекомендовано: 4 ГБ)

Диск: мінімум 5 ГБ вільного простору (рекомендовано SSD)

2. Необхідне програмне забезпечення
   Основне:
   Операційна система: Debian GNU/Linux 12 (bookworm)

Web-сервер: Nginx або Apache

PHP: >= 8.1 з наступними розширеннями:

mbstring

bcmath

curl

fileinfo

pdo

sqlite3 (якщо використовується SQLite)

openssl

dom (для DomPDF)

Composer: для керування залежностями Laravel

Git: для отримання коду з репозиторію

Node.js та npm: для збирання frontend (опційно)

Supervisor: для фонових процесів (якщо потрібно)

Certbot: для HTTPS (опційно)

3. Налаштування мережі
   Відкриті порти:

80 (HTTP)

443 (HTTPS, якщо використовується TLS)

Дозволений вихідний трафік на API Zoho CRM

Опціонально: VPN для безпечного доступу до адміністративної панелі

4. Конфігурація серверів
   Кроки:
   Клонування проєкту:

git clone https://gitlab.com/MedDragon/zoho-practika /var/www/zoho-practika
cd /var/www/zoho-practika
Встановлення залежностей:

composer install --optimize-autoloader --no-dev
Налаштування середовища:

cp .env.example .env
nano .env
Обов’язково заповнити:

APP_KEY (згенерувати за допомогою php artisan key:generate)

APP_URL

Якщо використовується SQLite:

DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database.sqlite
Створення файлу SQLite (якщо потрібно):

touch database/database.sqlite
Налаштування прав доступу:

chown -R www-data:www-data /var/www/zoho-practika
chmod -R 775 storage bootstrap/cache
Налаштування web-сервера (Nginx):

server {
listen 80;
server_name your-domain.com;

    root /var/www/zoho-practika/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
Перезапуск сервісів:

systemctl restart nginx
systemctl restart php8.1-fpm
5. Налаштування СУБД
   SQLite (рекомендовано для простих застосунків):

Вже налаштовано, якщо створено database.sqlite та прописано шлях у .env

MySQL/PostgreSQL (опціонально):

Налаштовується звичайним способом, змінити параметри у .env

6. Розгортання коду
   Після внесення змін:

git pull origin main
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
Якщо змінюється frontend (JS/CSS):

npm install
npm run prod
7. Перевірка працездатності
   Головна сторінка (GET /):

Виводить дамп даних з Zoho CRM.

Якщо немає помилок — бекенд працює.

Тестова форма (GET /btn):

Відкривається HTML-форма з вибором угод.

При натисканні кнопки формується PDF-документ.

Перевірка PDF:

В storage/app/public/invoice.pdf з’являється файл після запиту.

Вкладення з’являється в акаунті Zoho.

Журнали:

Перевірити помилки у логах:

tail -f storage/logs/laravel.log

### Git hooks

1. Встановіть pre-commit:
   ```bash
   pip install pre-commit
   
