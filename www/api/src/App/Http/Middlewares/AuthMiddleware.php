<?php

namespace App\Http\Middleware;

require_once __DIR__ . "/../../../Libs/JWT/JWT.php";
require_once __DIR__ . "/../../../Libs/JWT/Key.php";
require_once __DIR__ . "/../../../Libs/JWT/ExpiredException.php";


use App\Exceptions\AppException;
use App\Response;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    private $publicRoutes;


    public function __construct(array $publicRoutes)
    {
        $this->publicRoutes = $publicRoutes;
    }

    public function handle($method, $path, $next)
    {
        $headers = apache_request_headers();

        if (isset($this->publicRoutes[$method])) {
            foreach ($this->publicRoutes[$method] as $publicRoute) {
                if (preg_match($publicRoute, $path)) {
                    return $next();
                }
            }
        }

        if (!isset($headers["Authorization"])) {
            echo Response::json(401, 'Token não fornecido');
            exit;
        }

        $authHeader = $headers["Authorization"];

        list($jwt) = sscanf($authHeader, 'Bearer %s');

        if (!$jwt) {
            echo Response::json(401, 'Token mal formatado');
            exit;
        }

        try {
            $decoded = JWT::decode($jwt, new Key(TOKEN_KEY, 'HS256'));
            
            $currentTime = time();

            if (!isset(((array) $decoded)['exp'])) {
                throw new AppException(401, "Token inválido.");
            }

            if (isset(((array) $decoded)['exp']) && ((array) $decoded)['exp'] < $currentTime) {
                echo Response::json(401, 'Token expirado');
                exit;
            }

            if (isset($decoded->nbf) && $decoded->nbf > $currentTime) {
                echo Response::json(401, 'Token não está ativo ainda');
                exit;
            }
        } catch (\Exception $e) {
            throw new AppException(401, "Token inválido ou expirado");
        }

        $next();
    }
}
