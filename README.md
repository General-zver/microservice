# microservice

# установка проекта
# 1. Необхидмые интсрументы:
php 8.1^  (желательно 8.2)
наличие композера
# 2. Развертывание
установить laravel: composer i
настроить файл .env (переименовать .env.example)
подготовить базу данных и добавить в .env парметры пользователя и пароль
поднять сервер люимым способом
запустить миграции: php artisan migrate
запустить пошагово сидеры
php artisan db:seed --class=UsersSeeder | будет создано 2 тестовых пользователя
[first_user@example.com | password] [second_user@example.com | password2]
php artisan db:seed --class=DefaultProductSeeder | будет создано 10 тестовых продуктов
приступить к тестированию.
# 3. Запросы
# 3.1 Авторизация
   путь (POST)[адрес проекты]/api/connect
       данные email [любого из юзеров] password [выбранного юзера]
   ожидаемый ответ:
       [
           "success": true,
           "token": <какой то сгенерированный токен>
       ]
# 3.2 Получение всех продуктов (для всех запросов кроме авторизации нужен Autorization header с Bearer Token иначе 403)
   путь (GET)[адрес проекты]/api/products
   ожидаемый ответ:
       [
           "products": [какой то массив с продуктами]
       ]
   фильтрация по полям ['category','availability']
   к пути описанному выше добавляется параметр
   filter[filter_field] = '<field>', filter[filter_field_value] = '<field value>'
   ожидаемый ответ:
       [
           "products": [какой то массив с продуктами остортированный по заданному полю]
       ]
   сортировка  
   к пути описанному выше добавляется параметр
   sort = '<field>', direction = '<asc or desc>'  

# 3.3 Создание продукта
   путь (put)[адрес проекты]/api/products/create
       ожидаемые данные:
       'product_name','price','category','qty','availability'
   ожидаемый ответ:
       [
           'result' => 'success',
           'message'=> "Product <product_name> successfully created!"       
       ]
# 3.4 обновление продукта
   путь (patch)[адрес проекты]/api/products/{id продукта}/update
        ожидаемые данные:      
           те же, что и при создании либо никакие
   ожидаемый ответ:
       [
           'result' => 'success',
           'message'=> "Product <product_name> successfully updated!"
       ]
# 3.5 удаление продукта
   путь (patch)[адрес проекты]/api/products/{id продукта}/delete
   ожидаемый ответ:
       [
          'result' => 'success',
           'message' => 'Product successfully deleted!',
       ]
# *********************************************************************************
# 
