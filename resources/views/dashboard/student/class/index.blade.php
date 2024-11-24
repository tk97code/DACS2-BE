@extends('layouts.master')

@section('content')

<head>

<link rel="stylesheet" href={{asset('assets/css/class.css')}}>

</head>

<div class="content-wrapper">

    <!-- <form> -->
    <!-- @csrf -->
    <input type="text" id="invite_code">
    <button id="submit-btn">JOIN</button>
    <!-- </form> -->

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> List of classes
        </h3>
    </div>

    <div class="mb-4">
        <!-- <h2 class="h4 mb-4">Danh sách lớp học</h2> -->
        <div class="d-flex justify-content-between align-items-center">
            <div class="position-relative">
                <input type="search" class="search-box" placeholder="Nhập từ khóa tìm kiếm...">
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">Thêm mới</button>
        </div>

        <!-- Class Card -->
        <div class="row class-container">
            @foreach ($classes as $class)
            <div class="col-md-4 mt-4">
                <div class="class-card bg-white" style="cursor: pointer;" onclick="classDetail('{{$class->class_id}}')">
                    <img src="https://placehold.co/200x400" alt="Classroom" class="class-image w-100">
                    <div class="p-3">
                        <h3 class="h5">{{$class->class_name}}</h3>
                        <p class="text-muted small mb-3">Note: {{$class->class_note}}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">
                                <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                </svg>
                                0 thành viên
                            </span>
                            <span class="text-muted small">
                                <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                0 đề thi
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-2" onclick="event.stopPropagation()">Sửa</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation()">Xóa</button>
                            </div>
                            <button class="btn btn-sm btn-primary" onclick="event.stopPropagation()">Vào lớp học</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>

</div>

<script scr={{asset('vendor/jquery/jquery.min.js')}}></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#submit-btn').click((e) => {
            var formData = new FormData();

            formData.append('_token', '{{csrf_token()}}');
            formData.append('invite_code', $('#invite_code').val());

            $.ajax({
                type: 'POST',
                url: "{{route('student.dashboard.class.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (response) => {
                    $('.class-container').append(`
                        <div class="col-md-4 mt-4">
                            <div class="class-card bg-white" style="cursor: pointer;" onclick="classDetail(${response.class.class_id})">
                                <img src="https://placehold.co/200x400" alt="Classroom" class="class-image w-100">
                                <div class="p-3">
                                    <h3 class="h5">${response.class.class_name}</h3>
                                    <p class="text-muted small mb-3">Note: ${response.class.class_note}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted small">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                            </svg>
                                            0 thành viên
                                        </span>
                                        <span class="text-muted small">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            0 đề thi
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary me-2" onclick="event.stopPropagation()">Sửa</button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation()">Xóa</button>
                                        </div>
                                        <button class="btn btn-sm btn-primary" onclick="event.stopPropagation()">Vào lớp học</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    });

    function classDetail(class_id) {
        let url = "{{route('student.dashboard.class.show', ':class_id')}}";
        url = url.replace(':class_id', class_id);
        window.location.href = url;
    }

</script>


@endsection