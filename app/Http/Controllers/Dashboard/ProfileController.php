<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function changePassword(Request $request): View
    {
        return view('profile.change-password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show the form for deleting the account.
     */
    public function delete(Request $request): View
    {
        return view('profile.delete', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::find(auth()->user()->id);

        $rules = [
            'name' => 'required|max:50',
            'photo' => 'image|file|max:1024',
            'email' => 'required|email|max:50|unique:users,email,'.$user->id,
            'username' => 'required|min:4|max:25|alpha_dash:ascii|unique:users,username,'.$user->id
        ];

        $validatedData = $request->validate($rules);

        if ($validatedData['email'] != $user->email) {
            $validatedData['email_verified_at'] = null;
        }

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/profile/';

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        User::where('id', $user->id)->update($validatedData);

        return Redirect::route('profile')->with('success', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate password with error bag 'userDeletion'
        try {
            $request->validate([
                'password' => ['required', 'current_password'],
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('profile.delete')
                ->withInput()
                ->withErrors($e->errors(), 'userDeletion');
        }

        // Get table names from config (Spatie Permission package)
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        
        // Delete associated records for GDPR compliance
        // 1. Delete from model_has_permissions (polymorphic)
        DB::table($tableNames['model_has_permissions'])
            ->where('model_type', 'App\Models\User')
            ->where($columnNames['model_morph_key'], $user->id)
            ->delete();

        // 2. Delete from model_has_roles (polymorphic)
        DB::table($tableNames['model_has_roles'])
            ->where('model_type', 'App\Models\User')
            ->where($columnNames['model_morph_key'], $user->id)
            ->delete();

        // 3. Delete from personal_access_tokens (polymorphic)
        DB::table('personal_access_tokens')
            ->where('tokenable_type', 'App\Models\User')
            ->where('tokenable_id', $user->id)
            ->delete();

        // 4. Delete from password_reset_tokens (by email)
        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        // 5. Delete user's photo file if exists
        if ($user->photo) {
            Storage::delete('public/profile/' . $user->photo);
        }

        // 6. Store user ID before deletion
        $userId = $user->id;

        // 7. Delete the user record (using destroy like UserController)
        User::destroy($userId);

        // 8. Logout the user
        Auth::logout();

        // 9. Invalidate session
        $request->session()->invalidate();

        // 10. Regenerate CSRF token
        $request->session()->regenerateToken();

        // 11. Redirect to home
        return redirect('/');
    }
}
