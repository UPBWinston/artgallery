<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
{
$content = "You do not have the right role to access this resource.
Please log in on <a href='https://127.0.0.1:8000/login'>login page</a>";
    return new Response($content, 403);
}
}