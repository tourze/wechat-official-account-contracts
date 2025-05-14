<?php

namespace Tourze\WechatOfficialAccountUserContracts\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\WechatOfficialAccountUserContracts\Tests\Mock\MockUser;

/**
 * UserInterface 接口的测试类
 */
class UserInterfaceTest extends TestCase
{
    /**
     * 测试正常的 OpenID 获取
     */
    public function testGetOpenId_withValidData(): void
    {
        $openId = 'oABCD1234567890';
        $user = new MockUser($openId);
        
        $this->assertSame($openId, $user->getOpenId());
        $this->assertIsString($user->getOpenId());
    }
    
    /**
     * 测试特殊字符的 OpenID 获取
     */
    public function testGetOpenId_withSpecialCharacters(): void
    {
        $openId = 'oABCD-_1234@#$%';
        $user = new MockUser($openId);
        
        $this->assertSame($openId, $user->getOpenId());
    }
    
    /**
     * 测试正常的 UnionID 获取
     */
    public function testGetUnionId_withValidData(): void
    {
        $unionId = 'uABCD1234567890';
        $user = new MockUser('openid123', $unionId);
        
        $this->assertSame($unionId, $user->getUnionId());
        $this->assertIsString($user->getUnionId());
    }
    
    /**
     * 测试 UnionID 为 null 的情况
     */
    public function testGetUnionId_withNullData(): void
    {
        $user = new MockUser('openid123', null);
        
        $this->assertNull($user->getUnionId());
    }
    
    /**
     * 测试特殊字符的 UnionID 获取
     */
    public function testGetUnionId_withSpecialCharacters(): void
    {
        $unionId = 'uABCD-_1234@#$%';
        $user = new MockUser('openid123', $unionId);
        
        $this->assertSame($unionId, $user->getUnionId());
    }
    
    /**
     * 测试正常的头像 URL 获取
     */
    public function testGetAvatarUrl_withValidData(): void
    {
        $avatarUrl = 'https://example.com/avatar.jpg';
        $user = new MockUser('openid123', 'unionid123', $avatarUrl);
        
        $this->assertSame($avatarUrl, $user->getAvatarUrl());
        $this->assertIsString($user->getAvatarUrl());
    }
    
    /**
     * 测试头像 URL 为 null 的情况
     */
    public function testGetAvatarUrl_withNullData(): void
    {
        $user = new MockUser('openid123', 'unionid123', null);
        
        $this->assertNull($user->getAvatarUrl());
    }
    
    /**
     * 测试构造函数参数顺序的正确性
     */
    public function testConstructor_parameterOrder(): void
    {
        $openId = 'openid123';
        $unionId = 'unionid123';
        $avatarUrl = 'https://example.com/avatar.jpg';
        
        $user = new MockUser($openId, $unionId, $avatarUrl);
        
        $this->assertSame($openId, $user->getOpenId());
        $this->assertSame($unionId, $user->getUnionId());
        $this->assertSame($avatarUrl, $user->getAvatarUrl());
    }
} 