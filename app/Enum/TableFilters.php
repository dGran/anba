<?php

declare(strict_types=1);

namespace App\Enum;

class TableFilters
{
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

    public const PER_PAGE_DEFAULT_VALUE = 5;

    public const PAGE_DEFAULT_VALUE = 1;
}
