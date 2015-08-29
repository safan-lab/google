<?php
/**
 * This file is part of the Safan package.
 *
 * (c) Harut Grigoryan <ceo@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google;

use Google\DependencyInjection\CaptchaConfiguration;
use Google\Services\Captcha\CaptchaBuilder;
use Safan\GlobalExceptions\FileNotFoundException;
use Safan\GlobalExceptions\ParamsNotFoundException;

class Google
{
    /**
     * @var array
     */
    private $services = [];

    /**
     * @var array
     */
    private $params = [];

    /**
     * Get service instance
     *
     * @param $type
     * @return mixed
     * @throws \Exception
     */
    public function getService($type){
        if(empty($this->params))
            $this->params = $this->getParams();

        if($type == 'captcha'){
            if(!isset($this->params['captcha']))
                throw new ParamsNotFoundException('Google captcha params not exist');

            if(!isset($this->services['captcha'])){
                if(!function_exists('curl_version'))
                    throw new \Exception('Curl library is not installed');

                $captchaConfig = new CaptchaConfiguration();
                $captchaConfig->build($this->params['captcha']);
                $this->services['captcha'] = new CaptchaBuilder($captchaConfig);
            }

            return $this->services['captcha'];
        }
        else
            throw new \Exception('Service type ' . $type . ' not exist');
    }

    /**
     * Get parameters from config
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function getParams(){
        $configFile = APP_BASE_PATH . DS . 'application' . DS . 'Settings' . DS . 'google.config.php';

        if (!file_exists($configFile))
            throw new FileNotFoundException('Google service configuration not exist');

        return include $configFile;
    }
}
