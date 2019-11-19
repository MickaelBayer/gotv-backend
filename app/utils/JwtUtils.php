<?php

namespace App\Utils;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\KeyManagement\JWKFactory;

class JwtUtils
{

    public static function CreateToken($user, $expire)
    {
        $payload = json_encode([
            'iat' => time(),
            'nbf' => time(),
            'exp' => $expire,
            'iss' => 'localhost',
            'aud' => 'GoTvSeries',
            'id' => $user->usr_id,
            'email' => $user->usr_email,
            'rank' => $user->usr_roe_id
        ]);

        $serializer = new CompactSerializer();

        return $serializer->serialize(self::GetJWS($payload), 0);
    }

    private static function GetJWS($payload)
    {
        $algorithmManager = new AlgorithmManager([
            new HS256(),
        ]);

        $jwsBuilder = new JWSBuilder($algorithmManager);

        return $jwsBuilder
            ->create()                               // We want to create a new JWS
            ->withPayload($payload)                  // We set the payload
            ->addSignature(self::GetJWK(), ['alg' => 'HS256']) // We add a signature with a simple protected header
            ->build();
    }

    private static function GetJWK()
    {
        return JWKFactory::createFromSecret(
            getenv('JWT_SECRET'),       // The shared secret
            [                      // Optional additional members
                'alg' => 'HS256',
                'use' => 'sig'
            ]
        );
    }
}
