<?php


namespace App\Repositories\Ticket;

use App\Models\Ticket\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Repository;
use Yajra\DataTables\EloquentDataTable;

class TagRepository extends Repository implements TagRepositoryInterface
{

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function store(string $name)
    {
        return $this->model->firstOrCreate(['name' => $name, 'deleted_at' => null]);
    }

    public function dropdownList()
    {
        return $this->model->pluck('name', 'name');
    }

    public function dataTableSource()
    {
        return EloquentDataTable::create($this->model->select([
            'id',
            'title',
            'content',
            'created_at',
            'updated_at'
        ])->newQuery())->addColumn('action', function ($tag) {
            return \Html::link(route('admin.tag.edit', $tag->id), '<i class="fa fa-pencil"></i>',
                ['class' => 'btn btn-xs btn-info', 'title' => __('views.admin.edit')], null, false);
        })->addColumn('action', function ($tag) {
            return sprintf('%s %s', \Html::link(route('admin.tag.edit', $tag->id), '<i class="fa fa-pencil"></i>',
                ['class' => 'btn btn-xs btn-info', 'title' => __('views.admin.edit')], null, false),

                \Form::button('<i class="fa fa-trash"></i>', [
                    'data-id' => $tag->id,
                    'class'   => 'btn btn-xs btn-danger delete-tag',
                    'title'   => __('views.admin.delete')
                ]));
        })->make(true);
    }
}