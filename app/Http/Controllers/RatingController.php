<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if( $user && $user->can('write_rating') && $user->id!=$request['id_user']){
            $this->validateRating();
            try {
                Rating::create([
                    'rating_by'=> $user['id'],
                    'rating_to'=> $request['id_user'],
                    'rate'=> $request['rate'],
                    'description' =>  $request['description'],

                ]);
            }catch (Exception   $e){
                abort(403, 'Unauthorized action.');
            }



            return redirect()->back();
        }else{
            abort(403, 'Unauthorized action.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rating=Rating::where('rating_by', '=', $request['userRated'])
            ->where('rating_to', '=', $request['userRating'])
            ->first();
        $userAuth = Auth::user();
        if( $rating && $userAuth && ($userAuth->can('delete_rating')||$userAuth->id==$rating->userRated->id)){

            Rating::where('rating_by', '=', $rating->userRated->id)
                ->where('rating_to', '=', $rating->userRating->id)
                ->delete();
            return redirect()->back();
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    protected function validateRating(){
        return request()->validate([
            'rate'=>['required'],
            'description'=>['required'],

        ]);

    }

}
