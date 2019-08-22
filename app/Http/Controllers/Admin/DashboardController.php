<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\ITagRepository;
use App\Repositories\Interfaces\ITicketRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $userRepository, $ticketRepository, $tagRepository;

    /**
     * Create a new controller instance.
     *
     * @param IUserRepository $userRepository
     * @param ITicketRepository $ticketRepository
     * @param ITagRepository $tagRepository
     */
    public function __construct(
        IUserRepository $userRepository,
        ITicketRepository $ticketRepository,
        ITagRepository $tagRepository
    ) {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counts = [
            'users'             => $this->userRepository->count(),
            'users_unconfirmed' => $this->userRepository->count(['confirmed' => false]),
            'users_inactive'    => $this->userRepository->count(['active' => false]),
            'protected_pages'   => 0,
            'tags'              => $this->tagRepository->count(),
            'tickets'           => $this->ticketRepository->count()
        ];

        foreach (\Route::getRoutes() as $route) {
            foreach ($route->middleware() as $middleware) {
                if (preg_match("/protection/", $middleware, $matches)) {
                    $counts['protected_pages']++;
                }
            }
        }

        return view('admin.dashboard', [
            'counts'         => $counts,
            'lastTickets'    => $this->ticketRepository->lastTickets(),
            'oldTickets'     => $this->ticketRepository->oldTickets(),
            'tagMostTickets' => $this->tagRepository->getMostTickets()
        ]);
    }
}
