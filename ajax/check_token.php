<?php
    $secret_key = "pepptyxa";

    function checkToken($token) {
        global $secret_key;

        $parts = explode(".", $token);

        if(count($parts) != 3) return false;

        list($header, $payload, $signature) = $parts;

        $validSignature = hash_hmac('sha256', $header.".".$payload, $secret_key, true);

        if(base64_decode(str_replace(['-','_'], ['+','/'], $signature)) !== $validSignature)
            return false;

        $payloadData = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $payload)), true);

        if($payloadData['exp'] < time())
            return false;

        return $payloadData;
    }
?>