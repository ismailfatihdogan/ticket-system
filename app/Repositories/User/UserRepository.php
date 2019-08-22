<?php

namespace App\Repositories\User;

use App\Exceptions\GeneralException;
use App\Models\Auth\User\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserRepository
 */
class UserRepository extends Repository implements IUserRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getSortableListViaPagination()
    {
        return $this->model->with('roles')->sortable(['email' => 'asc'])->paginate();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getTrashedListViaPagination()
    {
        return $this->model->with('roles')->onlyTrashed()->sortable(['email' => 'asc'])->paginate();
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function safeSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'active'    => 'sometimes|boolean',
            'confirmed' => 'sometimes|boolean',
        ]);

        $validator->sometimes('email', 'unique:users', function ($input){
            return strtolower($input->email) != strtolower($this->model->email);
        });

        $validator->sometimes('password', 'min:6|confirmed', function ($input) {
            return $input->password;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $this->model->name = $request->get('name');
        $this->model->email = $request->get('email');

        if ($request->has('password')) {
            $this->model->password = bcrypt($request->get('password'));
        }

        $this->model->active = $request->get('active', 0);
        $this->model->confirmed = $request->get('confirmed', 0);

        //roles
        if ($this->save() && $request->has('roles')) {
           $this->saveRoles($request->get('roles'));
        }

        return redirect()->intended(route('admin.users'));
    }

    public function saveRoles($roles)
    {
        $this->model->roles()->detach();

        $this->model->roles()->attach($roles);
    }

    /**
     * Restore User
     *
     * @param string|int $id
     * @throws GeneralException
     * @return bool
     */
    public function restore($id)
    {
        $user = $this->model->withTrashed()->where('id', $id)->first();
        
        if(isset($user) && isset($user->id))
        {
            return $user->restore();
        }
        
        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * Destroy User
     *
     * @param string|int $id
     * @throws GeneralException
     * @return bool
     */
    public function destroy($id)
    {
        // If the current user is who we're destroying, prevent this action and throw GeneralException
        if(auth()->id() == $id)
        {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        if($this->delete($id))
        {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }
}