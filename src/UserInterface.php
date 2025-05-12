<?php

namespace Tourze\WechatOfficialAccountUserContracts;

interface UserInterface
{
    public function getOpenId(): string;

    public function getUnionId(): ?string;

    public function getAvatarUrl(): ?string;
}
