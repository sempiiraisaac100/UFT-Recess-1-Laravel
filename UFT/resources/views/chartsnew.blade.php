@extends('layouts.app')

@section('content')



<form  method="POST" action="{{url('/period')}}">
    @csrf
                  <select name="period">
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="6">6</option>
                  </select>
                  <button>Submit</button>
@endsection
