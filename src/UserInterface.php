<?php

namespace Tourze\WechatOfficialAccountContracts;

interface UserInterface
{
    public function getOpenId(): string;

    public function getUnionId(): ?string;

    public function getAvatarUrl(): ?string;

    /**
     * 关联公众号
     */
    public function getOfficialAccount(): ?OfficialAccountInterface;
}
