@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card  w-100">
            @include('layouts.block.video', ['name' =>'newcomer', 'title'=> __('Help for Newcomer'),'filesVideo'=>$vNewcomer, 'show'=>Auth::user()?'':'show'])
            @include('layouts.block.video', ['name' =>'user', 'title'=> __('Help for User'),'filesVideo'=>$vUser,'show'=>Auth::user()?(Auth::user()->hasRole('User')?'show':''):''])
            @include('layouts.block.video', ['name' =>'company', 'title'=> __('Help for Company'),'filesVideo'=>$vCompany,'show'=>Auth::user()?(Auth::user()->hasRole('Company')?'show':''):''])
        </div>

    </div>
@endsection

