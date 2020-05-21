<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types= Type::all();
        return view('types.index',["types"=>$types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user && $user->can('create_type')){
            return view('types.create');

        }else{

            abort(403, 'Unauthorized action.');
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if( $user && $user->can('create_type')){
            $this->validateType();
            Type::create([
                'name'=>[
                    'en' => $request['nameEn'],
                    'es' => $request['nameEs']
                ],
                'description' => [
                    'en' => $request['descriptionEn'],
                    'es' => $request['descriptionEs']
                ],

            ]);


            return redirect(route('types.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $user = Auth::user();
        if( $user && $user->can('edit_type')){

            return view('types.edit',["type"=>$type]);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $user = Auth::user();
        if( $user && $user->can('edit_type')){
            $this->validateType();
            $type->update([
                'name'=>[
                    'en' => $request['nameEn'],
                    'es' => $request['nameEs']
                ],
                'description' => [
                    'en' => $request['descriptionEn'],
                    'es' => $request['descriptionEs']
                ],
            ]);

            return redirect(route('types.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $user = Auth::user();
        if( $user && $user->can('delete_type')){
            $type->delete();
            return redirect(route('types.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    protected function validateType(){
        return request()->validate([
            'nameEs'=>['required'],
            'nameEn'=>['required'],
            'descriptionEs'=>'required',
            'descriptionEn'=>'required',
        ]);

    }
}

