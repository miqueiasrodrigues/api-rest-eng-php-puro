<?php

namespace App\Http\Services\Session;

require_once __DIR__ . "/../../../../Libs/JWT/JWT.php";

use App\Exceptions\AppException;
use App\Http\Repositories\UserRepository;
use Firebase\JWT\JWT;

class CreateSessionService extends UserRepository
{
    public function execute(array $data)
    {
        $isExistAccount = $this->accountFind($data['email'], $data['password']);

        if ($isExistAccount === false) {
            throw new AppException(400, "Conta não existe.");
        }

        $issuedAt = time();
        $expirationTime = $issuedAt + TOKEN_VALIDITY;       // Token válido por 1 hora
        $validAfter = $issuedAt + TOKEN_VALID_AFTER;        // Token válido imediatamente

        $payload = array(
            "iss" => "http://homesecurity.api/",            // Emissor
            "aud" => "http://homesecurity.app/",            // Destinatário
            "iat" => $issuedAt,                             // Tempo em que o token foi emitido
            "nbf" => $validAfter,                           // Tempo em que o token começa a ser válido
            "exp" => $expirationTime,                       // Tempo em que o token expira
            "sub" => $isExistAccount['id'],                 // ID
        //  "role" => "user"                                // Nível
        );

        $jwt = JWT::encode($payload, TOKEN_KEY, 'HS256');

        return $jwt;
    }
}
