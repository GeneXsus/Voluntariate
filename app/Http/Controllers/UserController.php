<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Auth::user();
        if( $userAuth && $userAuth->hasRole('Administrator')) {
            $usersUser = User::role('user')->get();
            $usersCompany = User::role('Company')->get();
            return view('users.index', ["usersUser" => $usersUser, "usersCompany" => $usersCompany]);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {


        return view('users.show',["user"=>$user]);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userAuth = Auth::user();
        if( $userAuth && $userAuth->can('edit_user')){

            $json = File::get(public_path()."/assets/locations.json");
            $locations = json_decode($json, true);
            return view('users.edit', ['user' => $user, 'locations'=>$locations]);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userAuth = Auth::user();
        if( $userAuth && $userAuth->can('edit_user')){
            if($user->hasRole('User')){
                if($request['email'] && $request['email'] != $user->email )
                {
                $this->validateUser('unique:users');

                }else{
                    $this->validateUser('string');
                }
                $user->update([   'name' => $request['name'],
                    'subname' => $request['subname'],
                    'location' => $request['location'],
                    'email' => $request['email']
                ]);
            }elseif ($user->hasRole('Company')){
                if($request['email'] && $request['email'] != $user->email ){
                $this->validateCompany('unique:users');

                }else{
                    $this->validateCompany('string');
                }
                $user->update([
                    'email' => $request['email'],
                    'center' => $request['center'],
                    'description' => [
                        'en' => $request['descriptionEn'],
                        'es' => $request['descriptionEs']
                    ],
                    'direction' => $request['direction'],

                    'location' => $request['location'],
                ]);
            }

            return redirect(route('users.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userAuth = Auth::user();
        if( $userAuth && $userAuth->can('delete_user')){
            $user->delete();
            return redirect(route('users.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    protected function validateUser($emailCheck){
        return request()->validate([
            'name' => ['required', 'string', 'max:50'],
            'subname' => ['required', 'string', 'max:150'],
            'location' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', $emailCheck]
        ]);

    }
    protected function validateCompany($emailCheck){
        return request()->validate([
            'center' => ['required', 'string', 'max:150'],
            'descriptionEs' => ['required'],
            'descriptionEn' => ['required'],
            'direction' => ['required'],
            'location' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', $emailCheck],
        ]);

    }
}