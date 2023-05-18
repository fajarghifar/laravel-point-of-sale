<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('users.index', [
            'users' => User::filter(request(['search']))->sortable()->paginate($row)->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'photo' => 'image|file|max:1024',
            'email' => 'required|email|max:50|unique:users,email',
            'username' => 'required|min:4|max:25|alpha_dash:ascii|unique:users,username',
            'password' => 'min:6|required_with:password_confirmation',
            'password_confirmation' => 'min:6|same:password',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($request->password);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/profile/';

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        $user = User::create($validatedData);

        if($request->role) {
            $user->assignRole($request->role);
        }

        return Redirect::route('users.index')->with('success', 'New User has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'userData' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:50',
            'photo' => 'image|file|max:1024',
            'email' => 'required|email|max:50|unique:users,email,'.$user->id,
            'username' => 'required|min:4|max:25|alpha_dash:ascii|unique:users,username,'.$user->id,
        ];

        if($request->password || $request->confirm_password) {
            $rules['password'] = 'min:6|required_with:password_confirmation';
            $rules['password_confirmation'] = 'min:6|same:password';
        }

        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($request->password);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/profile/';

            /**
             * Delete photo if exists.
             */
            if($user->photo){
                Storage::delete($path . $user->photo);
            }

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        $userData = User::findOrFail($user->id);
        $userData->update($validatedData);

        if($request->role) {
            $userData->syncRoles($request->role);
        }

        return Redirect::route('users.index')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        /**
         * Delete photo if exists.
         */
        if($user->photo){
            Storage::delete('public/profile/' . $user->photo);
        }

        User::destroy($user->id);

        return Redirect::route('users.index')->with('success', 'User has been deleted!');
    }
}
