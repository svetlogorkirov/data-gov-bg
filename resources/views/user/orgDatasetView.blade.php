@extends('layouts.app')
@php $root = !(Auth::user()->is_admin) ? 'user' : 'admin'; @endphp
@section('content')
    <div class="container">
        @include('partials.alerts-bar')
        @include('partials.'. $root .'-nav-bar', ['view' => 'organisation'])
        @include('partials.org-nav-bar', ['view' => 'dataset', 'organisation' => $fromOrg])
        <div class="row">
            <div class="col-sm-3 col-xs-12 text-left p-l-none">
            @include('partials.org-info', ['organisation' => $fromOrg])
            </div>
            @include('components.datasets.dataset_view', ['admin' => Auth::user()->is_admin])
        </div>
    </div>
@endsection
