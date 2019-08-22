<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IUserRepository extends IRepository
{
    public function getSortableListViaPagination();

    public function getTrashedListViaPagination();

    public function safeSave(Request $request);

    public function restore($id);

    public function destroy($id);

    public function count($where=[]);

}