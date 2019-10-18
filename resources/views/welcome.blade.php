@extends('layout.blank')

@section('title', 'Blank Page')

@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
    <section class="blank">
        <!-- add content -->
    </section>
    <!-- /main -->
@endsection