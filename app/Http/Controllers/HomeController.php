<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();

            $offers=Offer::searcher($request['search'])->where('closed',0)->orderBy('updated_at','Desc')->get();
            if($user && $user->hasRole('User'))
            {
                $favoriteTypes= array_values($user->preferred()->pluck('id')->toArray());
                $offers_recommended= Offer::searcher($request['search'])->where(function ($query) use ($favoriteTypes,$user) {
                    $query->whereIn('type_id', $favoriteTypes)->orWhere("location", 'like', "%" . $user->location . "%");
                })->where('closed',0)->orderBy('updated_at','Desc')->get();
                $values=['offers' => $offers, 'search'=>$request['search'],'offers_recommended'=>$offers_recommended];

            }else{

                $values=['offers' => $offers, 'search'=>$request['search']];
            }

        return view('home', $values);
    }
}
