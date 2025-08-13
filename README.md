# microservice

# установка проекта
# 1. Необхидмые интсрументы:
<p>php 8.1^  (желательно 8.2)</p>
<p>наличие композера</p>
# 2. Развертывание </br>
установить laravel: composer i</br>
настроить файл .env (переименовать .env.example)</br>
подготовить базу данных и добавить в .env парметры пользователя и пароль</br>
поднять сервер люимым способом</br>
запустить миграции: php artisan migrate</br>
запустить пошагово сидеры</br>
php artisan db:seed --class=UsersSeeder | будет создано 2 тестовых пользователя</br>
[first_user@example.com | password] [second_user@example.com | password2]</br>
php artisan db:seed --class=DefaultProductSeeder | будет создано 10 тестовых продуктов</br>
приступить к тестированию.</br>
# 3. Запросы

# 3.1 Авторизация
   &emsp;путь (POST)[адрес проекты]/api/connect</br>
       &emsp;&emsp;данные email [любого из юзеров] password [выбранного юзера]</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
           &emsp;&emsp;"success": true,</br>
           &emsp;&emsp;"token": <какой то сгенерированный токен></br>
       &emsp;]</br>
# 3.2 Получение всех продуктов (для всех запросов кроме авторизации нужен Autorization header с Bearer Token иначе 403)
   &emsp;путь (GET)[адрес проекты]/api/products</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
           &emsp;&emsp;"products": [какой то массив с продуктами]</br>
       &emsp;]</br>
   &emsp;фильтрация по полям ['category','availability']</br>
   &emsp;к пути описанному выше добавляется параметр</br>
   &emsp;filter[filter_field] = '<field>', filter[filter_field_value] = '<field value>'</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
           &emsp;&emsp;"products": [какой то массив с продуктами остортированный по заданному полю]</br>
       &emsp;]</br>
   &emsp;сортировка  </br>
   &emsp;к пути описанному выше добавляется параметр</br>
   &emsp;sort = '<field>', direction = '<asc or desc>'  </br>

# 3.3 Создание продукта
   &emsp;путь (put)[адрес проекты]/api/products/create</br>
       &emsp;ожидаемые данные:</br>
       &emsp;'product_name','price','category','qty','availability'</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
           &emsp;&emsp;'result' => 'success',</br>
          &emsp; &emsp;'message'=> "Product <product_name> successfully created!"</br>
       &emsp;]</br>
# 3.4 обновление продукта
   &emsp;путь (patch)[адрес проекты]/api/products/{id продукта}/update</br>
        &emsp;ожидаемые данные:      </br>
           &emsp;те же, что и при создании либо никакие</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
           &emsp;&emsp;'result' => 'success',</br>
           &emsp;&emsp;'message'=> "Product <product_name> successfully updated!"</br>
       &emsp;]</br>
# 3.5 удаление продукта
   &emsp;путь (patch)[адрес проекты]/api/products/{id продукта}/delete</br>
   &emsp;ожидаемый ответ:</br>
       &emsp;[</br>
          &emsp;&emsp;'result' => 'success',</br>
          &emsp;&emsp;'message' => 'Product successfully deleted!',</br>
       &emsp;]</br>
# *********************************************************************************
# 
