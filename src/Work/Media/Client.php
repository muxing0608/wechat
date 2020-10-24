<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Work\Media;

use EasyWeChat\Kernel\BaseClient;
use EasyWeChat\Kernel\Http\StreamResponse;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get media.
     *
     * @param string $mediaId
     *
     * @return array|\EasyWeChat\Kernel\Http\Response|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $mediaId)
    {
        $response = $this->requestRaw('cgi-bin/media/get', 'GET', [
            'query' => [
                'media_id' => $mediaId,
            ],
        ]);

        if (false !== stripos($response->getHeaderLine('Content-Type'), 'text/plain')) {
            return $this->castResponseToType($response, $this->app['config']->get('response_type'));
        }

        return StreamResponse::buildFromPsrResponse($response);
    }

    /**
     * Upload Image.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function uploadImage(string $path)
    {
        return $this->upload('image', $path);
    }

    /**
     * Upload Voice.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function uploadVoice(string $path)
    {
        return $this->upload('voice', $path);
    }

    /**
     * Upload Video.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function uploadVideo(string $path)
    {
        return $this->upload('video', $path);
    }

    /**
     * Upload File.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function uploadFile(string $path)
    {
        return $this->upload('file', $path);
    }

    /**
     * Upload media.
     *
     * @param string $type
     * @param string $path
     *
     * @return mixed
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(string $type, string $path)
    {
        $files = [
            'media' => $path,
        ];

        return $this->httpUpload('cgi-bin/media/upload', $files, [], compact('type'));
    }

    /**
     * 上传图片
     * 上传图片得到图片URL，该URL永久有效。
     * 返回的图片URL，仅能用于图文消息（mpnews）正文中的图片展示；若用于非企业微信域名下的页面，图片将被屏蔽。
     * 每个企业每天最多可上传100张图片。
     * 图片文件大小应在 5B ~ 2MB 之间。
     * @link https://open.work.weixin.qq.com/api/doc/90000/90135/90256
     * @param string $path
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function uploadForeverImage(string $path)
    {
        $files = [
            'media' => $path,
        ];

        return $this->httpUpload('cgi-bin/media/uploadimg', $files);
    }
}
