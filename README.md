# Restorm For Laravel
This composer package allows us to handle requests properly that sent by the Restorm js library in Laravel.

# Installation
To install the package, run the following command in terminal, on your laravel path:

```bash
composer require iceylan/restorm
```

# Usage
First of all, we need a route in the `routes/api.php` file:

```php
use App\Models\Post;
use Iceylan\Restorm\Restorm;

Route::get( 'api/v1.0/posts', function( Restorm $restorm )
{
	return $restorm->apply( Post::class );
});
```

Restorm will parse the request and make modification to the model depending on the directives that carried by the request.

It will return the query builder instance back with the modifications that applied to it.

You can continue to work with the query builder as you did before in Laravel.
