Safan Module for Google services
===============

REQUIREMENTS
------------
```
PHP > 5.4.0
```

SETUP
------------

If you're using [Composer](http://getcomposer.org/) for your project's dependencies, add the following to your "composer.json":

```
"require": {
    "safan-lab/google": "1.*"
}
```

Update Modules Config List - safan-framework-standard/application/Settings/modules.config.php
```
<?php
return [
    ...
    'Google' => 'vendor/safan-lab/google/Google'
    ...
];

Captcha
------------

Add new config file with name - safan-framework-standard/application/Settings/google.config.php
Official documentation - [Google reCaptcha][1]

```
<?php
return [
    'captcha' => [
        'siteKey'   => 'your_site_key',
        'secretKey' => 'your_secret_key'
    ]
];
```

For rendering captcha you can use Safan Object Manager
```
<?= \Safan\Safan::handler()->getObjectManager()->getInstance('Google\Google')->getService('captcha')->render() ?>
```

For checking data
```
<?php
    // get post data
    $captchaField = \Safan\GlobalData\Post::str('g-recaptcha-response');
    // check data
    $googleCaptchaService = \Safan\Safan::handler()->getObjectManager()->getInstance('Google\Google')->getService('captcha');
    $response = $googleCaptchaService->check($captchaField);

    if($response['status'] === false)
        return $response['message'];
?>
```

[1]:  https://www.google.com/recaptcha/intro/index.html