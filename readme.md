## Setup

-- Add to composer.json

1) 
```bash
"repositories": [
           {
               "type":"package",
               "package":{
   
                   "name":"sashaef/translateprovider",
                   "version": "dev-master",
                   "source":{
                       "type":"git",
                       "url":"ssh://git@95.211.204.15:8415/esv2/translateprovider.git",
                       "reference":"master"
                   }
               }
           }
       ],
```       
2) 

 ```bash
 "require": {
            ...,
            "sashaef/translateprovider": "dev-master"
        },     
  ```       
-- Than run composer install and composer update        



-- Add to config/app.php

```bash
Sashaef\TranslateProvider\TranslateProvider::class,
```

-- Add to composer.json

```bash
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Sashaef\\TranslateProvider\\": "vendor/sashaef/translateprovider/src/"
        },
}
```

-- Migrate db
```bash
php artisan migrate --path=vendor/sashaef/translateprovider/src/database/migrations
```
-- Add assets
```bash
php artisan vendor:publish --tag=public --force
```
-- Add config
```bash
php artisan vendor:publish --tag=config
```
-- Add translations
```bash
php artisan db:seed --class=Sashaef\TranslateProvider\Database\Seeder\DatabaseSeeder
```
-- Remove from config/app.php exists translate module
```bash
//Barryvdh\TranslationManager\TranslationServiceProvider::class,
```
## Admin
-- Path
```bash
/admin/trans
```
-- Add menu
```bash
<li {{ $segment2 == 'translates'?'class=active':''}}>
    <a {{ $segment2 == 'translates'?'class=active':''}}>
        <i class="fa fa-language"></i>
        <span>@lang('main.translations')</span>
    </a>
    <ul>
        <li {{ $segment3 == 'black'?'class=active':''}}>
            <a {{ $segment3 == 'black'?'class=active':''}} href="{{ route('translate.langs.index') }}">
                <i class="fa fa-circle-o"></i>
                <span>@lang('main.languages')</span>
            </a>
        </li>
        <li {{ $segment3 == 'black'?'class=active':''}}>
            <a {{ $segment3 == 'black'?'class=active':''}} href="{{ route('translate.groups.type', ['type' => 'interface']) }}">
                <i class="fa fa-circle-o"></i>
                <span>@lang('main.interface-trans')</span>
            </a>
        </li>
        <li {{ $segment3 == 'white'?'class=active':''}}>
            <a {{ $segment3 == 'white'?'class=active':''}} href="{{ route('translate.groups.type', ['type' => 'system']) }}">
                <i class="fa fa-circle-o"></i>
                <span>@lang('main.system-trans')</span>
            </a>
        </li>
    </ul>
</li>
```
-- config
```bash
'url' => '/admin/translates',
'middleware' => ['web', ...],
'layout' => 'layouts.admin',
'show_full_key' => true,
```
## API
```bash
route - translate/show

@bodyparams - "key"   (interface:main:new_translation:2)
@response {"interface:main:new_translation:2": "r2fd"}
```
    
## Key structure
```
[null|interface, system]::[group name].[translate key]
Example: main.translate or system::main.translate or interface::main.translate
```