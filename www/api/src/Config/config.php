<?php

// Configurações do banco de dados
define('DB_HOST', 'db');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASSWORD', 'nova_senha');
define('DB_NAME', 'home_security');

// Configurações da API
define('API_IS_ACTIVE', true);
define('API_EXGIR_KEY', false);
define('API_VERSION', '1.0.0');
define('API_KEY', '4bnsx6efOzz4u5FBQEfR');

// Configurações do token
define('TOKEN_KEY', '4bnsx6efOzz4u5FBQEfR');
define('TOKEN_VALIDITY', 3600);
define('TOKEN_VALID_AFTER', 0);

// Configurações da rota
define('PREFIX_URI', '/api');
define('ALLOWED_METHODS', ['GET', 'POST', 'PUT', 'DELETE', 'UPDATE']);

// Informações do projeto
define('AUTHOR', 'Miqueias Rodrigues');
define('PROJECT_NAME', 'HomeSecurity');

