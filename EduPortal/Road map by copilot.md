# AI Portal RoadMap

## 1. Прототип на PHP+SQLite+Python
- [x] Настроить XAMPP, создать index.php и generate.php
- [x] Подключить SQLite, сделать init_db.php
- [x] Интегрировать Python-скрипты (ai_integration.py + scraper_bot.py)
- [x] Снять ограничения времени выполнения в XAMPP

## 2. Рефакторинг структуры (MVP)
- [x] Создать папки: public/, src/, scripts/
- [x] Вынести config.php, применить PDO для SQLite
- [x] Переписать index.php → Blade-шаблоны (Laravel)

## 3. Laravel + MoonShine (админка)
- [x] Установить Laravel, настроить .env для SQLite
- [x] Установить MoonShine, проверить /admin
- [x] Скопировать scripts/ внутрь корня проекта
- [x] Создать модель Article, миграцию с полями: user_id, topic, type, content, is_published
- [x] Сгенерировать MoonShine Resource, добавить Action «Генерировать через ИИ»

## 4. Пользовательская часть (Laravel Breeze)
- [x] Установить Laravel Breeze (blade)
- [x] Запустить npm install; npm run dev
- [x] Протестировать регистрацию (/register) и вход (/login)

## 5. Генерация от имени пользователя
- [x] Создать ArticleController с методами create, generate, show
- [x] Добавить маршруты для create, generate, show
- [x] Сделать Blade-шаблоны articles/create.blade.php и articles/show.blade.php
- [x] Отключить тайм-аут PHP (set_time_limit)

## 6. Список «Мои статьи» 
- [x] Добавить маршрут /articles
- [x] Реализовать метод index() в ArticleController
- [x] Создать Blade-шаблон articles/index.blade.php
- [x] Добавить ссылку в меню навигации

## 7. Публикация и общий каталог
- [x] Реализовать флаг is_published
- [x] Сделать публичный маршрут /catalog
- [x] Создать фильтры, категории, поиск


## 8. Мобильная адаптация интерфейса
- [ ] Адаптировать шаблоны (`app-layout`, `articles/*`) под все экраны
- [ ] Проверить навигацию, карты, карточки статей на мобильных
- [ ] Минимизировать горизонтальный скролл и кнопки

## 9. Оптимизация генерации текста
- [ ] Ввести выбор длины статьи в форме (параметр `length`)
- [ ] Ограничить `length` в зависимости от роли (`user`/`admin`/`super_user`)
- [ ] Передавать `length` в Python-скрипт и обрабатывать его

## 10. Роли и права
- [ ] Добавить роль `super_user` (уровень выше `admin`)
- [ ] Разграничить возможности: 
   - `user` — базовая генерация до N символов  
   - `admin` — до M символов + доступ к статистике  
   - `super_user` — без ограничений + управление ролями



## 11. Профиль пользователя и статистика
- [ ] Страница профиля (/profile)
- [ ] Счётчики статей, лайков, просмотров

## 12. AI Job Queue
- [ ] Перенести генерацию в Laravel Job
- [ ] Добавить очередь Redis/Database
- [ ] Реализовать уведомление о готовности

## 13. Микросервис генерации
- [ ] Обернуть ai_integration.py в FastAPI
- [ ] Поднять сервис на отдельном порту
- [ ] Вызов через Http::post вместо shell_exec

## 14. Telegram-бот, лайки, комментарии
- [ ] Создать Telegram-бот для публикации
- [ ] Таблицы likes, comments
- [ ] Защита от спама и rate-limit

## 15. Монетизация
- [ ] Подписка, токены, платный доступ
- [ ] Платёжные шлюзы, вебхуки

---
