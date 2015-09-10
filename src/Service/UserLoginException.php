<?php
namespace pdt256\truecar\Service;

class UserLoginException extends \Exception
{
    const USER_NOT_FOUND = 0;
    const INVALID_PASSWORD = 1;

    public static function userNotFound()
    {
        return new UserLoginException('User not found', static::USER_NOT_FOUND);
    }

    public static function invalidPassword()
    {
        return new UserLoginException('User password not valid', static::INVALID_PASSWORD);
    }
}
