<?php
namespace Travijuu\BkmExpress\Utility;

class Certificate
{

    /**
     * encrypts the data with given private key
     *
     * @param string $data
     * @param string $privateKeyPath
     * @return string
     */
    public static function sign($data, $privateKeyPath)
    {
        $privateKey = self::read($privateKeyPath);
        $pKeyId     = openssl_get_privatekey($privateKey);
        openssl_sign($data, $signature, $pKeyId, "SHA256");
        openssl_free_key($pKeyId);

        return $signature;
    }

    /**
     * makes the verification of the incoming data with a public key
     * @param string $signature
     * @param string $data
     * @param string $publicKeyPath
     * @return boolean
     */
    public static function verify($signature, $data, $publicKeyPath)
    {
        $publicKey = self::read($publicKeyPath);
        $pKeyId    = openssl_get_publickey($publicKey);
        $result    = openssl_verify($data, $signature, $pKeyId, "SHA256");
        openssl_free_key($pKeyId);

        return (boolean) $result;
    }

    /**
     * reads the file and returns the content of it
     *
     * @param string $path
     * @return string
     */
    public static function read($path)
    {
        $file    = fopen($path, "r");
        $content = fread($file, filesize($path));
        fclose($file);

        return $content;
    }
}