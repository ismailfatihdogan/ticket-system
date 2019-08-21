<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function store(string $name);

    public function dropdownList();

    public function dataTableSource();
}