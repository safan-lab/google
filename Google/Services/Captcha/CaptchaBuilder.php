<?php
/**
 * This file is part of the Safan package.
 *
 * (c) Harut Grigoryan <ceo@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google\Services\Captcha;

use Google\DependencyInjection\CaptchaConfiguration;
use Safan\Safan;

class CaptchaBuilder
{
    /**
     * @var CaptchaConfiguration $config
     */
    private $config;

    /**
     * @param CaptchaConfiguration $config
     */
    public function __construct(CaptchaConfiguration $config){
        $this->config = $config;
    }

    /**
     * Render captcha
     *
     * @return mixed
     */
    public function render(){
        $dispatcher = Safan::handler()->getObjectManager()->get('dispatcher');

        return $dispatcher->loadModule('Google', 'captcha', 'set', $this->config);
    }

    /**
     * Check Response with form data
     *
     * @param $formData
     * @return array
     */
    public function check($formData){
        $ch      = curl_init();
        $timeout = 5;
        $url     = $this->config->getRequestUrl() . '?secret=' . $this->config->getSecretKey() . '&response=' . $formData ."&remoteip=" . $_SERVER['REMOTE_ADDR'];

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeout);

        if(!curl_errno($ch)){
            $googleResponse = curl_exec($ch);
            $googleResponse = json_decode($googleResponse);

            if($googleResponse->status == true) {
                $response = [
                    'status'  => true,
                    'message' => 'Checked'
                ];
            }
            else {
                $response = [
                    'status'  => false,
                    'message' => 'Captcha security code is not valid'
                ];
            }
        }
        else {
            $response = [
                'status'  => false,
                'message' => 'Curl error: ' . curl_error($ch)
            ];
        }

        curl_close($ch);
        return $response;
    }
}