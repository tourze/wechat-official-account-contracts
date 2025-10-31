<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts;

interface OfficialAccountInterface
{
    public function getAppId(): ?string;
}
