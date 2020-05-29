<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $values = [];
        $search=$request['search']??'';
        if (!$user) {
            abort(403, __("Unauthorized action."));
        }else {


            if ($user->hasRole('User')) {

                $offers_registered_open = $user->registereds()->searcher($request['search'])->where('closed', 0)->orderBy('updated_at','Desc')->get();

                $offers_registered_closed = $user->registereds()->searcher($request['search'])->where('closed', 1)->orderBy('updated_at','Desc')->get();
                $offers_registered_acepted = $user->registeredsAcepted()->searcher($request['search'])->orderBy('updated_at','Desc')->get();



                $values = ['offers' => $offers_registered_open, 'offers_closed' => $offers_registered_closed, 'offers_acepted' => $offers_registered_acepted, 'search' => $search];
            }

            if ($user->hasRole('Company')) {

                $offers_open = $user->offers()->searcher($request['search'])->where('closed', 0)->orderBy('updated_at','Desc')->get();
                $offers_closed = $user->offers()->searcher($request['search'])->where('closed', 1)->orderBy('updated_at','Desc')->get();
                $values = ['offers' => $offers_open, 'offers_closed' => $offers_closed, 'search' => $search];
            }


            if ($user->hasRole('Administrator')) {
                $offers_open = Offer::where('closed', 0)->searcher($request['search'])->orderBy('updated_at','Desc')->get();
                $offers_closed = Offer::where('closed', 1)->searcher($request['search'])->orderBy('updated_at','Desc')->get();
                $values = ['offers' => $offers_open, 'offers_closed' => $offers_closed, 'search' => $search];
            }
            return view('offers.index', $values);
        }

    }


    public function show(Offer $offer)
    {
        $userAuth = Auth::user();

        if ($userAuth->hasRole('Company')) {
            $registereds = $offer->registereds;

            $values = ['offer' => $offer, 'isSubscribe' => false, 'registereds' => $registereds];
        } else {

            $isSubscribe = ($userAuth && $userAuth->registereds()->where('offer_id', $offer->id)->first() != null) ? true : false;
            $values = ['offer' => $offer, 'isSubscribe' => $isSubscribe];
        }


        return view('offers.show', $values);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json = File::get(public_path() . "/assets/locations.json");
        $locations = json_decode($json, true);
        $types = Type::all();
        return view('offers.create', ['locations' => $locations, 'types' => $types]);
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
            'name' => [
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
            'location' => $request['location'],
            'places' => $request['places'],
            'init_date' => $request['init_date'],
            'end_date' => $request['end_date'],
            'center' => $user['center'],
            'type_id' => $request['type'],
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
        $json = File::get(public_path() . "/assets/locations.json");
        $locations = json_decode($json, true);
        $types = Type::all();
        return view('offers.edit', ['offer' => $offer, "locations" => $locations, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $this->validateOffer();
        $offer->update([
            'name' => [
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
            'location' => $request['location'],
            'places' => $request['places'],
            'init_date' => $request['init_date'],
            'end_date' => $request['end_date'],
            'type_id' => $request['type']
        ]);

        return redirect($offer->path());
    }

    /**
     *  Close or open offer .
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function toogle(Offer $offer)
    {

        $user = Auth::user();
        if ($user && ($user->id == $offer['user_id'] || $user->hasRole('Administrator'))) {
            $offer->update(['closed' => ($offer['closed'] == 0 ? 1 : 0)]);
            return redirect()->back();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     *  Susbcribe user to offer.
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function subscribeUser(Offer $offer)
    {

        $user = Auth::user();
        if ($user && (!$user->hasRole(['Administrator', 'Company']))) {
            $offer->registereds()->attach($user->id);
            return redirect()->back();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     *  Unusbcribe user to offer.
     *
     * @param \App\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function unsubscribeUser(Offer $offer)
    {

        $user = Auth::user();
        if ($user && (!$user->hasRole(['Administrator', 'Company']))) {
            $offer->registereds()->detach($user->id);
            return redirect()->back();
        } else {
            abort(403, 'Unauthorized action.');
        }
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
        if ($user && ($user['id'] == $offer['user_id'] || $user->can('destroy_offer'))) {
            $offer->delete();
            return redirect(route('offers.index'));
        } else {
            abort(403, 'Unauthorized action.');
        }

    }

    protected function validateOffer()
    {
        return request()->validate([
            'nameEs' => ['required'],
            'nameEn' => ['required'],
            'descriptionShortEs' => 'required',
            'descriptionShortEn' => 'required',
            'descriptionEs' => 'required',
            'descriptionEn' => 'required',
            'location' => 'required',
            'type' => 'required',
            'places' => ['required', 'min:0', 'integer'],
            'init_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:date_end'],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:end_date']
        ]);

    }

    /**
     *  Susbcribe user to offer.
     *
     * @param \App\Offer $offer
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function accept(Offer $offer, User $user)
    {

        $userAuth = Auth::user();
        if ($userAuth && $userAuth->id == $offer['user_id']) {

            DB::table('registereds')
                ->where('offer_id', $offer->id)
                ->where('user_id', $user->id)
                ->update(['acepted' => 1]);

            return redirect()->back();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     *  Susbcribe user to offer.
     *
     * @param \App\Offer $offer
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function refuse(Offer $offer, User $user)
    {

        $userAuth = Auth::user();
        if ($userAuth && $userAuth->id == $offer['user_id']) {

            DB::table('registereds')
                ->where('offer_id', $offer->id)
                ->where('user_id', $user->id)
                ->update(['acepted' => 0]);
            return redirect()->back();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

}
