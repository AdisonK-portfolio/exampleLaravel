<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(){

        $export = (new UsersExport);
        return view('genericIndex', [
            'title' => 'Users',
            'route' => '/users',
            'export' => $export,
            'items' => $export->query()->paginate(5)
        ]);
        //return view('users.indexUsers', ['users' => (new UsersExport)->query()->paginate(5)->toResourceCollection()]);
    }

    public function export(){
        return (new UsersExport)->download('users.xlsx');
    }

    public function edit(User $user){
        return view('users.editUser', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user){
        $user->update([ 
            'name' => $request->name, 
            'description' => $request->description 
        ]);

        return redirect('users');
    }

    public function delete(){

    }
}
