<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts\Tests;

use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;

class MockOfficialAccount implements OfficialAccountInterface
{
    public function __construct(
        private ?string $appId = null,
    ) {
    }

    public function getAppId(): ?string
    {
        return $this->appId;
    }
}
