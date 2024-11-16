@extends('layouts.master')

@section('content')

<head>

    <link rel="stylesheet" href={{asset('assets/css/class.css')}}>

</head>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> Class
        </h3>
        <!-- <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href={{route('test.index')}}>Create test</a> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav> -->
    </div>
    <h1 class="mb-4">Tổng quan</h1>

    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="stats-card bg-white">
                <div class="stats-icon bg-danger bg-opacity-10">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </div>
                <h3 class="h6 text-muted">Lớp học</h3>
                <p class="h3 mb-0 total-class">{{$total_class}}</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card bg-white">
                <div class="stats-icon bg-success bg-opacity-10">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                    </svg>
                </div>
                <h3 class="h6 text-muted">Thành viên</h3>
                <p class="h3 mb-0">0</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card bg-white">
                <div class="stats-icon bg-warning bg-opacity-10">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="h6 text-muted">Đề thi ôn tập</h3>
                <p class="h3 mb-0">0</p>
            </div>
        </div>
    </div>

    <!-- Class List Section -->
    <div class="mb-4">
        <h2 class="h4 mb-4">Danh sách lớp học</h2>
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
                <div class="class-card bg-white">
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
                                <button class="btn btn-sm btn-outline-primary me-2">Sửa</button>
                                <button class="btn btn-sm btn-outline-danger">Xóa</button>
                            </div>
                            <button class="btn btn-sm btn-primary">Vào lớp học</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>

</div>


<!-- model -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Thêm lớp học mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="className" class="form-label">Class name</label>
                        <input type="text" class="form-control" id="className" name="class_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="classCode" class="form-label">Note</label>
                        <input type="text" class="form-control" id="classNote" name="class_note" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="creat-class-btn">Create</button>
            </div>
        </div>
    </div>
</div>
<script scr={{asset('vendor/jquery/jquery.min.js')}} ></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('addClassModal'));

        // You can add form submission logic here if needed
        document.querySelector('#addClassModal .btn-primary').addEventListener('click', function() {
            // Add your logic to save the new class
            console.log('Saving new class...');
            myModal.hide();
        });

        $('#creat-class-btn').click((e) => {
            let data = new FormData();
            data.append('_token', "{{csrf_token()}}");
            data.append('class_name', $('#className').val());
            data.append('class_note', $('#classNote').val())
            data.append('creator_id', '{{Auth::user()->id}}');
            $.ajax({
                type: 'post',
                url: "{{route('class.create')}}",
                data: data,
                dataType: 'json',
                contentType:false,
                processData:false,
                success: (response) => {
                    $('.total-class').text(response.current_total_class);
                    $('.class-container').append(`
                    
                        <div class="col-md-4 mt-4">
                            <div class="class-card bg-white">
                                <img src="https://placehold.co/200x400" alt="Classroom" class="class-image w-100">
                                <div class="p-3">
                                    <h3 class="h5">${response.new_class.class_name}</h3>
                                    <p class="text-muted small mb-3">Note: ${response.new_class.class_note}</p>
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
                                            <button class="btn btn-sm btn-outline-primary me-2">Sửa</button>
                                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Vào lớp học</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    });
</script>


@endsection