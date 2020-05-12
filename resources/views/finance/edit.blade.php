@extends('layouts.main')

@section('title', 'Edit Income')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h1>Edit Income</h1>

            @component('components.editForm')
            @endcomponent
        </div>
    </div>

@endsection