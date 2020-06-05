<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filesnewcomer=$this->searchFileName(public_path('assets/video/newcomer'));
        $filesuser=$this->searchFileName(public_path('assets/video/user'));
        $filesnewcompany=$this->searchFileName(public_path('assets/video/company'));


        return view('help',['vNewcomer'=>$filesnewcomer,'vUser'=>$filesuser,'vCompany'=>$filesnewcompany]);
    }

    public function searchFileName($pathDirectori){
        $arrayFileName=[];
        $filesInFolder = File::files($pathDirectori);
        foreach($filesInFolder as $path) {
            $file = pathinfo($path);

            $arrayFileName[]= $file['basename'];
        }
        return $arrayFileName;

    }
}
