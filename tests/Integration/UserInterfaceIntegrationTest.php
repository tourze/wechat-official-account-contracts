<?php

namespace Tourze\WechatOfficialAccountUserContracts\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Tourze\WechatOfficialAccountUserContracts\Tests\Mock\MockUser;
use Tourze\WechatOfficialAccountUserContracts\Tests\Mock\MockUserLoader;

/**
 * UserInterface 和 UserLoaderInterface 集成测试
 */
class UserInterfaceIntegrationTest extends TestCase
{
    /**
     * 测试通过 OpenID 加载用户，然后获取其他属性
     */
    public function testLoadAndAccess_viaOpenId(): void
    {
        $openId = 'oABCD1234567890';
        $unionId = 'uABCD1234567890';
        $avatarUrl = 'https://example.com/avatar.jpg';
        
        $originalUser = new MockUser($openId, $unionId, $avatarUrl);
        $loader = new MockUserLoader();
        $loader->addUser($originalUser);
        
        // 通过 OpenID 加载用户
        $loadedUser = $loader->loadUserByOpenId($openId);
        
        $this->assertNotNull($loadedUser);
        
        // 测试加载的用户信息是否与原始信息一致
        $this->assertSame($openId, $loadedUser->getOpenId());
        $this->assertSame($unionId, $loadedUser->getUnionId());
        $this->assertSame($avatarUrl, $loadedUser->getAvatarUrl());
    }
    
    /**
     * 测试通过 UnionID 加载用户，然后获取其他属性
     */
    public function testLoadAndAccess_viaUnionId(): void
    {
        $openId = 'oABCD1234567890';
        $unionId = 'uABCD1234567890';
        $avatarUrl = 'https://example.com/avatar.jpg';
        
        $originalUser = new MockUser($openId, $unionId, $avatarUrl);
        $loader = new MockUserLoader();
        $loader->addUser($originalUser);
        
        // 通过 UnionID 加载用户
        $loadedUser = $loader->loadUserByUnionId($unionId);
        
        $this->assertNotNull($loadedUser);
        
        // 测试加载的用户信息是否与原始信息一致
        $this->assertSame($openId, $loadedUser->getOpenId());
        $this->assertSame($unionId, $loadedUser->getUnionId());
        $this->assertSame($avatarUrl, $loadedUser->getAvatarUrl());
    }
    
    /**
     * 测试用户缺失 UnionID 的情况，只能通过 OpenID 加载
     */
    public function testLoadAndAccess_withoutUnionId(): void
    {
        $openId = 'oABCD1234567890';
        $avatarUrl = 'https://example.com/avatar.jpg';
        
        $originalUser = new MockUser($openId, null, $avatarUrl);
        $loader = new MockUserLoader();
        $loader->addUser($originalUser);
        
        // 通过 OpenID 加载用户应该成功
        $loadedUser = $loader->loadUserByOpenId($openId);
        $this->assertNotNull($loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
        $this->assertNull($loadedUser->getUnionId());
        $this->assertSame($avatarUrl, $loadedUser->getAvatarUrl());
        
        // 尝试通过任意 UnionID 加载应该返回 null，因为用户没有 UnionID
        $this->assertNull($loader->loadUserByUnionId('any_union_id'));
    }
    
    /**
     * 测试多个用户的加载场景
     */
    public function testMultipleUsers_loadingScenarios(): void
    {
        $user1 = new MockUser('openid1', 'unionid1', 'avatar1');
        $user2 = new MockUser('openid2', 'unionid2', 'avatar2');
        // 用户3只有 OpenID，没有 UnionID
        $user3 = new MockUser('openid3', null, 'avatar3');
        
        $loader = new MockUserLoader();
        $loader->addUser($user1)
               ->addUser($user2)
               ->addUser($user3);
        
        // 测试通过 OpenID 加载不同用户
        $this->assertSame($user1, $loader->loadUserByOpenId('openid1'));
        $this->assertSame($user2, $loader->loadUserByOpenId('openid2'));
        $this->assertSame($user3, $loader->loadUserByOpenId('openid3'));
        
        // 测试通过 UnionID 加载不同用户
        $this->assertSame($user1, $loader->loadUserByUnionId('unionid1'));
        $this->assertSame($user2, $loader->loadUserByUnionId('unionid2'));
        
        // 测试加载属性
        $loadedUser1 = $loader->loadUserByOpenId('openid1');
        $this->assertSame('unionid1', $loadedUser1->getUnionId());
        $this->assertSame('avatar1', $loadedUser1->getAvatarUrl());
        
        $loadedUser3 = $loader->loadUserByOpenId('openid3');
        $this->assertNull($loadedUser3->getUnionId());
        $this->assertSame('avatar3', $loadedUser3->getAvatarUrl());
    }
} 