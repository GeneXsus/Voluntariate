<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $values=[];
        if(!$user){
            abort(403, __("Unauthorized action."));
        }
        if( $user->hasRole('User')){
            $offers_registered_open=$user->registereds->where('closed',0);
            $offers_registered_closed=$user->registereds->where('closed',1);
            $offers_registered_acepted=$user->registereds->where('acepted',1);
            $values=['offers'=>$offers_registered_open,'offers_closed'=>$offers_registered_closed,'offers_acepted'=>$offers_registered_acepted];
        }

        if( $user->hasRole('Company')){
            $offers_open=$user->offers->where('closed',0);
            $offers_closed=$user->offers->where('closed',1);
            $values=['offers'=>$offers_open,'offers_closed'=>$offers_closed];
        }



        if( $user->hasRole('Administrator')){
            $offers_open=Offer::all()->where('closed',0);
            $offers_closed=Offer::all()->where('closed',1);
            $values=['offers'=>$offers_open,'offers_closed'=>$offers_closed];
        }
        return view('offers.index', $values);

    }


    public function show(Offer $offer)
    {
        return view('offers.show', ['offer' => $offer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json = File::get(public_path()."/assets/locations.json");
        $locations = json_decode($json, true);
        $types =Type::all();
        return view('offers.create',['locations' => $locations,'types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validateOffer();
        Offer::create([
            'name'=>[
                'en' => $request['nameEn'],
                'es' => $request['nameEs']
            ],
            'description' => [
                'en' => $request['descriptionEn'],
                'es' => $request['descriptionEs']
            ],
            'description_short' => [
                'en' => $request['descriptionShortEn'],
                'es' => $request['descriptionShortEs']
            ],
            'location'=>$request['location'],
            'places'=>$request['places'],
            'init_date' => $request['init_date'],
            'end_date' => $request['end_date'],
            'center' => $user['center'],
            'type_id'=> $request['type'],
            'user_id' => $user['id']
        ]);


        return redirect(route('offers.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $json = File::get(public_path()."/assets/locations.json");
        $locations = json_decode($json, true);
        $types =Type::all();
        return view('offers.edit', ['offer' => $offer,"locations"=>$locations,'types'=>$types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Offer $offer)
    {
        $this->validateOffer();
        $offer->update([
            'name'=>[
                'en' => $request['nameEn'],
                'es' => $request['nameEs']
            ],
            'description' => [
                'en' => $request['descriptionEn'],
                'es' => $request['descriptionEs']
            ],
            'description_short' => [
                'en' => $request['descriptionShortEn'],
                'es' => $request['descriptionShortEs']
            ],
            'location'=>$request['location'],
            'places'=>$request['places'],
            'init_date' => $request['init_date'],
            'end_date' => $request['end_date'],
            'type_id'=> $request['type']
        ]);

        return redirect($offer->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function toogle(Offer $offer)
    {


        $offer->update(['closed'=>($offer['closed']==0?1:0)]);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $user = Auth::user();
        if( $user && ($user['id']==$offer['user_id'] || $user->can('destroy_offer'))){
            $offer->delete();
            return redirect(route('offers.index'));
        }else{
            abort(403, 'Unauthorized action.');
        }

    }

    protected function validateOffer(){
        return request()->validate([
            'nameEs'=>['required'],
            'nameEn'=>['required'],
            'descriptionShortEs'=>'required',
            'descriptionShortEn'=>'required',
            'descriptionEs'=>'required',
            'descriptionEn'=>'required',
            'location'=>'required',
            'type'=>'required',
            'places'=>['required','min:0','integer'],
            'init_date' => ['required','date_format:Y-m-d','before_or_equal:date_end'],
            'end_date' => ['required','date_format:Y-m-d','after_or_equal:end_date']
        ]);

    }
}
