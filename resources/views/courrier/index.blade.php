@extends('layouts.app')
@extends('profile.partials.logo')
@section('title', 'Courrier - ' . strtoupper($type))

@section('content')
  <h1> {{ $type }}{{ strtoupper($espace) }} : aya tlae lia lkhra rasi</h1>
   
 
@endsection
