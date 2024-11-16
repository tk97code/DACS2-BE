@extends('layouts.master')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> Test
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href={{route('test.create')}}>Create test</a> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>



<!-- <script src={{asset('assets/js/create-test.js')}}></script> -->

@endsection