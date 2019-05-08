### FYI
Дорогой Андрей!
```
Странное решение по созданию таблицы likeable_likes, которой прописан неймспейс сущности. Я бы просто хранил лайки на сущности и все. А likeable надо бы юзать на уровне приложения как LikeableInterface. Хотя я могу не знать особенностей задумки.
```

-> https://laravel.com/docs/5.8/eloquent-relationships#polymorphic-relationships

Полиморфные связи лучшее решение для такого рода задач.


### Install

1) `make build`
2) `make install`
3) `make migrate`
4) `make seed`
5) `make symlink`

**Use** `make up` **for all next service up`s**

Go to: http://localhost/login

Admin credentials (email/password):
```
admin@email.com/123456
```
