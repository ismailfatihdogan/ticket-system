<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Tickets\ChangeTicketsStatus;
use App\Http\Requests\Tickets\StoreRequest;
use App\Http\Requests\Tickets\UpdateRequest;
use App\Models\Ticket\Ticket;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Repository
     *
     * @var TicketRepositoryInterface $repository
     */
    protected $repository, $dataTable;

    /**
     * Construct
     * @param TicketRepositoryInterface $ticketRepository
     */
    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->repository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.tickets.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return JsonResponse
     */
    public function datatable()
    {
        return $this->repository->dataTableSource();
    }

    public function show($id)
    {
        return view('admin.tickets.show', ['ticket' => $this->repository->get($id)]);
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.tickets.create', [
            'ticket' => $this->repository->getModel(),
            'tags'   => app(TagRepositoryInterface::class)->dropdownList()
        ]);
    }

    public function store(StoreRequest $request)
    {
        if ($this->repository->store($request->validated())) {
            return redirect()->route('admin.tickets.index')->withFlashSuccess(__('views.admin.ticket.created'));
        }

        return redirect()->route('admin.tickets.index')->withFlashDanger(__('views.admin.ticket.error.create'));
    }

    public function edit($id)
    {
        return view('admin.tickets.edit', [
            'ticket'     => $this->repository->show($id),
            'tags'       => app(TagRepositoryInterface::class)->dropdownList(),
            'ticketTags' => $this->repository->getTagNames()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Ticket $ticket
     * @return mixed
     */
    public function update(UpdateRequest $request, Ticket $ticket)
    {
        if ($this->repository->setModel($ticket)->store($request->validated())) {
            return redirect()->route('admin.tickets.index')->withFlashSuccess(__('views.admin.ticket.updated'));
        }

        return redirect()->route('admin.tickets.index')->withFlashDanger(__('views.admin.ticket.error.update'));
    }

    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return response()->json(['status' => true, 'message' => __('views.admin.ticket.deleted')]);
        }

        return response()->json(['status' => false, 'message' => __('views.admin.ticket.error.delete')]);
    }

    public function changeTicketsStatus(ChangeTicketsStatus $request)
    {
        if($this->repository->changeTicketsStatus($request->get('status'), $request->get('tickets'))){
            return response()->json(['status' => true, 'message' => __('views.admin.ticket.status_changed')]);
        }

        return response()->json(['status' => false, 'message' => __('views.admin.ticket.error.status_change')]);
    }
}