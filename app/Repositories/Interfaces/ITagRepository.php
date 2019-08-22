<?php

namespace App\Repositories\Interfaces;

interface ITagRepository extends IRepository
{

    public function getMostTickets();

    /**
     * @param string $name
     * @return mixed
     */
    public function store(string $name);

    public function dropdownList();

    public function dataTableSource();
}