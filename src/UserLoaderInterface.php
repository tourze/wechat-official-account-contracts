<?php

namespace Tourze\WechatOfficialAccountContracts;

interface UserLoaderInterface
{
    /**
     * 根据OpenID读取用户
     */
    public function loadUserByOpenId(string $openId): ?UserInterface;

    /**
     * 根据UnionID读取用户
     */
    public function loadUserByUnionId(string $unionId): ?UserInterface;

    /**
     * 同步公众号OpenID信息
     */
    public function syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId): ?UserInterface;
}
