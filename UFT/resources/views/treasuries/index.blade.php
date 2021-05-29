@extends('layouts.app')
@auth
    @section('content')
        <section class="content-header">
            <h1 class="pull-left">Treasuries</h1>
            <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('treasuries.create') !!}">Add New</a>
            </h1>
        </section>
        <div class="content">
            <div class="clearfix"></div>
            @include('flash::message')

<<<<<<< HEAD
            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                        @include('treasuries.table')
                </div>
            </div>
            <div class="text-center">
=======
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Treasuries</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd

            </div>
        </div>
<<<<<<< HEAD
    @endsection
=======
        <div class="text-center">

        </div>
    </div>
@endsection
>>>>>>> 236792f5ad063b3b68d60be9f843ae454ec0c4cd

@endauth
