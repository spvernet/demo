<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{
    public function hello()
    {
        return new Response(
            '<html><body>Hello World</body></html>'
        );
    }
}