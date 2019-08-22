<?php

namespace App\Repositories\Interfaces;


use App\Models\Ticket\Ticket;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

interface ITicketRepository extends IRepository
{
    public function __construct(Ticket $ticket, Builder $builder, Datatables $dataTables);

    public function store(array $data): bool;

    public function get($id);

    public function lastTickets($limit = 10);

    public function oldTickets($days = 7, $limit = 10);

    /**
     * Ticket tag id list
     * @return array
     */
    public function getTagNames(): array;

    public function changeTicketsStatus(string $status, array $tickets);

    public function getDataTable();

    public function dataTableSource($dataId);
}