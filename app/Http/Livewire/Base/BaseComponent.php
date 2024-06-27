<?php

declare(strict_types=1);

namespace App\Http\Livewire\Base;

use App\Enum\EventNames;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Enum\TableInfo;
use App\Enum\TableNames;
use App\Enum\TableOptions;
use App\Models\AdminLog;
use Livewire\Component;
use Livewire\WithPagination;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BaseComponent extends Component
{
    use WithPagination;

    private const PROPERTY_INITIAL_VALUES = [
        TableFilters::NAME_SEARCH => TableFilters::VALUE_NULL_STRING,
        TableFilters::NAME_TYPE => TableFilters::VALUE_ALL,
        TableFilters::NAME_USER => TableFilters::VALUE_ALL,
        TableFilters::NAME_USER_NAME => TableFilters::VALUE_NULL_STRING,
        TableFilters::NAME_TABLE => TableFilters::VALUE_ALL,
        TableFilters::NAME_PAGE => TableFilters::PAGE_DEFAULT_VALUE,
        TableFilters::NAME_PER_PAGE => TableFilters::PER_PAGE_DEFAULT_VALUE,
        TableFilters::NAME_ORDER_BY => OrderByCriteria::ORDER_BY_ID_DESC,
        TableFilters::NAME_ORDER_BY_COLUMN => 'id',
        TableFilters::NAME_ORDER_BY_ORDER => OrderByCriteria::ORDER_DESC,
        TableOptions::NAME_IS_SHOW_TABLE_IMAGES => true,
        TableOptions::NAME_IS_SHOW_STRIPED => true,
        TableOptions::NAME_IS_FIXED_FIRST_COLUMN => false,
        TableOptions::NAME_IS_SHOW_TYPE_COLUMN => true,
        TableOptions::NAME_IS_SHOW_TABLE_COLUMN => true,
        TableOptions::NAME_IS_SHOW_USER_COLUMN => true,
        TableOptions::NAME_IS_SHOW_DATE_COLUMN => true,
        TableOptions::NAME_CURRENT_MODAL => TableFilters::VALUE_NULL_STRING,
        TableOptions::NAME_SELECTED_IDS => TableFilters::VALUE_EMPTY_ARRAY,
        TableOptions::NAME_IS_CHECK_ALL_SELECTOR => false,
    ];

    private const TABLE_INFO_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableInfo::SINGULAR => 'log',
            TableInfo::PLURAL => 'logs',
            TableInfo::GENDER => 'male',
            TableInfo::HAS_IMAGE => false,
            TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME => [
                OrderByCriteria::ORDER_BY_ID => [
                    OrderByCriteria::CRITERIA_COLUMN => 'id',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'ID',
                ],
                OrderByCriteria::ORDER_BY_ID_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'id',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'ID (desc)',
                ],
                OrderByCriteria::ORDER_BY_NAME => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.reg_name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Nombre',
                ],
                OrderByCriteria::ORDER_BY_NAME_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.reg_name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Nombre (desc)',
                ],
                OrderByCriteria::ORDER_BY_TYPE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.type',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tipo',
                ],
                OrderByCriteria::ORDER_BY_TYPE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.type',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tipo (desc)',
                ],
                OrderByCriteria::ORDER_BY_TABLE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.table',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tabla',
                ],
                OrderByCriteria::ORDER_BY_TABLE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.table',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tabla (desc)',
                ],
                OrderByCriteria::ORDER_BY_USER => [
                    OrderByCriteria::CRITERIA_COLUMN => 'users.name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Usuario',
                ],
                OrderByCriteria::ORDER_BY_USER_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'users.name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Usuario (desc)',
                ],
                OrderByCriteria::ORDER_BY_DATE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.created_at',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Fecha',
                ],
                OrderByCriteria::ORDER_BY_DATE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.created_at',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Fecha (desc)',
                ],
            ],
        ],
    ];

    public AdminLog $regView;

    public array $tableInfo;

    //filter properties

    public ?string $search = null;

    public ?string $type = null;

    public ?string $user = null;

    public ?string $userName = null;

    public ?string $table = null;

    public ?int $perPage = null;

    public ?string $orderBy = null;

    public ?string $orderByColumn = null;

    public ?string $orderByOrder = null;

    public ?array $relatedUsers = null;

    public ?array $relatedTypes = null;

    public ?array $relatedTables = null;

    //option properties

    public ?bool $isShowTableImages = null;

    public ?bool $isShowStriped = null;

    public ?bool $isFixedFirstColumn = null;

    public ?bool $isShowTypeColumn = null;

    public ?bool $isShowTableColumn = null;

    public ?bool $isShowUserColumn = null;

    public ?bool $isShowDateColumn = null;

    public ?string $currentModal = null;

    public ?array $selectedIds = null;

    public ?bool $isCheckAllSelector = null;

    //export properties

    public string $exportFormat = TableFilters::VALUE_NULL_STRING;

    public string $exportFilename = TableFilters::VALUE_NULL_STRING;

    public string $exportSelectedFilename = TableFilters::VALUE_NULL_STRING;

    /** @var array<int, string> */
    protected array $optionProperties = [];

    /** @var array<int, string> */
    protected array $filterProperties = [];

    public function viewFilters(): void
    {
        $this->dispatchEvent(EventNames::NAME_OPEN_FILTERS_MODAL);
    }

    public function cancelFilter(string $property): void
    {
        if (!\array_key_exists($property, self::PROPERTY_INITIAL_VALUES)) {
            return;
        }

        if ($property === TableFilters::NAME_USER) {
            $this->userName = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER_NAME];
        }

        $this->{$property} = self::PROPERTY_INITIAL_VALUES[$property];
    }

    public function setOrderBy($name): void
    {
        if (\str_ends_with($this->orderBy, '_desc')) {
            $currentOrderBy = \str_replace('_desc', '', $this->orderBy);

            if ($name === $currentOrderBy) {
                $this->orderBy = OrderByCriteria::ORDER_BY_ID_DESC;
                $this->orderByColumn = OrderByCriteria::ORDER_BY_ID;
                $this->orderByOrder = OrderByCriteria::ORDER_DESC;
                $this->page = 1;

                return;
            }
        }

        $orderCriteria = $this->tableInfo[TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME][$name];
        $this->orderBy = $name;
        $this->orderByColumn = $orderCriteria[OrderByCriteria::CRITERIA_COLUMN];
        $this->orderByOrder = $orderCriteria[OrderByCriteria::CRITERIA_ORDER];
        $this->page = 1;
    }

    public function setPerPage($number): void
    {
        $this->perPage = $number;
    }

    /**
     * Computed Property
     */
    public function getFiltersAppliedProperty(): bool
    {
        return !(
            $this->orderBy === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY]
            && $this->search === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_SEARCH]
            && $this->type === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TYPE]
            && $this->table === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TABLE]
            && $this->user === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER]
            && $this->perPage === self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PER_PAGE]
        );
    }

    public function select(int $id): void
    {
        if (isset($this->selectedIds[$id])) {
            unset($this->selectedIds[$id]);
            $this->isCheckAllSelector = false;

            return;
        }

        $this->selectedIds[$id] = $id;
    }

    public function deselect($id): void
    {
        unset($this->selectedIds[$id]);

        if (empty($this->selectedIds)) {
            $this->dispatchEvent(EventNames::NAME_CLOSE_SELECTED_MODAL);
        }
    }

    public function cancelSelection(): void
    {
        $this->selectedIds = TableFilters::VALUE_EMPTY_ARRAY;
        $this->dispatchEvent(EventNames::NAME_CLOSE_SELECTED_MODAL);
    }

    public function viewSelected(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        $this->dispatchEvent(EventNames::NAME_OPEN_SELECTED_MODAL);
    }

    public function confirmDestroy(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        $this->dispatchEvent(EventNames::NAME_OPEN_DESTROY_MODAL);
    }

    public function closeAnyModal(): void
    {
        $this->currentModal = null;
    }

    protected function getTableInfoByTableName(string $tableName): array
    {
        return self::TABLE_INFO_INDEXED_BY_TABLE_NAME[$tableName];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function initializeCommonFilters(string $tableName, array $tableInfo): void
    {
        $this->search = session()->get($tableName.'.'.TableFilters::NAME_SEARCH) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_SEARCH];
        $this->type = session()->get($tableName.'.'.TableFilters::NAME_TYPE) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TYPE];
        $this->user = session()->get($tableName.'.'.TableFilters::NAME_USER) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER];
        $this->userName = session()->get($tableName.'.'.TableFilters::NAME_USER_NAME) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER_NAME];
        $this->table = session()->get($tableName.'.'.TableFilters::NAME_TABLE) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TABLE];
        $this->page = session()->get($tableName.'.'.TableFilters::NAME_PAGE) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PAGE];
        $this->perPage = (int)(session()->get($tableName.'.'.TableFilters::NAME_PER_PAGE) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PER_PAGE]);
        $this->orderBy = session()->get($tableName.'.'.TableFilters::NAME_ORDER_BY) ?? self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY];
        $this->orderByColumn = session()->get($tableName.'.'.TableFilters::NAME_ORDER_BY_COLUMN) ?? $tableInfo[TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME][$this->orderBy]['column'];
        $this->orderByOrder = session()->get($tableName.'.'.TableFilters::NAME_ORDER_BY_ORDER) ?? $tableInfo[TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME][$this->orderBy]['order'];
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    protected function initializeOptions(string $tableName): void
    {
        $this->isShowTableImages = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_TABLE_IMAGES) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_TABLE_IMAGES];
        $this->isShowStriped = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_STRIPED) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_STRIPED];
        $this->isFixedFirstColumn = session()->get($tableName.'.'.TableOptions::NAME_IS_FIXED_FIRST_COLUMN) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_FIXED_FIRST_COLUMN];
        $this->isShowTypeColumn = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_TYPE_COLUMN) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_TYPE_COLUMN];
        $this->isShowTableColumn = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_TABLE_COLUMN) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_TABLE_COLUMN];
        $this->isShowUserColumn = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_USER_COLUMN) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_USER_COLUMN];
        $this->isShowDateColumn = session()->get($tableName.'.'.TableOptions::NAME_IS_SHOW_DATE_COLUMN) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_SHOW_DATE_COLUMN];
        $this->selectedIds = session()->get($tableName.'.'.TableOptions::NAME_SELECTED_IDS) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_SELECTED_IDS];
        $this->currentModal = session()->get($tableName.'.'.TableOptions::NAME_CURRENT_MODAL) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_CURRENT_MODAL];
        $this->isCheckAllSelector = session()->get($tableName.'.'.TableOptions::NAME_IS_CHECK_ALL_SELECTOR) ?? self::PROPERTY_INITIAL_VALUES[TableOptions::NAME_IS_CHECK_ALL_SELECTOR];
    }

    protected function resetCommonFilters(string $tableName): void
    {
        $this->search = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_SEARCH];
        $this->type = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TYPE];
        $this->user = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER];
        $this->userName = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_USER_NAME];
        $this->table = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_TABLE];
        $this->page = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PAGE];
        $this->perPage = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_PER_PAGE];
        $this->orderBy = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY];
        $this->orderByColumn = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY_COLUMN];
        $this->orderByOrder = self::PROPERTY_INITIAL_VALUES[TableFilters::NAME_ORDER_BY_ORDER];

        $this->forgetSessionKeys($tableName);

        if ($tableName === TableNames::TABLE_PLAYERS) {
            $this->dispatchEvent('resetFiltersMode');
        }
    }

    protected function dispatchEvent(string $eventName): void
    {
        $this->emit($eventName);
    }

    /**
     * @param array<int, string> $properties
     */
    protected function setPropertiesInSession(array $properties, string $tableName): void
    {
        foreach ($properties as $property) {
            if (!\property_exists($this, $property)) {
                continue;
            }

            $value = $this->{$property};
            $sessionKey = $tableName.'.'.$property;

            session()->put($sessionKey, $value);

            if ($property === TableFilters::NAME_USER) {
                $sessionKey = $tableName.'.'.TableFilters::NAME_USER_NAME;

                session()->put($sessionKey, $this->userName);
            }
        }
    }

    private function forgetSessionKeys(string $tableName): void
    {
        session()->forget([
            $tableName.'.'.TableFilters::NAME_SEARCH,
            $tableName.'.'.TableFilters::NAME_TYPE,
            $tableName.'.'.TableFilters::NAME_USER,
            $tableName.'.'.TableFilters::NAME_USER_NAME,
            $tableName.'.'.TableFilters::NAME_TABLE,
            $tableName.'.'.TableFilters::NAME_PAGE,
            $tableName.'.'.TableFilters::NAME_PER_PAGE,
            $tableName.'.'.TableFilters::NAME_ORDER_BY,
            $tableName.'.'.TableFilters::NAME_ORDER_BY_COLUMN,
            $tableName.'.'.TableFilters::NAME_ORDER_BY_ORDER,
        ]);
    }
}
