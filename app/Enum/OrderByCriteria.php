<?php

declare(strict_types=1);

namespace App\Enum;

class OrderByCriteria
{
    public const ORDER_BY_ID = 'id';

    public const ORDER_BY_ID_DESC = 'id_desc';

    public const ORDER_BY_NAME = 'name';

    public const ORDER_BY_NAME_DESC = 'name_desc';

    public const ORDER_BY_TYPE = 'type';

    public const ORDER_BY_TYPE_DESC = 'type_desc';

    public const ORDER_BY_TABLE = 'table';

    public const ORDER_BY_TABLE_DESC = 'table_desc';

    public const ORDER_BY_USER = 'user';

    public const ORDER_BY_USER_DESC = 'user_desc';

    public const ORDER_BY_DATE = 'date';

    public const ORDER_BY_DATE_DESC = 'date_desc';

    public const ORDER_ASC = 'asc';

    public const ORDER_DESC = 'desc';

    public const CRITERIA_COLUMN = 'column';

    public const CRITERIA_ORDER = 'order';

    public const CRITERIA_CAPTION = 'caption';
}
