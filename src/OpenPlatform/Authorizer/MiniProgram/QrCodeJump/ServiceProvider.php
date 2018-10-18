<?php

/*
 * This file is part of the muxing0608/wechat.
 *
 * (c) hang <chenhang@16pinpin.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\OpenPlatform\Authorizer\MiniProgram\QrCodeJump;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['qr_code_jump'] = function ($app) {
            return new Client($app);
        };
    }
}
