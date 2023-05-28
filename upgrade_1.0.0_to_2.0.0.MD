# Upgrading version
## From PHP 7.4 to 8.2 and Laravel 5.7 to 9.0


1. Delete ```composer.lock```
2. Update ```composer.json``` to upgrade to laravel 9.0. edit the .json file with
~~~
{
    "name": "laravel/laravel",
    "description": "The Laravel Framework.",
    "keywords": ["framework", "laravel"],
    "license": "MIT",
    "type": "project",
    "require": {
        "php": "^8.2.0",
        "askedio/laravel-soft-cascade": "^9.0",
        "barryvdh/laravel-debugbar": "^3.2",
        "cybercog/laravel-ban": "^4.7",
        "faryar76/lrm": "^0.0.1",
        "fideloper/proxy": "^4.0",
        "intervention/image": "^2.4",
        "laravel/framework": "^9.0",
        "laravel/helpers": "^1.5",
        "laravel/passport": "^11.4",
		"laravel/ui": "^3.0",
        "laravel/tinker": "^2.0",
        "laravelcollective/html": "^6.0",
        "overtrue/laravel-lang": "~6.0",
        "setasign/fpdf": "^1.8",
		"setasign/fpdi": "^2.0",
        "symfony/error-handler": "^6.0",
        "symfony/mailer": "^6.0",
        "symfony/translation": "^6.0",
		"spatie/laravel-ignition": "^1.0",
		"guzzlehttp/guzzle": "^7.0.1."
    },
    "require-dev": {
        "beyondcode/laravel-dump-server": "^1.0",
        "composer/composer": "^2.2",
        "filp/whoops": "^2.0",
        "fakerphp/faker": "^1.13.0",
        "mockery/mockery": "^1.0",
        "nunomaduro/collision": "^6.1",
        "phpunit/phpunit": "^9.0"
    },
    "autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "extra": {
        "laravel": {
            "dont-discover": [
            ]
        }
    },
    "scripts": {
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate"
        ],
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover"
        ]
    },
    "config": {
        "preferred-install": "dist",
        "sort-packages": true,
        "optimize-autoloader": true,
        "allow-plugins": {
            "kylekatarnls/update-helper": true
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
~~~

3. Change ```app/exceptions/handler.php```
~~~
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
~~~

4. Update ```app/http/Middleware/TrustProxies.php```

instead of 
~~~
use Fideloper
~~~
you need
~~~
use Illuminate\Http\Middleware\TrustProxies as Middleware; 
~~~
 and
~~~
protected $headers =
    Request::HEADER_X_FORWARDED_FOR |
    Request::HEADER_X_FORWARDED_HOST |
    Request::HEADER_X_FORWARDED_PORT |
    Request::HEADER_X_FORWARDED_PROTO |
    Request::HEADER_X_FORWARDED_AWS_ELB;
~~~

5. Upgrade ```app/helpers/helper``` to make transparent pdfs possible again.
replace all ```_out``` with ```_put```
(This is an issue with the external AlphaPDF script and has been updated on the official fpdf website)


6. Update ```app\Providers\AuthServiceProvider.php```
Passport's routes have been moved to a dedicated route file. You need to remove the ```Passport::routes()``` call from this service provider

7. Update the resend verification mail link to a button with POST method on ```\resources\views\layouts\verify.blade.php``` (line 105)
~~~
<h3 class="verify-text ">	Wenn du keine E-Mail erhalten hast,  
	<form class="d-inline" method="POST" action={{ route('verification.resend') }}>
	    @csrf
		<button type="submit" class="btn btn-link p-0 m-0 align-baseline">
		    {{ __('klicke hier, um eine neue Mail anzufordern') }}
        </button>
    </form>
</h3>
~~~
8. Run ```composer update```

9. One bit of code has been hardcoded into the vendor fpdf library. Soit needs to be updated after running composer update
to make utf 8 work again:
```Vendor/setasign/fpdf/fpdf.php```		add to line 628  directly after
~~~
if($txt!=='') 
{
~~~
the follwing code
~~~
$txt = iconv('utf-8', 'cp1252//IGNORE', $txt); 
~~~
