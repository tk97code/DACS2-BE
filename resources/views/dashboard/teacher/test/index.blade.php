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
                    <!-- <a href={{route('teacher.dashboard.test.create')}}>Create test</a> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                    <button class="btn btn-primary" id="addNewTest" data-bs-toggle="modal" data-bs-target="#addClassModal">Add new test</button>
                </li>
            </ul>
        </nav>
    </div>

    @foreach ($tests as $test)
    <div class="row justify-content-center">
        <div class="col-10 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="block block-rounded block-fx-pop mb-2">
                        <div class="block-content block-content-full border-start border-3 border-danger">
                            <div class="d-md-flex justify-content-md-between align-items-md-center">
                                <div class="p-1 p-md-3">
                                    <h3 class="h4 fw-bold mb-3">
                                        <a href="{{route('teacher.dashboard.test.show', $test->test_id)}}" class="text-dark link-fx">{{$test->test_name}}</a>
                                    </h3>
                                    <p class="fs-sm text-muted mb-2">
                                        <i class="fa fa-layer-group me-1"></i> 
                                        Deliver to 
                                        <strong data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="top" style="cursor:pointer" data-bs-original-title="Nhóm 1, Nhóm 2">
                                                <!-- show name of class -->
                                        </strong>
                                    </p>
                                    <p class="fs-sm text-muted mb-0">
                                        <i class="fa fa-clock me-1"></i> Take place from <span>{{$test->start_at}}</span> to <span>{{$test->end_at}}</span>
                                    </p>
                                </div>
                                <!-- <div class="p-1 p-md-3">
                                    <button class="btn btn-sm btn-danger rounded-pill px-3 me-1 my-1" disabled="">Closed</button>
                                    <a class="btn btn-sm btn-alt-success rounded-pill px-3 me-1 my-1" href="{{route('teacher.dashboard.test.show', $test->test_id)}}">
                                        <i class="fa fa-eye opacity-50 me-1"></i> Details
                                    </a>
                                    <a data-role="dethi" data-action="update" class="btn btn-sm btn-alt-primary rounded-pill px-3 me-1 my-1 show" href="./test/update/22">
                                        <i class="fa fa-wrench opacity-50 me-1"></i> Edit
                                    </a>
                                    <a data-role="dethi" data-action="delete" class="btn btn-sm btn-alt-danger rounded-pill px-3 my-1 btn-delete show" href="javascript:void(0)" data-id="22">
                                        <i class="fa fa-times opacity-50 me-1"></i> Delete
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


</div>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>

    $('#addNewTest').click((e) => {
        window.location.href = "{{route('teacher.dashboard.test.create')}}"
    });

</script>

<!-- <script src={{asset('assets/js/create-test.js')}}></script> -->

@endsection