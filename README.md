##yii2-rate-docker
1. Для запуска необходимо склонировать проект
2. В папке с проектом запустить: ```docker-compose up -d```
3. Установите зависимости: ```docker exec -it app bash -c 'composer install'```
4. Запустите миграции: ```docker exec -it app bash -c 'yii migrate'```
5. Проект откроется по адресу: ```http://localhost:8100```
6. Добавьте в свой планировщик задач обновление курса валют:```docker exec -it app bash -c 'yii update-rate/load'```

Логин/пароль по умолчанию admin/admin
* Для просмотра end-point'ов ```/site/test```
