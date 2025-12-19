<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\WechatOfficialAccountContracts\Mock\MockUserLoader;
use Tourze\WechatOfficialAccountContracts\UserInterface;
use Tourze\WechatOfficialAccountContracts\UserLoaderInterface;

/**
 * UserLoaderInterface 接口的测试类
 *
 * @internal
 */
#[CoversClass(UserLoaderInterface::class)]
final class UserLoaderInterfaceTest extends TestCase
{
    /**
     * 测试通过有效的 OpenID 加载用户
     */
    public function testLoadUserByOpenIdWithValidOpenId(): void
    {
        $openId = 'oABCD1234567890';
        $user = new MockUser(null, $openId, 'unionid123');

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByOpenId($openId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }

    /**
     * 测试通过不存在的 OpenID 加载用户
     */
    public function testLoadUserByOpenIdWithNonExistentOpenId(): void
    {
        $loader = new MockUserLoader();
        $loader->addUser(new MockUser(null, 'openid123', 'unionid123'));

        $loadedUser = $loader->loadUserByOpenId('non_existent_openid');

        $this->assertNull($loadedUser);
    }

    /**
     * 测试通过特殊字符的 OpenID 加载用户
     */
    public function testLoadUserByOpenIdWithSpecialCharacters(): void
    {
        $openId = 'oABCD-_1234@#$%';
        $user = new MockUser(null, $openId);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByOpenId($openId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }

    /**
     * 测试通过空 OpenID 加载用户
     */
    public function testLoadUserByOpenIdWithEmptyOpenId(): void
    {
        $openId = '';
        $user = new MockUser(null, $openId);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByOpenId($openId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }

    /**
     * 测试通过有效的 UnionID 加载用户
     */
    public function testLoadUserByUnionIdWithValidUnionId(): void
    {
        $unionId = 'uABCD1234567890';
        $user = new MockUser(null, 'openid123', $unionId);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByUnionId($unionId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }

    /**
     * 测试通过不存在的 UnionID 加载用户
     */
    public function testLoadUserByUnionIdWithNonExistentUnionId(): void
    {
        $loader = new MockUserLoader();
        $loader->addUser(new MockUser(null, 'openid123', 'unionid123'));

        $loadedUser = $loader->loadUserByUnionId('non_existent_unionid');

        $this->assertNull($loadedUser);
    }

    /**
     * 测试通过特殊字符的 UnionID 加载用户
     */
    public function testLoadUserByUnionIdWithSpecialCharacters(): void
    {
        $unionId = 'uABCD-_1234@#$%';
        $user = new MockUser(null, 'openid123', $unionId);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByUnionId($unionId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }

    /**
     * 测试通过空 UnionID 加载用户
     */
    public function testLoadUserByUnionIdWithEmptyUnionId(): void
    {
        $unionId = '';
        $user = new MockUser(null, 'openid123', $unionId);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $loadedUser = $loader->loadUserByUnionId($unionId);

        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }

    /**
     * 测试多个用户加载情况
     */
    public function testLoadingMultipleUsers(): void
    {
        $user1 = new MockUser(null, 'openid1', 'unionid1');
        $user2 = new MockUser(null, 'openid2', 'unionid2');
        $user3 = new MockUser(null, 'openid3', 'unionid3');

        $loader = new MockUserLoader();
        $loader->addUser($user1)
            ->addUser($user2)
            ->addUser($user3)
        ;

        $this->assertSame($user1, $loader->loadUserByOpenId('openid1'));
        $this->assertSame($user2, $loader->loadUserByOpenId('openid2'));
        $this->assertSame($user3, $loader->loadUserByOpenId('openid3'));

        $this->assertSame($user1, $loader->loadUserByUnionId('unionid1'));
        $this->assertSame($user2, $loader->loadUserByUnionId('unionid2'));
        $this->assertSame($user3, $loader->loadUserByUnionId('unionid3'));
    }

    /**
     * 测试通过公众号同步用户信息
     */
    public function testSyncUserByOpenIdWithValidData(): void
    {
        $openId = 'oABCD1234567890';
        $user = new MockUser(null, $openId, 'unionid123');
        $officialAccount = new MockOfficialAccount('wx1234567890abcdef');

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $syncedUser = $loader->syncUserByOpenId($officialAccount, $openId);

        $this->assertInstanceOf(UserInterface::class, $syncedUser);
        $this->assertSame($openId, $syncedUser->getOpenId());
        $this->assertSame($user, $syncedUser);
    }

    /**
     * 测试同步不存在的用户
     */
    public function testSyncUserByOpenIdWithNonExistentUser(): void
    {
        $officialAccount = new MockOfficialAccount('wx1234567890abcdef');
        $loader = new MockUserLoader();

        $syncedUser = $loader->syncUserByOpenId($officialAccount, 'non_existent_openid');

        $this->assertNull($syncedUser);
    }

    /**
     * 测试同步用户与公众号的关联
     */
    public function testSyncUserByOpenIdWithOfficialAccountIntegration(): void
    {
        $openId = 'oABCD1234567890';
        $appId = 'wx1234567890abcdef';
        $officialAccount = new MockOfficialAccount($appId);
        $user = new MockUser(null, $openId, 'unionid123', 'avatar.jpg', $officialAccount);

        $loader = new MockUserLoader();
        $loader->addUser($user);

        $syncedUser = $loader->syncUserByOpenId($officialAccount, $openId);

        $this->assertNotNull($syncedUser);
        $this->assertSame($user, $syncedUser);
        $this->assertSame($officialAccount, $syncedUser->getOfficialAccount());
        $this->assertSame($appId, $syncedUser->getOfficialAccount()->getAppId());
    }
}
