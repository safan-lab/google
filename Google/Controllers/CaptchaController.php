<?php
/**
 * This file is part of the Safan package.
 *
 * (c) Harut Grigoryan <ceo@safanlab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google\Controllers;

use Google\DependencyInjection\CaptchaConfiguration;
use Safan\Mvc\Controller;

class CaptchaController extends Controller
{
    /**
     * Render captcha
     *
     * @param  CaptchaConfiguration $config
     * @return mixed
     */
    public function setAction(CaptchaConfiguration $config){
        $this->assign('siteKey', $config->getSiteKey());

        return $this->renderPartial('captcha');
    }
}