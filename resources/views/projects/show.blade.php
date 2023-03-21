@extends('layouts.app')
@section('title', 'Projects')
@section('content')
    <livewire:projects-show :project="$project"/>
@endsection
