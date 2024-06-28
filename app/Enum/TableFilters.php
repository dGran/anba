<?php

declare(strict_types=1);

namespace App\Enum;

class TableFilters
{
    public const PER_PAGE_DESCRIPTIONS_INDEXED_BY_VALUE = [
        5 => '5 por página',
        10 => '10 por página',
        15 => '15 por página',
        25 => '25 por página',
        50 => '50 por página',
        100 => '100 por página',
    ];

    public const NAME_SEARCH = 'search';

    public const NAME_TYPE = 'type';

    public const NAME_USER = 'user';

    public const NAME_USER_NAME = 'userName';

    public const NAME_TABLE = 'table';

    public const NAME_PAGE = 'page';

    public const NAME_PER_PAGE = 'perPage';

    public const NAME_ORDER_BY = 'orderBy';

    public const NAME_ORDER_BY_COLUMN = 'orderByColumn';

    public const NAME_ORDER_BY_ORDER = 'orderByOrder';

    public const VALUE_NULL = null;

    public const VALUE_NULL_STRING = '';

    public const VALUE_ALL = 'all';

    public const VALUE_EMPTY_ARRAY = [];

    public const PER_PAGE_DEFAULT_VALUE = 25;

    public const PAGE_DEFAULT_VALUE = 1;
}
