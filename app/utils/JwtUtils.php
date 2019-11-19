<?php

namespace App\Utils;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\Serializer\JWSSerializerManager;
use Jose\Component\Signature\JWSVerifier;

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

        return $serializer->serialize(self::CreateJWS($payload), 0);
    }

    private static function CreateJWS($payload)
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

    public static function GetJWK()
    {
        return JWKFactory::createFromSecret(
            getenv('JWT_SECRET'),       // The shared secret
            [                      // Optional additional members
                'alg' => 'HS256',
                'use' => 'sig'
            ]
        );
    }

    public static function GetJWS($token)
    {
        // The serializer manager. We only use the JWS Compact Serialization Mode.
        $serializerManager = new JWSSerializerManager([
            new CompactSerializer(),
        ]);

        return $serializerManager->unserialize($token);
    }

    public static function VerifyToken($token)
    {
        // The algorithm manager with the HS256 algorithm.
        $algorithmManager = new AlgorithmManager([
            new HS256(),
        ]);

        // We instantiate our JWS Verifier.
        $jwsVerifier = new JWSVerifier(
            $algorithmManager
        );

        return $jwsVerifier->verifyWithKey(self::GetJWS($token), self::GetJWK(), 0);
    }
}
