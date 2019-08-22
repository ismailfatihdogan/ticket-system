<?php


namespace App\Repositories\Ticket;

use App\Models\Ticket\Tag;
use App\Models\Ticket\Ticket;
use App\Repositories\Interfaces\ITagRepository;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder as DataTableBuilder;

class TagRepository extends Repository implements ITagRepository
{

    protected $dataTableBuilder, $dataTables;

    public function __construct(Tag $tag, DataTableBuilder $builder, Datatables $dataTables)
    {
        $this->model = $tag;
        $this->dataTableBuilder = $builder;
        $this->dataTables = $dataTables;
    }


    public function getMostTickets()
    {
        return $this->model->withCount('tickets')->orderBy('tickets_count', 'desc')->limit(10)->get();
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
        return $this->dataTables->eloquent($this->model->select([
            'id',
            'title',
            'content',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by'
        ]))->addColumn('tags', function (Ticket $ticket) {
            return $ticket->tags()->pluck('name')->implode(', ');
        })->addColumn('action', function (Ticket $ticket) {
            return \Html::link(route('admin.tickets.edit', $ticket->id), '<i class="fa fa-pencil"></i>',
                ['class' => 'btn btn-xs btn-info', 'title' => __('views.admin.edit')], null, false);
        })->editColumn('content', function (Ticket $ticket) {
            return Str::limit($ticket->content, 100);
        })->editColumn('status', function (Ticket $ticket) {
            return __('views.admin.ticket.status.' . $ticket->status);
        })->editColumn('created_by', function (Ticket $ticket) {
            return $ticket->creator()->value('name');
        })->editColumn('updated_by', function (Ticket $ticket) {
            return $ticket->editor()->value('name');
        })->addColumn('action', function (Ticket $ticket) {
            return sprintf('%s %s %s',
                \Html::link(route('admin.tickets.show', $ticket->id), '<i class="fa fa-eye"></i>',
                    ['class' => 'btn btn-xs btn-primary', 'title' => __('views.admin.show')], null, false),

                \Html::link(route('admin.tickets.edit', $ticket->id), '<i class="fa fa-pencil"></i>',
                    ['class' => 'btn btn-xs btn-info', 'title' => __('views.admin.edit')], null, false),

                \Form::button('<i class="fa fa-trash"></i>', [
                    'data-id' => $ticket->id,
                    'class'   => 'btn btn-xs btn-danger delete-ticket',
                    'title'   => __('views.admin.delete')
                ]));
        })->filterColumn('status', function (Builder $query, $keyword) {
            if (!empty($keyword)) {
                $query->where('status', $keyword === $this->model::COMPLETED);
            }
        })->make(true);
    }
}