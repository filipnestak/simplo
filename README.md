# Simplo vypracovane zadanie - Nestak

## Route list
| Method | URI |
 | ------ | ------ |
|GET | api/customers |                            
|POST     | api/customers |                            
|PUT      | api/customers/{id} |                       
|DELETE   | api/customers/{id} |                       
|PUT      | api/customers/{id}/add-customer-group |    
|PUT      | api/customers/{id}/remove-customer-group | 
|GET | api/customers/{id}/{withGroups?} |         
|POST     | api/login |                                
|POST     | api/logout |                               
|POST     | api/register |    


## Rozbehanie


```sh
php artisan migrate
```


```sh
php artisan db:seed
```

Prihlásenie #/api/login
email: admin@admin.sk
pass : admin

V roote je JSON export z postmena na endpointy
