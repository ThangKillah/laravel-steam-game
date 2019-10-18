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
    <section class="blank">
        <!-- add content -->
    </section>
    <!-- /main -->
@endsection