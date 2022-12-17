<?php

require_once(dirname(__DIR__).'/IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey('sandbox-hFbIlOIYz1Kr1YWUt1XLi7605E4usWWm');
        $options->setSecretKey('sandbox-x2udkMc4YsMCdAULDPsB5QWBw5fJv4qD');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
}