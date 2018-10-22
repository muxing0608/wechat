<?php

/*
 * This file is part of the muxing0608/wechat.
 *
 * (c) hang <chenhang@16pinpin.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\OpenPlatform\Authorizer\MiniProgram\QrcodeJump;

use EasyWeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author hangchen <chenhang@16pinpin.com>
 */
class Client extends BaseClient
{
    /**
     * 设置小程序“扫普通链接二维码打开小程序”能力
     *
     * @param string $prefix
     * @param string $permitSubRule
     * @param string $path
     * @param string $openVersion
     * @param string $debugUrl
     * @param int $isEdit
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function add(string $prefix, string $permitSubRule, string $path, string $openVersion, string $debugUrl, int $isEdit)
    {
        return $this->httpPostJson('cgi-bin/wxopen/qrcodejumpadd', [
            'prefix'          => $prefix,
            'permit_sub_rule' => $permitSubRule,
            'path'            => $openVersion,
            'open_version'    => $openVersion,
            'debug_url'       => $debugUrl,
            'is_edit'         => $isEdit,
        ]);
    }

    /**
     * 获取已设置的二维码规则
     *
     * @param string|null $path
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(string $path = null)
    {
        return $this->httpPostJson('cgi-bin/wxopen/qrcodejumpget', []);
    }

    /**
     * 获取校验文件名称及内容
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function download()
    {
        return $this->httpPostJson('cgi-bin/wxopen/qrcodejumpdownload', []);
    }

    /**
     * 发布已设置的二维码规则
     *
     * @param string $prefix
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function publish(string $prefix)
    {
        return $this->httpPostJson('cgi-bin/wxopen/qrcodejumppublish', [
            'prefix' => $prefix,
        ]);
    }
}
