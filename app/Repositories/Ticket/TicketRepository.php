<?php


namespace App\Repositories\Ticket;


use App\Models\Ticket\Ticket;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder as DataTableBuilder;

class TicketRepository extends Repository implements TicketRepositoryInterface
{
    protected $dataTableBuilder, $dataTables;

    /**
     * TicketRepository constructor.
     * @param Ticket $ticket
     * @param DataTableBuilder $builder
     * @param DataTables $dataTable
     */
    public function __construct(Ticket $ticket, DataTableBuilder $builder, Datatables $dataTables)
    {
        $this->model = $ticket;
        $this->dataTableBuilder = $builder;
        $this->dataTables = $dataTables;
    }

    public function store(array $data): bool
    {
        //Ticket is processing
        if (!isset($data['status'])) {
            $data['status'] = false;
        }

        if ($this->model->fill($data)->save()) {
            $this->saveTags($data['tags']);

            return true;
        }

        return false;
    }

    public function get($id)
    {
        return $this->with([
            'tags' => function (BelongsToMany $builder) {
                $builder->select('name');
            }
        ])->findOrFail($id);
    }

    public function saveTags($tags)
    {
        $tagList = [];

        foreach ($tags as $tag) {
            $tag = app(TagRepositoryInterface::class)->store($tag);

            $tagList[] = $tag->id;
        }

        $this->model->tags()->sync($tagList);
    }

    /**
     * Ticket tag id list
     * @return array
     */
    public function getTagNames(): array
    {
        return $this->model->tags()->pluck('name')->toArray();
    }

    public function getDataTable()
    {
        $this->dataTableBuilder->postAjax(route('admin.tickets.datatable'));
    }

    public function changeTicketsStatus(string $status, array $tickets)
    {
        return $this->model->whereIn('id', $tickets)->update(['status' => $status === $this->model::COMPLETED]);
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
            if(!empty($keyword)){
                $query->where('status', $keyword === $this->model::COMPLETED);
            }
        })->make(true);
    }
}