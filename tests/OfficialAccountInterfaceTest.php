<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;
use Tourze\WechatOfficialAccountContracts\Tests\MockOfficialAccount;

/**
 * OfficialAccountInterface 接口的测试类
 *
 * @internal
 */
#[CoversClass(OfficialAccountInterface::class)]
final class OfficialAccountInterfaceTest extends TestCase
{
    /**
     * 测试正常的 AppId 获取
     */
    public function testGetAppIdWithValidData(): void
    {
        $appId = 'wx1234567890abcdef';
        $officialAccount = new MockOfficialAccount($appId);

        $this->assertSame($appId, $officialAccount->getAppId());
        $this->assertIsString($officialAccount->getAppId());
    }

    /**
     * 测试 AppId 为 null 的情况
     */
    public function testGetAppIdWithNullData(): void
    {
        $officialAccount = new MockOfficialAccount(null);

        $this->assertNull($officialAccount->getAppId());
    }

    /**
     * 测试特殊字符的 AppId 获取
     */
    public function testGetAppIdWithSpecialCharacters(): void
    {
        $appId = 'wx1234-_567890@#$%';
        $officialAccount = new MockOfficialAccount($appId);

        $this->assertSame($appId, $officialAccount->getAppId());
    }

    /**
     * 测试空字符串的 AppId 获取
     */
    public function testGetAppIdWithEmptyString(): void
    {
        $appId = '';
        $officialAccount = new MockOfficialAccount($appId);

        $this->assertSame($appId, $officialAccount->getAppId());
        $this->assertIsString($officialAccount->getAppId());
    }
}
