<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $users = User::orderBy('id','DESC')->get();
        $userArr = [];
        foreach($users as $value){
            foreach($value->getRoleNames() as $v){
                if($v != 'Admin'){
                    $userArr[] = $value->id;
                }
            }
        }
        $data = User::whereIn('id', $userArr)->get();
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'number' => ['required'],
            'roles' => ['required']
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if($request->profile_image){
            $image = $request->profile_image;

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('images/user');
            $image->move($destination, $imageName);

            $input['profile_image'] = $imageName;
        }


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);

        if ($request->file('profile_image')) {
            $image = $input['profile_image'];
            $path = public_path('images/user').'\\'.$user->profile_image;
            if(File::exists($path)){
                File::delete($path);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('images/user');
            $image->move($destination, $imageName);
            $input['profile_image'] = $imageName;
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $path = public_path('images/user').'\\'.$user->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
