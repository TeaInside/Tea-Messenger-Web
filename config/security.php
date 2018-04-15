<?php

return [
    
    "csrf" => [
        "protection" => true,
        "expired" =>  300,
        "cookie_name" => "esteh_csrf",
        "is_secure_cookie" => false,
        "cookie_path" => "/",
        "cookie_domain" => "localhost",
        "cookie_secure" => false,
        "cookie_http_only" => true
    ]

];
