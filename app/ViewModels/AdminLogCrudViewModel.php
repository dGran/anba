<?php

declare(strict_types=1);

namespace App\ViewModels;

class AdminLogCrudViewModel extends CrudViewModel
{
    private array $users = [];

    private array $types = [];

    private array $tables = [];

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): AdminLogCrudViewModel
    {
        $this->users = $users;

        return $this;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function setTypes(array $types): AdminLogCrudViewModel
    {
        $this->types = $types;

        return $this;
    }

    public function getTables(): array
    {
        return $this->tables;
    }

    public function setTables(array $tables): AdminLogCrudViewModel
    {
        $this->tables = $tables;

        return $this;
    }
}
