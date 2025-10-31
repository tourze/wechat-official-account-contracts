# WeChat Official Account Contracts

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen)](https://github.com/tourze/php-monorepo)
[![Code Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen)](https://github.com/tourze/php-monorepo)

[English](README.md) | [中文](README.zh-CN.md)

WeChat Official Account contracts and interfaces for PHP applications.

## Installation

```bash
composer require tourze/wechat-official-account-contracts
```

## Quick Start

This package provides essential interfaces for WeChat Official Account integration:

```php
<?php

use Tourze\WechatOfficialAccountContracts\UserInterface;
use Tourze\WechatOfficialAccountContracts\UserLoaderInterface;
use Tourze\WechatOfficialAccountContracts\OfficialAccountInterface;

// Implement user interface
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

// Implement user loader interface
class MyUserLoader implements UserLoaderInterface
{
    public function loadUserByOpenId(string $openId): ?UserInterface
    {
        // Load user by OpenID
        return new MyUser();
    }

    public function loadUserByUnionId(string $unionId): ?UserInterface
    {
        // Load user by UnionID
        return new MyUser();
    }

    public function syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId): ?UserInterface
    {
        // Sync user data from WeChat API
        return new MyUser();
    }
}
```

## Interfaces

### UserInterface

Represents a WeChat user with the following methods:

- `getOpenId()`: Get user's OpenID
- `getUnionId()`: Get user's UnionID (optional)
- `getAvatarUrl()`: Get user's avatar URL (optional)
- `getOfficialAccount()`: Get associated official account (optional)

### UserLoaderInterface

Provides methods to load and sync WeChat users:

- `loadUserByOpenId(string $openId)`: Load user by OpenID
- `loadUserByUnionId(string $unionId)`: Load user by UnionID
- `syncUserByOpenId(OfficialAccountInterface $officialAccount, string $openId)`: Sync user data

### OfficialAccountInterface

Represents a WeChat Official Account:

- `getAppId()`: Get the App ID of the official account (optional)

## License

MIT License. See [LICENSE](LICENSE) for details.