<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('photo')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name); //move photo

            $photo = Photo::create(['file' => $name]); //create photo
            $input['photo_id'] = $photo->id; //assign photo id to user data
        }

        User::create($input);

        return redirect('/admin/users')->with('status', 'User created successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }

        if($file = $request->file('photo')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name); //move photo

            $photo = Photo::create(['file' => $name]); //create photo
            $input['photo_id'] = $photo->id; //assign photo id to user data

            //remove old image
            $old_photo = Photo::find($user->photo_id);
            if($old_photo){
                unlink(public_path().$user->photo->file);
                $old_photo->delete();
            }
            
        }

        $user->update($input);

        return redirect('/admin/users')->with('status', 'User update successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::findOrFail($id);

        //remove old image
        $old_photo = Photo::find($user->photo_id);
        if($old_photo){
            unlink(public_path().$user->photo->file);
            $old_photo->delete();
        }

        $user->delete();

        return redirect('/admin/users')->with('status', 'User deleted successful.');
    }
}
