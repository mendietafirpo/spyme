<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        dd('profile');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'profile_image'     =>  'image|mimes:jpeg,png,jpg,gif|max:300'
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        // Set user name

        $user->name = $request->input('name');
        $user->telefono = $request->input('telefono');
        $user->direccion = $request->input('direccion');
        $user->ciudad = $request->input('ciudad');
        $user->pais = $request->input('pais');
        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }
        // Persist user record to database
        $user->save();
        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}
