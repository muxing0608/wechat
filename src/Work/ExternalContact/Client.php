<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Work\ExternalContact;

use EasyWeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * 获取配置了客户联系功能的成员列表.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91554
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getFollowUsers()
    {
        return $this->httpGet('cgi-bin/externalcontact/get_follow_user_list');
    }

    /**
     * 获取外部联系人列表.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91555
     *
     * @param string $userId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function list(string $userId)
    {
        return $this->httpGet('cgi-bin/externalcontact/list', [
            'userid' => $userId,
        ]);
    }

    /**
     * 获取外部联系人详情.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91556
     *
     * @param string $externalUserId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(string $externalUserId)
    {
        return $this->httpGet('cgi-bin/externalcontact/get', [
            'external_userid' => $externalUserId,
        ]);
    }

    /**
     * 获取离职成员的客户列表.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91563
     *
     * @param int $pageId
     * @param int $pageSize
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUnassigned(int $pageId = 0, int $pageSize = 1000)
    {
        return $this->httpPostJson('cgi-bin/externalcontact/get_unassigned_list', [
            'page_id' => $pageId,
            'page_size' => $pageSize,
        ]);
    }

    /**
     * 离职成员的外部联系人再分配.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91564
     *
     * @param string $externalUserId
     * @param string $handoverUserId
     * @param string $takeoverUserId
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transfer(string $externalUserId, string $handoverUserId, string $takeoverUserId)
    {
        $params = [
            'external_userid' => $externalUserId,
            'handover_userid' => $handoverUserId,
            'takeover_userid' => $takeoverUserId,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/transfer', $params);
    }

    /**
     * 获取企业标签库.
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92117
     *
     * @param array $tag_id
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function tag_list(array $tag_id = [])
    {
        $params = [
            'tag_id' => $tag_id,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/get_corp_tag_list', $params);
    }

    /**
     * 添加企业客户标签.
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92117#添加企业客户标签
     *
     * @param array $params
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function addCorpTag(array $params)
    {
        return $this->httpPostJson('cgi-bin/externalcontact/add_corp_tag', $params);
    }

    /**
     * 编辑客户企业标签.
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92118
     *
     * @param string $userid
     * @param string $external_userid
     * @param array $add_tag
     * @param array $remove_tag
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function mark_tag(string $userid, string $external_userid, array $add_tag, array $remove_tag)
    {
        $params = [
            'userid' => $userid,
            'external_userid' => $external_userid,
            'add_tag' => $add_tag,
            'remove_tag' => $remove_tag,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/mark_tag', $params);
    }

    /**
     * 修改客户备注信息.
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92118
     *
     * @param string $userid
     * @param string $external_userid
     * @param string $remark
     * @param string $description
     * @param string $remark_company
     * @param array $remark_mobiles
     * @param string $remark_pic_mediaid
     *
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function remark(string $userid, string $external_userid, string $remark, string $description, string $remark_company, array $remark_mobiles, string $remark_pic_mediaid = '')
    {
        $params = [
            'userid' => $userid,
            'external_userid' => $external_userid,
            'remark' => $remark,
            'description' => $description,
            'remark_company' => $remark_company,
            'remark_mobiles' => $remark_mobiles,
            'remark_pic_mediaid' => $remark_pic_mediaid,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/remark', $params);
    }

    /**
     * 获取客服群列表
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92120
     *
     * @param int $status_filter
     * @param array $user_list
     * @param array $part_list
     * @param int $offset
     * @param int $limit
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGroupChatList(int $status_filter=0,int $offset=0,int $limit=100 ,array $user_list=[],array $part_list=[]){
        $params = [
            "status_filter"=>$status_filter,
            "owner_filter"=>[
                "userid_list"=> $user_list,
                "partyid_list"=>$part_list,
            ],
            "offset"=>$offset,
            "limit"=>$limit
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/groupchat/list', $params);
    }


    /**
     * 获取客户群详情
     *
     * @see https://work.weixin.qq.com/api/doc/90000/90135/92122
     *
     * @param string $chatId
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGroupChatDetail(string $chatId){
        $params=[
            'chat_id'=>$chatId,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/groupchat/get', $params);
    }
}
