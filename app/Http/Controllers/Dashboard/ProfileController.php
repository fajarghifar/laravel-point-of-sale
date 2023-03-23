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

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
            'photo_profile' => 'image|file|max:1024',
            'email' => ['required', 'email', 'max:50', Rule::unique(User::class)->ignore($user->id)],
        ];

        if ($request->username != $user->username)
        {
            $rules['username'] = 'required|min:4|max:25|unique:users|alpha_dash:ascii';
        }

        $validatedData = $request->validate($rules);

        if ($validatedData['email'] != $user->email) {
            $validatedData['email_verified_at'] = null;
        }

            /**
         * Handle upload image with Storage.
         */
        if($file = $request->file('photo'))
        {
            $fileName = 'profile-'.date('YmdHi').'-'.$file->getClientOriginalName();
            $path = 'public/images/';

            /**
             * Delete photo if exists.
             */
            if($user->photo){
                Storage::delete($path . $user->photo);
            }

            /**
             * Rezise and Compress the photo.
             */
            Image::make($file)
                ->resize(360, 360, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($fileName, 90);

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        User::where('id', $user->id)->update($validatedData);

        return Redirect::route('profile')->with('success', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
