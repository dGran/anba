<?php

declare(strict_types=1);

namespace App\Enum;

class TableOptions
{
    public const NAME_SHOW_TABLE_IMAGES = 'showTableImages';

    public const NAME_SHOW_STRIPED = 'showStriped';

    public const NAME_FIXED_FIRST_COLUMN = 'fixedFirstColumn';

    public const NAME_SHOW_TYPE_COLUMN = 'showTypeColumn';

    public const NAME_SHOW_TABLE_COLUMN = 'showTableColumn';

    public const NAME_SHOW_USER_COLUMN = 'showUserColumn';

    public const NAME_SHOW_DATE_COLUMN = 'showDateColumn';

    public const NAME_CURRENT_MODAL = 'currentModal';

    public const NAME_SELECTED_IDS = 'selectedIds';

    public const NAME_CHECK_ALL_SELECTOR = 'isCheckAllSelector';

    public const COLUMN_OPTION_NAMES = [
        self::NAME_SHOW_TYPE_COLUMN,
        self::NAME_SHOW_TABLE_COLUMN,
        self::NAME_SHOW_USER_COLUMN,
        self::NAME_SHOW_DATE_COLUMN,
    ];
}
