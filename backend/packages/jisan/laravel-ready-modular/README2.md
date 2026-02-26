# Laravel-Ready-Moduler-Package Manual

## Description
This is a Laravel Ready Moduler Package...

### Module Install
`php artisan make:module ModuleName`

##### This will genarate these:
1. Config
    - cache.php
2. Controllers 
    - ModuleNameController.php
3. Migrations
    - timestamp_create_module_name_table.php
4. Models 
    - ModuleName.php
5. Repositories 
    - ModuleNameRepository.php
6. Requests
    - ModuleNameRequest.php
7. Resources
    - ModuleNameResource.php
8. Routes
    - api.php
9. Seeders
    - ModuleNameSeeder.php
10. Services
    - ModuleNameService.php

#### Example:
`php artisan make:module Product`

##### This will genarate these:
1. Config
    - cache.php
2. Controllers 
    - ProductController.php
3. Migrations
    - timestamp_create_products_table.php
4. Models 
    - Product.php
5. Repositories 
    - ProductRepository.php
6. Requests
    - ProductRequest.php
7. Resources
    - ProductResource.php
8. Routes
    - api.php
9. Seeders
    - ProductSeeder.php
10. Services
    - ProductService.php

### Sub Module Install
`php artisan make:sub-entity ModuleName EntityName`

##### This will genarate these:

1. Config
    - cache.php
2. Controllers 
    - ModuleNameController.php
    - SubModuleNameController.php
3. Migrations
    - timestamp_create_module_name_table.php
    - SubModuleNameController.php
4. Models 
    - ModuleName.php
    - SubModuleName.php

5. Repositories 
    - ModuleNameRepository.php
    - SubModuleNameRepository.php
6. Requests
    - ModuleNameRequest.php
    - SubModuleNameRequest.php
7. Resources
    - ModuleNameResource.php
    - SubModuleNameResource.php
8. Routes
    - api.php
9. Seeders
    - ModuleNameSeeder.php
    - SubModuleNameSeeder.php
10. Services
    - ModuleNameService.php
    - SubModuleNameService.php


#### Example:
`php artisan make:sub-entity Product ProductDetail`
1. Config
    - cache.php
2. Controllers 
    - ProductController.php
    - ProductDetailController.php
3. Migrations
    - timestamp_create_products_table.php
4. Models 
    - Product.php
    - ProductDetail.php
5. Repositories 
    - ProductRepository.php
    - ProductDetailRepository.php
6. Requests
    - ProductRequest.php
    - ProductDetailRequest.php
7. Resources
    - ProductResource.php
    - ProductDetailResource.php
8. Routes
    - api.php
9. Seeders
    - ProductSeeder.php
    - ProductDetailSeeder.php
10. Services
    - ProductService.php
    - ProductDetailService.php


