@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('E-Document')])

@section('content')
<div class="container" style="height: auto;">
    <div class="row justify-content-start">
        <div class="col-lg-7 col-md-8" style="margin-top: 10%">
            <a><img src="{{ asset('material') }}/img/logo-footer.png" alt="logo" style="width: 50%"/></a>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-7 col-md-8" style="margin-top: -15%;">
            <h1 class="text-white text-center">{{ __('i3 Gateway Co.,Ltd') }}</h1>
        </div>
    </div>
</div>
@endsection
