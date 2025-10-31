<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts;

interface UserInterface
{
    public function getId(): mixed;

    public function getOpenId(): string;

    public function getUnionId(): ?string;

    public function getAvatarUrl(): ?string;

    /**
     * 关联公众号
     */
    public function getOfficialAccount(): ?OfficialAccountInterface;
}
