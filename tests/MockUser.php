<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts\Tests;

use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;
use Tourze\WechatOfficialAccountContracts\UserInterface;

class MockUser implements UserInterface
{
    public function __construct(
        private mixed $id = null,
        private string $openId = '',
        private ?string $unionId = null,
        private ?string $avatarUrl = null,
        private ?OfficialAccountInterface $officialAccount = null,
    ) {
    }

    public function getId(): mixed
    {
        return $this->id;
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
        return $this->officialAccount;
    }
}
