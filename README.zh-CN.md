# WeChat Official Account Contracts

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen)](https://github.com/tourze/php-monorepo)
[![Code Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen)](https://github.com/tourze/php-monorepo)

[English](README.md) | [中文](README.zh-CN.md)

微信公众号用户接口定义和合约规范

## 安装

```bash
composer require tourze/wechat-official-account-contracts
```

## 快速开始

该包提供了微信公众号集成所需的基本接口：

```php
<?php

use Tourze\WechatOfficialAccountContracts\UserInterface;
use Tourze\WechatOfficialAccountContracts\UserLoaderInterface;
use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;

// 实现用户接口
class MyUser implements UserInterface
{
    public function getOpenId(): string
    {
        return 'user_open_id';
    }

    public function getUnionId(): ?string
    {
        return 'user_union_id';
    }

    public function getAvatarUrl(): ?string
    {
        return 'https://example.com/avatar.jpg';
    }

    public function getOfficialAccount(): ?OfficialAccountInterface
    {
        return new MyOfficialAccount();
    }
}

// 实现用户加载器接口
class MyUserLoader implements UserLoaderInterface
{
    public function loadUserByOpenId(string $openId): ?UserInterface
    {
        // 根据 OpenID 加载用户
        return new MyUser();
    }

    public function loadUserByUnionId(string $unionId): ?UserInterface
    {
        // 根据 UnionID 加载用户
        return new MyUser();
    }

    public function syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId): ?UserInterface
    {
        // 从微信 API 同步用户数据
        return new MyUser();
    }
}
```

## 接口说明

### UserInterface

表示微信用户的接口，包含以下方法：

- `getOpenId()`: 获取用户的 OpenID
- `getUnionId()`: 获取用户的 UnionID（可选）
- `getAvatarUrl()`: 获取用户头像URL（可选）
- `getOfficialAccount()`: 获取关联的公众号（可选）

### UserLoaderInterface

提供加载和同步微信用户的方法：

- `loadUserByOpenId(string $openId)`: 根据 OpenID 加载用户
- `loadUserByUnionId(string $unionId)`: 根据 UnionID 加载用户
- `syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId)`: 同步用户数据

### OfficialAccountInterface

表示微信公众号的接口：

- `getAppId()`: 获取公众号的 App ID（可选）

## 许可证

MIT 许可证。详情请查看 [LICENSE](LICENSE) 文件。
