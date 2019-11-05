@extends('layout.blank')

@section('title', 'Blank Page')

@section('breadcrumb')
    <section class="breadcrumbs">
        <div class="container">
            {{ Breadcrumbs::render('home') }}
        </div>
    </section>
@endsection

@section('content')
    @if(Sentinel::check())
        <h1>sasdsa</h1>
    @endif
    <section class="blank">
        <!-- add content -->
    </section>
    <!-- /main -->
@endsection