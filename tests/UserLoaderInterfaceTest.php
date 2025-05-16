<?php

namespace Tourze\WechatOfficialAccountContracts\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\WechatOfficialAccountContracts\Tests\Mock\MockUser;
use Tourze\WechatOfficialAccountContracts\Tests\Mock\MockUserLoader;
use Tourze\WechatOfficialAccountContracts\UserInterface;

/**
 * UserLoaderInterface 接口的测试类
 */
class UserLoaderInterfaceTest extends TestCase
{
    /**
     * 测试通过有效的 OpenID 加载用户
     */
    public function testLoadUserByOpenId_withValidOpenId(): void
    {
        $openId = 'oABCD1234567890';
        $user = new MockUser($openId, 'unionid123');
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByOpenId($openId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }
    
    /**
     * 测试通过不存在的 OpenID 加载用户
     */
    public function testLoadUserByOpenId_withNonExistentOpenId(): void
    {
        $loader = new MockUserLoader();
        $loader->addUser(new MockUser('openid123', 'unionid123'));
        
        $loadedUser = $loader->loadUserByOpenId('non_existent_openid');
        
        $this->assertNull($loadedUser);
    }
    
    /**
     * 测试通过特殊字符的 OpenID 加载用户
     */
    public function testLoadUserByOpenId_withSpecialCharacters(): void
    {
        $openId = 'oABCD-_1234@#$%';
        $user = new MockUser($openId);
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByOpenId($openId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }
    
    /**
     * 测试通过空 OpenID 加载用户
     */
    public function testLoadUserByOpenId_withEmptyOpenId(): void
    {
        $openId = '';
        $user = new MockUser($openId);
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByOpenId($openId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($openId, $loadedUser->getOpenId());
    }
    
    /**
     * 测试通过有效的 UnionID 加载用户
     */
    public function testLoadUserByUnionId_withValidUnionId(): void
    {
        $unionId = 'uABCD1234567890';
        $user = new MockUser('openid123', $unionId);
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByUnionId($unionId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }
    
    /**
     * 测试通过不存在的 UnionID 加载用户
     */
    public function testLoadUserByUnionId_withNonExistentUnionId(): void
    {
        $loader = new MockUserLoader();
        $loader->addUser(new MockUser('openid123', 'unionid123'));
        
        $loadedUser = $loader->loadUserByUnionId('non_existent_unionid');
        
        $this->assertNull($loadedUser);
    }
    
    /**
     * 测试通过特殊字符的 UnionID 加载用户
     */
    public function testLoadUserByUnionId_withSpecialCharacters(): void
    {
        $unionId = 'uABCD-_1234@#$%';
        $user = new MockUser('openid123', $unionId);
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByUnionId($unionId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }
    
    /**
     * 测试通过空 UnionID 加载用户
     */
    public function testLoadUserByUnionId_withEmptyUnionId(): void
    {
        $unionId = '';
        $user = new MockUser('openid123', $unionId);
        
        $loader = new MockUserLoader();
        $loader->addUser($user);
        
        $loadedUser = $loader->loadUserByUnionId($unionId);
        
        $this->assertInstanceOf(UserInterface::class, $loadedUser);
        $this->assertSame($unionId, $loadedUser->getUnionId());
    }
    
    /**
     * 测试多个用户加载情况
     */
    public function testLoading_multipleUsers(): void
    {
        $user1 = new MockUser('openid1', 'unionid1');
        $user2 = new MockUser('openid2', 'unionid2');
        $user3 = new MockUser('openid3', 'unionid3');
        
        $loader = new MockUserLoader();
        $loader->addUser($user1)
               ->addUser($user2)
               ->addUser($user3);
        
        $this->assertSame($user1, $loader->loadUserByOpenId('openid1'));
        $this->assertSame($user2, $loader->loadUserByOpenId('openid2'));
        $this->assertSame($user3, $loader->loadUserByOpenId('openid3'));
        
        $this->assertSame($user1, $loader->loadUserByUnionId('unionid1'));
        $this->assertSame($user2, $loader->loadUserByUnionId('unionid2'));
        $this->assertSame($user3, $loader->loadUserByUnionId('unionid3'));
    }
} 