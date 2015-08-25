Laravel 5 Modules
==============

pingpong/modules is a laravel package which created to manage your large laravel app using modules. Module is like a laravel package, it have some views, controllers or models. This package is supported and tested in both Laravel 4 and Laravel 5.

## Credits

Credits to [pingponglabs/modules](https://github.com/pingpong-labs/modules) for the original package. 

## Installation

```bash
composer require "pingpong/modules:~2.2"
```

### Add Service Provider

Next add the following service provider in config/app.php.

```php
'providers' => array(
  'Pingpong\Modules\ModulesServiceProvider',
),
```

Next, add the following aliases to aliases array in the same file.

```php
'aliases' => array(
  'Module' => 'Pingpong\Modules\Facades\Module',
),
```

Next publish the package's configuration file by run :

```bash
php artisan vendor:publish
```

### Autoloading

By default controllers, entities or repositories are not loaded automatically. You can autoload all that stuff using psr-4. For example :

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "modules/"
    }
  }
}
```

## Configuration

* `modules` - Used for save the generated modules.
* `assets` - Used for save the modules's assets from each modules.
* `migration` - Used for save the modules's migrations if you publish the modules's migrations.
* `generator` - Used for generate modules folders.
* `scan` - Used for allow to scan other folders.
* `enabled` - If true, the package will scan other paths. By default the value is false
* `paths` - The list of path which can scanned automatically by the package.
* `composer`
  * `vendor` - Composer vendor name.
  * `author.name` - Composer author name.
  * `author.email` - Composer author email.
* `cache`
  * `enabled` - If true, the scanned modules (all modules) will cached automatically. By default the value is false
  * `key` - The name of cache.
  * `lifetime` - Lifetime of cache.

## Creating A Module

To create a new module you can simply run :

```bash
php artisan module:make modulename
```

### Create a new module

```bash
php artisan module:make Blog
```

### Create multiple modules

```bash
php artisan module:make Blog User Auth
```

By default if you create a new module, that will add some resources like controller, seed class or provider automatically. If you don't want these, you can add --plain flag, to generate a plain module.

```bash
php artisan module:make Blog --plain
```

### Naming Convention

Because we are autoloading the modules using psr-4, we strongly recommend using StudlyCase convention.

### Folder Structure

```
modules/
  ├── Blog/
      ├── Assets/
      ├── Config/
      ├── Console/
      ├── Database/
          ├── Migrations/
          ├── Seeders/
      ├── Entities/
      ├── Http/
          ├── Controllers/
          ├── Middleware/
          ├── Requests/
          ├── routes.php
      ├── Providers/
          ├── BlogServiceProvider.php
      ├── Resources/
          ├── lang/
          ├── views/
      ├── Repositories/
      ├── Tests/
      ├── composer.json
      ├── module.json
      ├── start.php
```

## Artisan Commands

Create a new module.

```bash
php artisan module:make blog
```

Use the specified module. Please see #26.
```bash
php artisan module:use blog
```

Show all modules in command line.

```bash
php artisan module:list
```

Install a new module using composer (vendor/packagename)

```bash
php artisan module:install vendor/packagename
```

Remove a module

```bash
php artisan module:remove modulename
```

Create new command for the specified module.

```bash
php artisan module:make-command CustomCommand blog
php artisan module:make-command CustomCommand --command=custom:command blog
php artisan module:make-command CustomCommand --namespace=Modules\Blog\Commands blog
```

Create new migration for the specified module.

```bash
php artisan module:make-migration create_users_table blog
php artisan module:make-migration create_users_table --fields="username:string, password:string" blog
php artisan module:make-migration add_email_to_users_table --fields="email:string:unique" blog
php artisan module:make-migration remove_email_from_users_table --fields="email:string:unique" blog
php artisan module:make-migration drop_users_table blog
```

Rollback, Reset and Refresh modules Migrations.

```bash
php artisan module:migrate-rollback
php artisan module:migrate-reset
php artisan module:migrate-refresh
```

Rollback, Reset and Refresh migrations for the specified module.

```bash
php artisan module:migrate-rollback blog
php artisan module:migrate-reset blog
php artisan module:migrate-refresh blog
```

Create new seed for the specified module.

```bash
php artisan module:make-seed users blog
```

Migrate from the specified module.

```bash
php artisan module:migrate blog
```

Migrate from all modules.

```bash
php artisan module:migrate
```

Seed from the specified module.

```bash
php artisan module:seed blog
```

Seed from all modules.

```bash
php artisan module:seed
```

Create new controller for the specified module.

```bash
php artisan module:make-controller SiteController blog
```

Publish assets from the specified module to public directory.

```bash
php artisan module:publish blog
```

Publish assets from all modules to public directory.

```bash
php artisan module:publish
```

Create new model for the specified module.

```bash
php artisan module:make-model User blog
php artisan module:make-model User blog --fillable="username,email,password"
```

Create new service provider for the specified module.

```bash
php artisan module:make-provider MyServiceProvider blog
```

Publish migration for the specified module or for all modules. This helpful when you want to rollback the migrations. You can also run php artisan migrate instead of php artisan module:migrate command for migrate the migrations.

For the specified module.

```bash
php artisan module:publish-migration blog
```

For all modules.

```bash
php artisan module:publish-migration
```

Enable the specified module.

```bash
php artisan module:enable blog
```

Disable the specified module.

```bash
php artisan module:disable blog
```

Generate new middleware class.

```bash
php artisan module:make-middleware Auth
```

Update dependencies for the specified module.

```bash
php artisan module:update ModuleName
```

Update dependencies for all modules.

```bash
php artisan module:update
```

Show the list of modules.

```bash
php artisan module:list
```

## Facades

Get all modules.

```php
Module::all();
```

Get all cached modules.
```php
Module::getCached()
```

Get ordered modules. The modules will be ordered by the priority key in module.json file.

```php
Module::getOrdered();
```

Get scanned modules.

```php
Module::scan();
```

Find a specific module.

```php
Module::find('name');
Module::get('name');
```

Find a module, if there is one, return the Module instance, otherwise throw Pingpong\Modules\Exeptions\ModuleNotFoundException.

```php
Module::findOrFail('module-name');
```

Get scanned paths.

```php
Module::getScanPaths();
```

Get all modules as a collection instance.

```php
Module::toCollection();
```

Get modules by the status. 1 for active and 0 for inactive.

```php
Module::getByStatus(1);
```

Check the specified module. If it exists, will return true, otherwise false.

```php
Module::has('blog');
```

Get all enabled modules.

```php
Module::enabled();
```

Get all disabled modules.

```php
Module::disabled();
```

Get count of all modules.

```php
Module::count();
```

Get module path.

```php
Module::getPath();
```

Register the modules.

```php
Module::register();
```

Boot all available modules.

```php
Module::boot();
```

Get all enabled modules as collection instance.

```php
Module::collections();
```

Get module path from the specified module.

```php
Module::getModulePath('name');
```

Get assets path from the specified module.

```php
Module::getAssetPath('name');
```

Get config value from this package.

```php
Module::config('composer.vendor');
```

Get used storage path.

```php
Module::getUsedStoragePath();
```

Get used module for cli session.

```php
Module::getUsedNow();
Module::getUsed();
```

Set used module for cli session.

```php
Module::setUsed('name');
```

Get modules's assets path.

```php
Module::getAssetsPath();
```

Get asset url from specific module.

```php
Module::asset('blog:img/logo.img');
```

Install the specified module by given module name.

```php
Module::install('pingpong-modules/hello');
```

Update dependencies for the specified module.

```php
Module::update('hello');
```

## Module Entity

Get an entity from a specific module.

```php
$module = Module::find('blog');
```

Get module name.

```php
$module->getName();
```

Get module name in lowercase.

```php
$module->getLowerName();
```

Get module name in studlycase.

```php
$module->getStudlyName();
```

Get module path.

```php
$module->getPath();
```
Get extra path.

```php
$module->getExtraPath('Assets');
```

Disable the specified module.

```php
$module->enable();
```

Enable the specified module.

```php
$module->disable();
```

Delete the specified module.

```php
$module->delete();
```

## Custom Namespaces

When you create a new module it also registers new custom namespace for Lang, View and Config. For example, if you create a new module named blog, it will also register new namespace/hint blog for that module. Then, you can use that namespace for calling Lang, View or Config. Following are some examples of its usage:

Calling Lang:

```php
Lang::get('blog::group.name');
```
Calling View:

```php
View::make('blog::index')
View::make('blog::partials.sidebar')
```

Calling Config:

```php
Config::get('blog.name')
```

## Auto Scan Vendor Directory

By default the vendor directory is not scanned automatically, you need to update the configuration file to allow that. Set scan.enabled value to true. For example :

```json
// file config/modules.php

return [
  //...
  'scan' => [
    'enabled' => true
  ]
  //...
]
```

## Official documentation

Official documentation is located [here](http://sky.pingpong-labs.com/docs/2.0/modules)
