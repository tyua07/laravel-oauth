<?php

// +----------------------------------------------------------------------
// | date: 2016-03-11
// +----------------------------------------------------------------------
// | AbstractAdapter.php:  OAuth 抽象类型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace Yangyifan\OAuth\Oauth;

use Yangyifan\OAuth\OAuthInterface;
use GuzzleHttp\Client;

abstract class AbstractAdapter implements OAuthInterface
{
    /**
     * Client
     *
     * @var Client
     */
    private static $client;

    /**
     * 组合url
     *
     * @param $url
     * @param array $params
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function combineURL($url, array $params = [])
    {
        return rtrim($url, '?') . '?' . http_build_query($params);
    }

    /**
     * 获得 Client
     *
     * @return Client
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getClient()
    {
        if (is_null(self::$client)) {
            self::$client = new Client();
        }
        return self::$client;
    }
}