# Restorm For Laravel
This composer package allows us to handle requests properly that sent by the [Restorm](https://github.com/iceylan/restorm) javascript library in Laravel.

# Installation
To install the package, run the following command in terminal, on your laravel path:

```bash
composer require iceylan/restorm
```

# Usage
Just keep things simple in laravel `routes/api.php` file:

```php
use App\Models\Post;
use Iceylan\Restorm\Restorm;

Route::get( 'api/v1.0/posts', function( Restorm $restorm )
{
	return $restorm->apply( Post::class )->get();
});
```

Restorm will parse the request and make modification to the model that we just passed to it, depending on the directives that carried by the request.

It will return the QueryBuilder instance back with the modifications that applied to it. We can continue to work with that query builder as we did before in Laravel.
