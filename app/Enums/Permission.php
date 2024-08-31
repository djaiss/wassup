<?php

declare(strict_types=1);

namespace App\Enums;

enum Permission: string
{
    case Administrator = 'administrator';
    case Member = 'member';

    public static function toArray(): array
    {
        return [
            self::Administrator->value => trans('Administrator'),
            self::Member->value => trans('Member'),
        ];
    }
}
