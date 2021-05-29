@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Treasury
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($treasury, ['route' => ['treasuries.update', $treasury->id], 'method' => 'patch']) !!}

                        @include('treasuries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection