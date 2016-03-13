<?php

// +----------------------------------------------------------------------
// | date: 2016-03-11
// +----------------------------------------------------------------------
// | QQAdapter.php: QQ OAuth登录
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace Yangyifan\OAuth\Oauth;

class QQAdapter extends AbstractAdapter
{
    const VERSION               = "2.0";
    const GET_AUTH_CODE_URL     = "https://graph.qq.com/oauth2.0/authorize";
    const GET_ACCESS_TOKEN_URL  = "https://graph.qq.com/oauth2.0/token";
    const GET_OPENID_URL        = "https://graph.qq.com/oauth2.0/me";

    /**
     * 配置信息
     *
     * @var
     */
    protected $config;

    /**
     *OAUTH 对象
     *
     * @var
     */
    protected $oauth;

    /**
     * 构造方法
     *
     * @param $config   配置信息
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct($config)
    {
        $this->config   = $config;
    }

    /**
     * 发起登录
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function login()
    {
        $appid      = $this->config['app_id'];
        $callback   = $this->config['callback'];
        $scope      = $this->config['scope'];

        //-------生成唯一随机串防CSRF攻击
        $state = md5(uniqid(rand(), TRUE));

        //-------构造请求参数列表
        $keysArr = array(
            "response_type"     => "code",
            "client_id"         => $appid,
            "redirect_uri"      => $callback,
            "state"             => $state,
            "scope"             => $scope
        );

        $login_url =  $this->combineURL(self::GET_AUTH_CODE_URL, $keysArr);

        header("Location:$login_url");
    }

}