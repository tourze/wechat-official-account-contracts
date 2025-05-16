<?php

namespace Tourze\WechatOfficialAccountContracts\Tests\Mock;

use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;
use Tourze\WechatOfficialAccountContracts\UserInterface;

/**
 * UserInterface 的模拟实现，用于测试
 */
class MockUser implements UserInterface
{
    private string $openId;
    private ?string $unionId;
    private ?string $avatarUrl;

    public function __construct(
        string $openId,
        ?string $unionId = null,
        ?string $avatarUrl = null
    )
    {
        $this->openId = $openId;
        $this->unionId = $unionId;
        $this->avatarUrl = $avatarUrl;
    }

    public function getOpenId(): string
    {
        return $this->openId;
    }

    public function getUnionId(): ?string
    {
        return $this->unionId;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function getOfficialAccount(): ?OfficialAccountInterface
    {
        // TODO: Implement getOfficialAccount() method.
    }
}
