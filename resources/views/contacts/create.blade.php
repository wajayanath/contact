@extends('layouts.main')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <strong>Add Contact</strong>
  </div>

  {!! Form::open(['files' => true, 'route' => 'contacts.store']) !!}
  
  @include('contacts.formNew')

  {!! Form::close() !!}
  
</div>

@endsection

