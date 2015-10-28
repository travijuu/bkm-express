<?php
namespace Travijuu\BkmExpress\Utility;

class Certificate
{

    public static function sign($data, $privateKeyPath)
    {
        $privateKey = self::read($privateKeyPath);
        $pKeyId     = openssl_get_privatekey($privateKey);
        openssl_sign($data, $signature, $pKeyId, "SHA256");
        openssl_free_key($pKeyId);

        return $signature;
    }

    public static function verify($signature, $data, $publicKeyPath)
    {
        $publicKey = self::read($publicKeyPath);
        $pKeyId    = openssl_get_publickey($publicKey);
        $result    = openssl_verify($data, $signature, $pKeyId, "SHA256");
        openssl_free_key($pKeyId);

        return $result;
    }

    public static function read($path)
    {
        $file    = fopen($path, "r");
        $content = fread($file, filesize($path));
        fclose($file);

        return $content;
    }
}