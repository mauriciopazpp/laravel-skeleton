@extends('layouts.admin-lte')

@section('content')
<section class="content-wrapper">
    <section class="content-header">
        @include('partials.flash-messages')
        @include('partials.error-block-animated')
        @include('partials.error-block')
        <h1 class="main-title">Dashboard</h1>
    </section>
    <section class="content">
        @include("widgets.init")
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                @include('widgets.themes')
            </div>
        </div>
    </section>
</section>
@endsection