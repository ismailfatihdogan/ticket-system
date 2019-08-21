<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralException;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Repository
     *
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * Construct
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('admin.users.index', ['users' => $this->repository->getSortableListViaPagination()]);
    }

    /**
     * Restore Users
     *
     * @param Request $request
     * @return Response
     */
    public function restore(Request $request)
    {
        return view('admin.users.restore', ['users' => $this->repository->getTrashedListViaPagination()]);
    }

    /**
     * Restore Users
     *
     * @param int $id
     * @return Response
     */
    public function restoreUser($id)
    {
        if ($this->repository->restore($id)) {
            return redirect()->route('admin.users')->withFlashSuccess('User Restored Successfully!');
        }

        return redirect()->route('admin.users')->withFlashDanger('Unable to Restore User!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id)
    {
        return view('admin.users.show', ['user' => $this->repository->show($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', ['user' => $this->repository->show($id), 'roles' => Role::get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return mixed
     */
    public function update(Request $request, User $user)
    {
        return $this->repository->setModel($user)->safeSave($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if ($this->repository->destroy($id)) {
            return redirect()->route('admin.users')->withFlashSuccess('User Deleted Successfully!');
        }

        return redirect()->route('admin.users')->withFlashDanger('Unable to Delete User!');
    }
}
