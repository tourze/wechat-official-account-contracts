<?php

namespace Tourze\WechatOfficialAccountUserContracts\Tests\Mock;

use Tourze\WechatOfficialAccountUserContracts\UserInterface;
use Tourze\WechatOfficialAccountUserContracts\UserLoaderInterface;

/**
 * UserLoaderInterface 的模拟实现，用于测试
 */
class MockUserLoader implements UserLoaderInterface
{
    /**
     * @var array<string, UserInterface> 通过 OpenID 索引的用户数据
     */
    private array $usersByOpenId = [];

    /**
     * @var array<string, UserInterface> 通过 UnionID 索引的用户数据
     */
    private array $usersByUnionId = [];

    /**
     * 添加一个用户到加载器
     */
    public function addUser(UserInterface $user): self
    {
        $this->usersByOpenId[$user->getOpenId()] = $user;
        
        $unionId = $user->getUnionId();
        if ($unionId !== null) {
            $this->usersByUnionId[$unionId] = $user;
        }
        
        return $this;
    }

    public function loadUserByOpenId(string $openId): ?UserInterface
    {
        return $this->usersByOpenId[$openId] ?? null;
    }

    public function loadUserByUnionId(string $unionId): ?UserInterface
    {
        return $this->usersByUnionId[$unionId] ?? null;
    }
} 