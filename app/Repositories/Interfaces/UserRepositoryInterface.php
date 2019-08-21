<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getSortableListViaPagination();

    public function getTrashedListViaPagination();

    public function safeSave(Request $request);

    public function restore($id);

    public function destroy($id);
}