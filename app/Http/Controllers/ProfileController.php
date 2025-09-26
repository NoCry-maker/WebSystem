<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
//     public function update(Request $request)
//     {
//         $user = Auth::user();

//         $request->validate([
//             'name'   => 'nullable|string|max:255',
//             // 'email'  => 'required|email|unique:users,email,' . $user->id,
//             'mobile' =>  'nullable','string','regex:/^(09\d{9}|\+639\d{9})$/','unique:users,mobile,'  . $user->id,
//             'gender' => 'nullable|string|in:Male,Female,Other',
//             'dob'    => 'nullable|date',
//         ]);

//         $user->update($request->only(['name', 'email', 'mobile', 'gender', 'dob']));

//         return back()->with('status', 'Profile updated successfully!');
//     }
// public function updateAvatar(Request $request)
// {
//     $request->validate([
//         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     $user = Auth::user();

//     if ($request->hasFile('avatar')) {
//         // Delete old avatar if it exists
//         if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
//             unlink(public_path('avatars/' . $user->avatar));
//         }
//         // Save new avatar
//         $avatarName = time() . '.' . $request->avatar->extension();
//         $request->avatar->move(public_path('avatars'), $avatarName);

//         $user->avatar = $avatarName;
//         $user->save();
//     }

//     return back()->with('success', 'Avatar updated successfully.');
// }
public function update(Request $request)
{
    $user = Auth::user();

    // Validate profile fields
    $request->validate([
        'name'   => 'nullable|string|max:25',
        'mobile' => ['nullable', 'string', 'regex:/^(09\d{9}|\+639\d{9})$/', 'unique:users,mobile,' . $user->id],
        'gender' => 'nullable|string|in:Male,Female,Other',
        'dob'    => 'nullable|date',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Avatar validation
    ]);
    // Update profile info
    $user->update($request->only(['name', 'mobile', 'gender', 'dob']));

if ($request->hasFile('avatar')) {
     // Delete old avatar if it exists
    if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
        unlink(public_path('avatars/' . $user->avatar));
    }
 // Save new avatar
    $avatarName = time() . '.' . $request->avatar->extension();
    $request->avatar->move(public_path('avatars'), $avatarName);
    $user->avatar = $avatarName;
    $user->save();
}
    return back()->with('status', 'Profile updated successfully!');
}
}

