Щоб автоматизувати рутинні операції запуску додатку та пов'язаних процесів для production і dev оточення, можна розробити кілька типів скриптів для різних середовищ (наприклад, Bash скрипти для Linux/Mac і Batch скрипти для Windows). Також ми можемо використовувати інструменти на кшталт Foreman для зручного керування процесами.
1. Bash скрипти для Linux/Mac (sh)
1.1. Запуск для development оточення (dev.sh)
Цей скрипт автоматизує запуск додатку для розробки:
#!/bin/bash

# Перевірка наявності залежностей
echo "Перевірка залежностей..."
composer install --no-dev --optimize-autoloader
npm install

# Запуск необхідних процесів
echo "Запуск серверів та процесів для dev оточення..."

# Запуск Laravel сервера
php artisan serve --host=0.0.0.0 --port=8000 &

# Запуск Webpack (якщо використовується для зборки фронтенду)
npm run dev &

# Запуск інструментів для моніторингу або інших сервісів
echo "Запуск моніторингу..."
tail -f storage/logs/laravel.log
1.2. Запуск для production оточення (prod.sh)
Цей скрипт автоматизує запуск для продакшн оточення:
#!/bin/bash

# Перевірка наявності залежностей
echo "Перевірка залежностей..."
composer install --no-dev --optimize-autoloader
npm install --production

# Очищення та кешування конфігурацій
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Запуск сервера у фоновому режимі
echo "Запуск серверу для production..."
sudo systemctl restart nginx
sudo systemctl restart php-fpm

# Перевірка чи сервер працює
curl http://localhost

# Логування доступів
tail -f /var/log/nginx/access.log
2. Batch скрипт для Windows (bat)
2.1. Запуск для development оточення (dev.bat)
Цей скрипт автоматизує запуск у development оточенні для Windows:

@echo off

:: Перевірка наявності залежностей
echo Перевірка залежностей...
composer install --no-dev --optimize-autoloader
npm install

:: Запуск серверу
echo Запуск серверу Laravel...
start php artisan serve --host=0.0.0.0 --port=8000

:: Запуск Webpack (якщо потрібно)
start npm run dev

:: Логування для моніторингу
echo Запуск моніторингу...
tail -f storage/logs/laravel.log
2.2. Запуск для production оточення (prod.bat)
Цей скрипт автоматизує запуск для продакшн оточення на Windows:
@echo off

:: Перевірка наявності залежностей
echo Перевірка залежностей...
composer install --no-dev --optimize-autoloader
npm install --production

:: Очищення та кешування конфігурацій
php artisan config:cache
php artisan route:cache
php artisan view:cache

:: Перезапуск серверів
echo Перезапуск серверу для production...
net stop nginx
net start nginx
net stop php-fpm
net start php-fpm

:: Перевірка працездатності сервера
curl http://localhost

:: Логування доступів
tail -f C:\nginx\logs\access.log
3. Procfile для Foreman
Foreman — це інструмент для запуску багатьох процесів одночасно з одного файлу конфігурації (як правило, для локальної розробки). Він працює за допомогою Procfile, який описує, які сервіси потрібно запускати.
3.1. Procfile (для dev оточення)
web: php artisan serve --host=0.0.0.0 --port=8000
worker: npm run dev
monitor: tail -f storage/logs/laravel.log
3.2. Запуск через Foreman
    • Спочатку потрібно встановити Foreman:
gem install foreman
    • Запустити всі процеси одночасно:
foreman start
4. Загальні рекомендації для запуску
    • Dev оточення:
        1. Використовувати окремі порти для сервера додатку і для фронтенду.
        2. Використовувати Webpack для роботи з фронтендом та оновленнями в реальному часі.
        3. Використовувати моніторинг через tail або інші засоби для відстеження помилок.
    • Prod оточення:
        1. Використовувати продакшн сервери (nginx, php-fpm) з налаштованими конфігураціями.
        2. Проводити кешування конфігурацій для підвищення швидкості.
        3. Зупиняти і перезапускати служби за потреби.
Підсумок:
Ці скрипти дозволяють автоматизувати рутинні операції запуску додатків для різних середовищ, що значно спрощує процес розробки і деплою. Залежно від середовища ви можете адаптувати їх до своїх потреб і додавати додаткові кроки для специфічних процесів.
