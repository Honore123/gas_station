<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        return view('users.index', [
            'users' => User::with(['store'])->whereNotIn('name',['administrator'])->get(),
            'stores' => Store::all(),
            'roles' => Role::all()
        ]);
    }
    public function profile()
    {
        return view('profile.profile');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string'],
            'phone' => ['required','max:13'],
            'email' => ['required'],
        ]);
        $data['password'] = Hash::make('nzizacrafts');
        $user = User::create($data);
        $user->syncRoles(request()->input('role'));

        return redirect()->back()->with('success', 'User created with default password');
    }

    public function assignStore(User $user)
    {
        $data = request()->validate([
            'store' => ['required']
        ]);
        $store = Store::where('id', $data['store']);
        $store->update([
            'store_seller' => $user->id
        ]);

        return redirect()->back()->with('success', 'Store assigned');
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update()
    {
        $data = request()->validate([
            'name' => ['required', 'string'],
            'phone' => ['required','max:13'],
            'email' => ['required'],
        ]);
        $user = User::where('id', request()->input('userId'));
        $user->update($data);

        return redirect()->back()->with('success', 'User updated');
    }

    public function changePassword(User $user)
    {
        $data = \request()->validate([
            'currentPassword' => ['required'],
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required']
        ]);
        if (!Hash::check($data['currentPassword'], $user->password)) {
            return redirect()->back()->with('error', 'Current password incorrect');
        }
        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return redirect()->back()->with('success', 'Password changed');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User deleted');
    }
}
