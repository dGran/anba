<?php

declare(strict_types=1);

namespace App\Enum;

class TableOptions
{
    public const NAME_IS_SHOW_TABLE_IMAGES = 'isShowTableImages';

    public const NAME_IS_SHOW_STRIPED = 'isShowStriped';

    public const NAME_IS_FIXED_FIRST_COLUMN = 'isFixedFirstColumn';

    public const NAME_IS_SHOW_TYPE_COLUMN = 'isShowTypeColumn';

    public const NAME_IS_SHOW_TABLE_COLUMN = 'isShowTableColumn';

    public const NAME_IS_SHOW_USER_COLUMN = 'isShowUserColumn';

    public const NAME_IS_SHOW_DATE_COLUMN = 'isShowDateColumn';

    public const NAME_CURRENT_MODAL = 'currentModal';

    public const NAME_SELECTED_IDS = 'selectedIds';

    public const NAME_IS_CHECK_ALL_SELECTOR = 'isCheckAllSelector';

    public const COLUMN_OPTION_NAMES = [
        self::NAME_IS_SHOW_TYPE_COLUMN,
        self::NAME_IS_SHOW_TABLE_COLUMN,
        self::NAME_IS_SHOW_USER_COLUMN,
        self::NAME_IS_SHOW_DATE_COLUMN,
    ];
}
