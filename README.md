# Documents
Document management system with embedding, uploading, downloading for different media types.
 
---

## Installation
Installing Documents is simple.
 
1. Pull this package in through [Composer](https://getcomposer.org).
    ```js
    {
        "require": {
            "reactor/documents": "dev-master"
        }
    }
    ```

2. In order to register Documents Service Provider add `'Reactor\Documents\Providers\DocumentsServiceProvider'` together with other package providers that Documents rely on to the end of `providers` array in your `config/app.php` file.
    ```php
    'providers' => array(
    
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Reactor\Documents\Providers\DocumentsServiceProvider',
        'Kenarkose\Files\Provider\FilesServiceProvider',
        'Kenarkose\Sortable\SortableServiceProvider',
        'Kenarkose\Transit\Provider\TransitServiceProvider',
        'Simexis\Oembed\OembedServiceProvider',
        'Intervention\Image\ImageServiceProvider',
        'Dimsav\Translatable\TranslatableServiceProvider'
    
    ),
    ```
    
3. Publish the migrations and configuration files.
    ```bash
    php artisan vendor:publish --provider:"Reactor\Documents\Providers\DocumentsServiceProvider"
    ```
    Do not forget to migrate the database.

4. Please check the tests and source code for further documentation.
 
## License
Documents is released under [MIT License](https://github.com/infolinematrix/Documents/blob/master/LICENSE).
