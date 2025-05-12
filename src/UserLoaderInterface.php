<?php

namespace Tourze\WechatOfficialAccountUserContracts;

interface UserLoaderInterface
{
    public function loadUserByOpenId(string $openId): ?UserInterface;

    public function loadUserByUnionId(string $unionId): ?UserInterface;
}
