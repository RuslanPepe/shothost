## demo
http://147.45.115.71

## Screenshots

![screenshot-2026-03-25-17:10:43.png](public/screenshot-2026-03-25-17%3A10%3A43.png)
![screenshot-2026-03-25-17:10:31.png](public/screenshot-2026-03-25-17%3A10%3A31.png)
![screenshot-2026-03-25-17:11:21.png](public/screenshot-2026-03-25-17%3A11%3A21.png)
![screenshot-2026-03-25-17:12:02.png](public/screenshot-2026-03-25-17%3A12%3A02.png)
![screenshot-2026-03-25-17:12:29.png](public/screenshot-2026-03-25-17%3A12%3A29.png)

# HostShot

**HostShot** — это веб-приложение для загрузки и временного хранения изображений с возможностью создания уникальных ссылок для доступа к ним. Проект позволяет загружать несколько фотографий, настраивать срок их хранения, защищать доступ паролем и предоставлять возможность скачивания.

## Возможности (Features)

- **Загрузка изображений** — поддержка множественной загрузки файлов (JPEG, PNG, GIF, SVG)
- **Генерация уникальных ссылок** — каждая загрузка получает UUID или кастомный идентификатор
- **Настройка срока хранения** — от 1 до 365 дней
- **Уровни доступа**:
  - `link` — доступ по ссылке
  - `password` — защита паролем
  - `private` — только для авторизованных пользователей
- **Ограничение по просмотрам** — автоматическое удаление после N просмотров
- **Просмотр в галерее** — карусель изображений с навигацией
- **Скачивание** — отдельных фото или всех сразу в ZIP-архиве
- **Автоматическая очистка** — фоновая задача удаляет устаревшие записи
- **Аутентификация** — регистрация, вход, верификация email

## Технологии (Tech Stack)

### Backend
- **PHP 8.2+** (контейнер использует PHP 8.5)
- **Laravel 12** — фреймворк
- **Laravel Sanctum** — API-аутентификация
- **Laravel Breeze** — аутентификация (register/login)
- **MySQL / SQLite** — база данных
- **Redis** — кэширование (опционально)

### Frontend
- **Blade** — шаблонизатор
- **Bootstrap 5** — CSS-фреймворк
- **Alpine.js** — реактивность
- **Vite** — сборка ассетов

### Инфраструктура
- **Docker** — контейнеризация (nginx, PHP-FPM, MySQL, phpMyAdmin)
- **Pest** — тестирование

## Установка (Installation)

### Клонирование репозитория

```bash
git clone https://github.com/RuslanVeliev-mq/shothost
cd shotHosting
```

### Установка зависимостей

```bash
# Перемещение в _docker
cd _docker

# Сборка docker контейнера
docker-compose up -d
```

### Настройка .env

```bash
# Перемещаемся в контейнер 
docker exec -it app bash

# Скопируйте пример конфигурации
cp .env.example .env

# Сгенерируйте ключ приложения
php artisan key:generate
```

Отредактируйте `.env` при необходимости:

```env
APP_NAME=HostShot
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# или для MySQL:
# DB_CONNECTION=mysql
# DB_HOST=app_db
# DB_PORT=3306
# DB_DATABASE=hostshot
# DB_USERNAME=root
# DB_PASSWORD=secret
```

### Миграции

```bash
# Создание таблиц базы данных
php artisan migrate
```

### Сборка фронтенда (опционально)

```bash
npm run build
```

После запуска приложение будет доступно по адресу:
- **Основное приложение**: http://localhost
- **phpMyAdmin**: http://localhost:8080

## Использование (Usage)

### Для пользователей

1. **Загрузка изображений**:
   - Откройте главную страницу
   - Перетащите файлы в область загрузки или нажмите для выбора
   - Нажмите «⚙» для настройки параметров ссылки
   - Нажмите «Создать ссылку»

2. **Настройки ссылки**:
   - **Lifetime** — срок действия (1–365 дней)
   - **Access** — тип доступа (link/password/private)
   - **Delete after views** — удалить после N просмотров
   - **Access type** — режим доступа (onlyView/all)
   - **Title / Description** — описание для ссылки
   - **custom_link** — кастомный идентификатор вместо UUID
   - **Password** — пароль для доступа (если выбран password)

3. **Просмотр**:
   - Перейдите по ссылке вида `localhost/l/{uuid}`
   - Просматривайте изображения в карусели
   - Скачивайте отдельные фото или все архивом (если разрешено)

### API Endpoints(Частично REST API в процессе)

| Метод | Endpoint | Описание |
|-------|----------|----------|
| `POST` | `/createLink` | Создание ссылки на изображения |
| `GET`  | `/l/{id}` | Просмотр галереи |
| `POST` | `/download/image` | Скачивание одного изображения |
| `POST` | `/download/image/all` | Скачивание всех изображений в ZIP |
| `GET`  | `/photo/{path}` | Получение изображения |
| `GET`  | `/link-password/{id}` | Страница ввода пароля |
| `POST` | `/link-password/check` | Проверка пароля |

### Пример запроса на создание ссылки

```bash
curl -X POST http://localhost/createLink \
  -F "image[]=@photo1.jpg" \
  -F "image[]=@photo2.png" \
  -F "lifetime=7" \
  -F "access=link" \
  -F "typeAccess=onlyView" \
  -F "Title=Мои фото" \
  -H "X-CSRF-TOKEN: <token>"
```

Ответ:

```json
{
  "id": 1,
  "uuid": "550e8400-e29b-41d4-a716-446655440000",
  "paths": [
    {"path": "abc123.jpg", "mimeType": "image/jpeg"}
  ],
  "lifetime": 7,
  "expires_at": "2026-03-30T00:00:00.000000Z"
}
```

## Структура проекта (Project Structure)

```
shotHosting/
├── app/
│   ├── Console/           # Консольные команды и расписание
│   ├── Http/
│   │   ├── Controllers/   # Контроллеры (LinkController, ImageController, etc.)
│   │   ├── Middleware/    # Middleware (CheckPasswordMiddleware)
│   │   ├── Requests/      # Form Request валидация
│   │   └── Resources/     # API Resources
│   ├── Models/            # Eloquent модели (Link, LinkViews, User)
│   ├── Policies/          # Политики авторизации (LinkPolicy)
│   ├── Providers/         # Service Providers
│   └── Services/          # Бизнес-логика (LinkServices, ImageServices, ZipServices)
├── bootstrap/             # Точка входа приложения
├── config/                # Конфигурационные файлы
├── database/
│   ├── factories/         # Фабрики для тестов
│   ├── migrations/        # Миграции БД
│   └── seeders/           # Сидеры
├── public/
│   ├── js/                # Скомпилированные JS-файлы
│   └── style.css          # Стили
├── resources/
│   ├── js/                # Исходные JS-файлы
│   └── views/             # Blade-шаблоны
├── routes/
│   ├── web.php            # Веб-маршруты
│   ├── api.php            # API-маршруты
│   ├── auth.php           # Маршруты аутентификации
│   └── console.php        # Консольные команды
├── storage/               # Файлы (логи, кэш, загруженные изображения)
├── tests/                 # Тесты (Pest)
├── _docker/               # Docker-конфигурация
└── artisan                # CLI Laravel
```

## Конфигурация

### Переменные окружения

| Переменная | Описание | Значение по умолчанию |
|------------|----------|----------------------|
| `APP_NAME` | Название приложения | Laravel |
| `APP_ENV` | Окружение (local/production) | local |
| `APP_DEBUG` | Режим отладки | true |
| `DB_CONNECTION` | Тип БД (sqlite/mysql) | sqlite |
| `SESSION_DRIVER` | Хранение сессий (database/file) | database |
| `CACHE_STORE` | Хранение кэша | database |
| `QUEUE_CONNECTION` | Очереди | database |
| `MAIL_MAILER` | Отправка почты | log |

### Важные настройки

- **Максимальный размер файла**: 200 MB (настраивается в `php.ini`)
- **Срок хранения**: 1–365 дней
- **Поддерживаемые форматы**: jpeg, png, jpg, gif, svg и т.д.

## Архитектура

Проект следует паттерну **MVC** (Model-View-Controller) с выделением бизнес-логики в **Service-классы**:

- **Controllers** — обработка HTTP-запросов
- **Services** — бизнес-логика:
  - `LinkServices` — создание ссылок, проверка пароля
  - `ImageServices` — загрузка и отображение изображений
  - `ZipServices` — создание ZIP-архивов
  - Используются для выноса бизнес-логики из контроллеров, что упрощает тестирование и повторное использование кода.
- **Policies** — проверка прав доступа (например, `LinkPolicy::view`)
- **Requests** — валидация входных данных

### Автоматическая очистка

В `routes/console.php` настроена задача, которая каждые 5 секунд удаляет ссылки, у которых количество просмотров превысило лимит `deleteAfter`:

```php
Schedule::call(function () {
    Link::join('link_views', 'link_views.link_id', '=', 'links.id')
        ->whereColumn('link_views.views', '>', 'links.deleteAfter')
        ->delete();
})->everyFiveSeconds();
```

В `routes/console.php` настроена задача, которая каждый 1 час удаляет, у которых превысило лимит `expires_at`:

```php
Schedule::call(function () {
    Link::where('expires_at', '<', now())->delete();
})->hourly();
```

## Безопасность

- CSRF-защита для всех POST-запросов
- Валидация входных данных через Form Requests
- Ограничение доступа через Policies
- Пароли хранятся в хэшированном виде
- Доступ к файлам контролируется через backend (не прямые ссылки)

## Лицензия

MIT
