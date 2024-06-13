# Restorm For Laravel
This composer package allows us to handle requests properly in Laravel that sent by the [Restorm](https://github.com/ismailceylan/restorm) javascript library from client side.

# Installation
To install the package, run the following command in terminal, on your laravel project's root path:

```bash
composer require iceylan/restorm
```

# Usage
Let's just keep things simple, we can use it in laravel `routes/api.php` file like:

```php
use App\Models\Post;
use Iceylan\Restorm\Restorm;

Route::get( 'v1.0/posts', function( Restorm $restorm )
{
	return $restorm
		->apply( Post::class )
		->get();
});
```

And server can easily respond the request like:

```
GET /api/v1.0/posts?with=author&filter[author_id]=eq:12&sort[created_at]=desc&limit=10&page=1&paginate=length-aware
```

If the endpoint is not a collection of resources, then we should grab the model the Laravel way like:

```php
use App\Models\Post;
use Iceylan\Restorm\Restorm;

Route::get( 'v1.0/posts/{post}', function( Restorm $restorm, Post $post )
{
	return $restorm
		->apply( $post )
		->get();
});
```

We can pass the following types as a parameter to the `apply` method:
* fully qualified class name like `App\Models\Post`
* query builders like `Post::where( 'id', 1 )`
* relations `Post::with( 'user' )`
* model instances like `Post::find( 1 )`
* model classes like `Post::class` which will return `App\Models\Post`

Restorm will parse the request and make modification on the model that we just passed to it, depending on the directives that carried by the request.

It will return the QueryBuilder, Model, Relation, or whatever we passed at the first stage. It will be back with the modifications applied to it. We can continue to work with that source as we did before in Laravel.
