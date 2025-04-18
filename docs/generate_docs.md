Інструкція з генерації документації
Ця інструкція описує, як автоматично згенерувати документацію для вашого проєкту за допомогою інструменту Scribe.

Крок 1: Встановлення Scribe
Для початку необхідно встановити пакет Scribe через Composer:

composer require scribe/laravel
Крок 2: Публікація конфігурації
Після встановлення необхідно опублікувати конфігураційний файл Scribe:

php artisan vendor:publish --provider="Knuckles\Scribe\ScribeServiceProvider" --tag="scribe-config"
Ця команда створить файл конфігурації config/scribe.php, де можна налаштувати різні опції генерації документації.

Крок 3: Налаштування конфігурації
Відредагуйте файл config/scribe.php для налаштування генерації документації відповідно до ваших вимог. Зокрема:

base_url: Встановіть базову URL-адресу вашого API.

auth: Якщо ваш API потребує аутентифікації, налаштуйте її.

Приклад налаштування аутентифікації в config/scribe.php:

'auth' => [
'enabled' => true,  // Включає аутентифікацію
'default' => false,  // Чи є аутентифікація за замовчуванням
'in' => \Knuckles\Scribe\Config\AuthIn::BEARER->value,  // Тип аутентифікації (Bearer token)
'name' => 'Authorization',  // Назва заголовка для аутентифікації
'use_value' => env('SCRIBE_AUTH_KEY'),  // Використовує значення з .env
'placeholder' => '{YOUR_AUTH_KEY}',  // Placeholder для генерації документації
'extra_info' => 'You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.',
],
У цьому випадку Scribe буде очікувати токен у заголовку Authorization з типом Bearer.

Створення токену для аутентифікації (якщо ще не створено):
Якщо ви використовуєте Laravel Sanctum, ось як можна створити токен для користувача:

$user = User::find(1);
$token = $user->createToken('YourAppName')->plainTextToken;
Цей токен можна використовувати для аутентифікації через заголовок Authorization:

Authorization: Bearer {YOUR_AUTH_KEY}
Крок 4: Налаштування документування ендпоінтів
У конфігурації config/scribe.php є секція для визначення маршруту, які слід включити або виключити з документації. Ви можете налаштувати маршрути, які потрібно документувати.

Приклад налаштування:

'routes' => [
[
'match' => [
'prefixes' => ['api/*'],  // Включає всі маршрути з префіксом "api"
'domains' => ['*'],       // Включає всі домени
],
'include' => [
'users.index', 'POST /new', '/auth/*'  // Включає ці маршрути в документацію
],
],
],
Крок 5: Генерація документації
Після налаштування конфігурації і аутентифікації виконайте команду для генерації документації:

php artisan scribe:generate
Це створить HTML-сторінку документації, яку можна переглядати за адресою, вказаною у конфігурації (/docs).

Крок 6: Перегляд документації
Після генерації документації ви можете переглянути її за наступною адресою:

http://127.0.0.1:8000/docs
У документації будуть вказані всі ендпоінти вашого API з прикладами запитів і відповідей.

Крок 7: Додавання аутентифікації в документацію
Якщо ваші ендпоінти потребують аутентифікації, вони будуть позначені як "requires authentication" у документації. Ви також можете додати приклади запитів, що містять заголовок Authorization, для кожного захищеного ендпоінта.

Приклад документації для аутентифікації:

GET /api/user

Example request:
curl --request GET \
--get "http://127.0.0.1:8000/api/user" \
--header "Content-Type: application/json" \
--header "Accept: application/json" \
--header "Authorization: Bearer {YOUR_AUTH_KEY}"

Example response (401):
{
"message": "Unauthenticated."
}
