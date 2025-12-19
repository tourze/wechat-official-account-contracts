<?php

declare(strict_types=1);

namespace Tourze\WechatOfficialAccountContracts\Mock;

use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;
use Tourze\WechatOfficialAccountContracts\UserInterface;
use Tourze\WechatOfficialAccountContracts\UserLoaderInterface;

/**
 * Mock 实现用于测试 UserLoaderInterface
 *
 * @internal 内部测试辅助类，被 UserLoaderInterfaceTest 和 UserInterfaceIntegrationTest 间接覆盖
 */
class MockUserLoader implements UserLoaderInterface
{
    /**
     * @var array<string, UserInterface>
     */
    private array $usersByOpenId = [];

    /**
     * @var array<string, UserInterface>
     */
    private array $usersByUnionId = [];

    public function addUser(UserInterface $user): self
    {
        $this->usersByOpenId[$user->getOpenId()] = $user;

        if (null !== $user->getUnionId()) {
            $this->usersByUnionId[$user->getUnionId()] = $user;
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

    public function syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId): ?UserInterface
    {
        return $this->loadUserByOpenId($openId);
    }
}
