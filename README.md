## 9. Работа с событиями
Цели практической работы:

Научиться:

— создавать события и вызывать их;
— создавать слушатели и привязывать их к событию;
— применять наблюдатели моделей.

Что нужно сделать:

1. Создайте новый проект Laravel или откройте уже существующий.

2. Создайте новую ветку вашего репозитория от корневой (main или master).

3. Создайте миграцию командой php artisan make:migration CreateNewsTable со следующими полями:

![](sem9.3.png)

4. Создайте модель News.

5. Создайте событие NewsHidden и присвойте полю класса $news параметр $news в конструкторе класса.

![](sem9.5.png)

6. Создайте слушатель NewsHiddenListener, в котором опишите логику слушателя, используя функцию:
   Log::info(‘News ’ . $event->news->id . ‘ hidden’);.

7. Зарегистрируйте событие и слушатель в классе EventServiceProvider.

8. В файле routes/web.php создайте необходимый маршрут ‘/news/create-test’, использующий метод get для создания тестовой новости, и пропишите логику создания тестовой новости.

![](sem9.8.png)

9. В файле routes/web.php создайте необходимый маршрут, использующий метод get ‘/news/{id}/hide’ для скрытия новости. Измените атрибут is_hidden на значение true. После этой операции вызовите событие NewsHidden с помощью инструкции NewsHidden::dispatch($news);.

![](sem9.9.png)

10. В файле storage/logs/laravel.log проверьте, сработал ли слушатель, в нём должна появиться строка ‘News hidden 1’, где 1 — это id скрытой новости (может отличаться).

11. Создайте класс-наблюдатель NewsObserver.

12. Зарегистрируйте его в файле App\Providers\EventServiceProvider в функции boot.

13. Опишите логику изменения поля slug новости при вызове события saving в наблюдателе NewsObserver с помощью инструкции.

![](sem9.13.png)

Эта инструкция использует класс Str, который можно подключить с помощью инструкции в начале файла.

![](sem9.13-1.png)

14. Создайте ещё одну новость с помощью маршрута ‘/news/create-test’.

15. Проверьте заполнение поля slug через базу данных. Оно должно выглядеть следующим образом: «test-news-title» (если вы оставили такое же название, как в примере).

16. Сделайте коммит изменений с помощью Git и отправьте push в репозиторий.



## 8. Сервисы: создание и использование
   Цели практической работы:

Научиться:

— создавать свои сервисы на Laravel;
— работать с логами Laravel и их обработкой.

Что нужно сделать:

В этой практической работе вы разработаете сервис логирования, который:
— фиксирует обращения к сайту;
— собирает их в базе данных с возможностью отключения системы логирования;
— отражает в реальном времени HTTP-запросы к приложению.

Создадим новый проект:

composer create-project laravel/laravel log-service

### 1. Для начала создадим модель логов. Для создания модели необходимо использовать artisan с параметром make:model.
   В итоге наша команда будет выглядеть так:

```php artisan make:model Log```

По умолчанию модель создаётся в ./app/Models/Log.php.
Модель создана, для избежания ошибок запросов SQL необходимо отключить автоматические метки времени.

![](sem8.1.png)

### 2. Теперь опишем миграцию для создания нашей таблицы логов:

```php artisan make:migration create_logs_table```

Напомним, что таблицы миграции создаются по умолчанию в /database/migration/current_date_time_create_logs_table.php.

По умолчанию создаётся файл, содержимое которого выглядит так:

![](sem8.2.png)

В этом файле нам нужно определить поля, которые будет собирать наш сервис логирования:
— time — время события;
— duration — длительность;
— IP — IP-адрес зашедшего пользователя;
— url — адрес, который запросил пользователь;
— method — HTTP-метод (GET, POST);
— input — передаваемые параметры.

В итоге файл должен приобрести такой вид:

![](sem8.2-1.png)

### 3. Миграция создана, параметры описаны. Теперь создадим таблицу.

Напоминаем, что таблица создаётся также через artisan c параметром migrate php artisan migrate.

### 4. База данных подготовлена, теперь нужно создать звено (middleware) для обработки HTTP-запросов. Напоминаем, что звенья создаются при помощи команды php artisan make:middleware название модели.

В нашем случае нам нужна команда:
php artisan make:middleware DataLogger

По умолчанию звено (посредник) создастся по пути ./app/Http/Middleware/DataLogger.php.
Теперь необходимо настроить middleware. Открываем Datalogger.php. Добавим использование созданной модели.

![](sem8.3.png)

Также нужно завершить создание middleware DataLogger, зарегистрировать его в ./app/Http/Kernel.php.

![](sem8.4.png)

### 5. Модель создана, посредник HTTP-запросов настроен и зарегистрирован как класс в Kernel.php. Если сейчас запустить Laravel командой php artisan serv, всё будет работать. Логи будут записываться в базу данных.
   Но увидеть это можно только в самой базе SQL. Для получения более наглядных результатов необходимо создать в web.php эндпоинт.

![](sem8.5.png)

Также для этого эндпоинта необходимо создать blade-шаблон: ./resource/view/logs.blade.php

В нём создать запрос к базе SQL и вывод логов в таблицу.

![](sem8.6.png)
![](sem8.6-1.png)

Запускаем приложение, при открытии вашего приложения http://localhost:8000/logs должна открываться таблица с логами обращения к сайту.



## 7. Формирование ответа (Response)
Цели практической работы:

Научиться:

— использовать класс Laravel Response на практике;
— создавать CRUD REST API на базе фреймворка Laravel;
— передавать данные в формате PDF в ответе экземпляра класса Response.

Что нужно сделать:

В этой практической работе вы будете разрабатывать контроллер, который позволит выводить информацию об одном и обо всех пользователях из базы данных, сохранять данные о новом пользователе в БД, а также создавать PDF с информацией о пользователе.
### 1. Установите новое приложение Laravel и настройте подключение к базе данных. Напомним, что создать новое приложение можно с помощью команды composer:

```composer create-project laravel/laravel crud```

Добавьте необходимые переменные окружения в ENV-файл корневого каталога приложения.

 ![](sem7.1.png)

### 2. Создайте новую модель Eloquent c помощью команды:

```php artisan make:model User -mfsc```

Напомним, что флаг -mfsc создаст модель, наполнитель, контроллер и файл миграции.
После опишите схему базы данных в методе up() файла .app/Http/Models/User.php.

![](sem7.2.png)

После описания схемы таблицы базы данных запустите миграцию.

### 3. Создайте необходимые роуты в файле web.php. Ваше приложение должно содержать минимум четыре эндпоинта:
   — для получения всех пользователей из БД;
   — получения одного пользователя через id, переданный в параметрах роута;
   — записи нового пользователя в базу данных;
   — получения данных о пользователе в виде PDF-файла.

![](sem7.3.png)

### 4. Создайте новый blade-шаблон. В blade-шаблоне создайте форму, которая будет отправлять данные о работнике. Важно, чтобы поля HTML-формы были сопоставимы с полями таблицы базы данных. При отправке запроса экземпляр класса request должен содержать данные об имени, фамилии и адресе электронной почты пользователя.
   Форма blade-шаблона должна содержать CSRF-токен, поля формы должны быть обязательны к заполнению (используйте атрибут required).


### 5. В контроллере UserController.php опишите функцию store, которая будет сохранять данные из вашей HTML-формы. Добавьте валидацию.

![](sem7.5.png)

Дополнительно. Добавьте валидацию на количество символов (максимальное количество символов — 50) для полей Name и Surname. Для почты добавьте валидацию в виде регулярного выражения на соответствие виду example@mail.com.

![](sem7.5-1.png)

### 6. Добавьте соответствующие методы index и get, которые будут возвращать данные обо всех пользователях и об одном пользователе по переданному id. Опционально можете возвращать ответ в формате JSON.

### 7. Чтобы генерировать PDF-документ, вам понадобится DOMPDF-пакет, который является сторонней библиотекой. Для его установки выполните команду:

```composer require barryvdh/laravel-dompdf```

— В файле composer.json добавьте строку с указанным пакетом.
— Запустите команду composer update.
— Добавьте необходимый Service Provider и Facade в файл config/app.php.

![](sem7.7.png)

### 8. Создайте новый контроллер для работы с PDF:

```php artisan make:controller PdfGeneratorController```

### 9. Опишите функцию index, которая будет возвращать новый PDF-файл.

![](sem7.9.png)

### 10. Измените роут Route::get(‘/resume’) таким образом, чтобы он принимал id в виде параметра. Обновите функцию «index» так, чтобы PDF формировался на основе данных из таблицы по переданному id.
