# API PROVIDER | Laravel

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Exemplo para gerar as classes automaticamente 
```
php artisan make:entity Cliente --fillable="nome:string,email:string" --rules="nome=>required,email=>required|email"
```

Permissões necessárias
```
sudo service apache2 restart
sudo chmod 777 -R storage/app/
sudo chown root:root -R storage/app/
sudo chown root:root -R storage/framework/
```

Limpando cache da aplicação
```
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
