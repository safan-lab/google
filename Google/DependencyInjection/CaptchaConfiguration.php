<?php
/**
 * This file is part of the Safan package.
 *
 * (c) Harut Grigoryan <ceo@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google\DependencyInjection;

class CaptchaConfiguration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $requestUrl = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * @var string
     */
    private $siteKey = '';

    /**
     * @var string
     */
    private $secretKey = '';

    /**
     * @param array $params
     * @return mixed|void
     * @throws \Exception
     */
    public function build($params = []){
        if(!isset($params['siteKey']))
            throw new \Exception('Google Captcha siteKey is not defined from configuration');

        if(!isset($params['secretKey']))
            throw new \Exception('Google Captcha secretKey is not defined from configuration');

        $this->siteKey   = $params['siteKey'];
        $this->secretKey = $params['secretKey'];
    }

    /**
     * @return string
     */
    public function getRequestUrl(){
        return $this->requestUrl;
    }

    /**
     * @return string
     */
    public function getSiteKey(){
        return $this->siteKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(){
        return $this->secretKey;
    }
}