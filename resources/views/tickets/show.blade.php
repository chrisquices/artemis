@extends('layouts.app')
@section('title', 'Tickets')
@section('content')
    <livewire:tickets-show :ticket="$ticket"/>
@endsection
