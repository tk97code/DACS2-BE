@extends('layouts.master')

@section('content')

<head>

    <link rel="stylesheet" href={{asset('assets/css/class.css')}}>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> Class
        </h3>
    </div>
    

    <!-- Class List Section -->
    <div class="mb-4">
        <h2 class="h4 mb-4">List of classes</h2>
        <div class="d-flex justify-content-between align-items-center">
            <div class="position-relative">
                <input type="search" class="search-box" placeholder="Nhập từ khóa tìm kiếm...">
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">Add new class</button>
        </div>

        <!-- Class Card -->
        <div class="row class-container">
            @foreach ($classes as $class)
            <div class="col-md-4 mt-4 class-{{$class->class_id}}">
                <div class="class-card bg-white" style="cursor: pointer;" onclick="classDetail('{{$class->class_id}}')">
                    <img src="https://placehold.co/200x400" alt="Classroom" class="class-image w-100">
                    <div class="p-3">
                        <h3 class="h5">{{$class->class_name}}</h3>
                        <p class="text-muted small mb-3">Note: {{$class->class_note}}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- <span class="text-muted small">
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
                            </span> -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                        data-class_id="{{$class->class_id}}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editClassModal" 
                                        data-class_id="{{$class->class_id}}" 
                                        data-class_name="{{$class->class_name}}" 
                                        data-class_note="{{$class->class_note}}"
                                        onclick="event.stopPropagation()">Edit</button>
                                <button class="btn btn-sm btn-outline-danger" id="delete-btn" data-class_id="{{$class->class_id}}" onclick="event.stopPropagation()">Delete</button>
                            </div>
                            <!-- <button class="btn btn-sm btn-primary" onclick="event.stopPropagation()">Vào lớp học</button> -->
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
                <h5 class="modal-title" id="addClassModalLabel">Add new class</h5>
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

<div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel">Edit class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editClassName" class="form-label">Class name</label>
                        <input type="text" class="form-control" id="editClassName" name="class_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editClassNote" class="form-label">Note</label>
                        <input type="text" class="form-control" id="editClassNote" name="class_note" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="creat-class-btn">Update</button>
            </div>
        </div>
    </div>
</div>



<script scr={{asset('vendor/jquery/jquery.min.js')}} ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function classDetail(class_id) {
        let url = "{{route('teacher.dashboard.class.show', ':class_id')}}";
        url = url.replace(':class_id', class_id);
        window.location.href = url;
    }
</script>
<script type="module">

    import * as sR0eggyJs from 'https://esm.run/@s-r0/eggy-js';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        var createModel = new bootstrap.Modal(document.getElementById('addClassModal'));

        // You can add form submission logic here if needed
        document.querySelector('#addClassModal .btn-primary').addEventListener('click', function() {
            // Add your logic to save the new class
            console.log('Saving new class...');
            createModel.hide();
        });

        var editModal = new bootstrap.Modal(document.getElementById('editClassModal'));

        $('#creat-class-btn').click((e) => {
            let data = new FormData();
            data.append('_token', "{{csrf_token()}}");
            data.append('class_name', $('#className').val());
            data.append('class_note', $('#classNote').val())
            data.append('creator_id', '{{Auth::user()->id}}');
            $.ajax({
                type: 'post',
                url: "{{route('teacher.dashboard.class.store')}}",
                data: data,
                dataType: 'json',
                contentType:false,
                processData:false,
                success: (response) => {
                    $('.total-class').text(response.current_total_class);
                    $('.class-container').append(`
                    
                        <div class="col-md-4 mt-4">
                            <div class="class-card bg-white" style="cursor: pointer;" onclick="classDetail(${response.new_class[0].class_id})">
                                <img src="https://placehold.co/200x400" alt="Classroom" class="class-image w-100">
                                <div class="p-3">
                                    <h3 class="h5">${response.new_class[0].class_name}</h3>
                                    <p class="text-muted small mb-3">Note: ${response.new_class[0].class_note}</p>
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
                                            <button class="btn btn-sm btn-outline-primary me-2 edit-btn" 
                                                    data-class_id="${response.new_class[0].class_id}" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editClassModal" 
                                                    data-class_id="${response.new_class[0].class_id}" 
                                                    data-class_name="${response.new_class[0].class_name}" 
                                                    data-class_note="${response.new_class[0].class_note}" 
                                                    onclick="event.stopPropagation()">
                                                    Edit
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" id="delete-btn" data-class_id="{{$class->class_id}}" onclick="event.stopPropagation()">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    
        $('#delete-btn').click((e) => {

            Swal.fire({
                title: 'Warning!',
                text: "Are you sure you want to delete class?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(isConfirm) {
                if (isConfirm) {
                    let data = new FormData();
                    let class_id = $(e.currentTarget).data("class_id")
                    let url = "{{route('teacher.dashboard.class.destroy', ':class_id')}}";
                    url = url.replace(':class_id', class_id);
                    data.append('_token', "{{csrf_token()}}");
                    $.ajax({
                        type: 'delete',
                        url: url,
                        data: data,
                        dataType: 'json',
                        contentType:false,
                        processData:false,
                        success: (response) => {
                            $('.total-class').text(response.current_total_class);
                            $(`.class-${class_id}`).remove();
                        }
                    });
                }
            })
        })
    
        $('#editClassModal .btn-primary').click(() => {
        let class_id = $('#editClassModal').data('class_id'); // Lấy ID từ modal
        let class_name = $('#editClassName').val();
        let class_note = $('#editClassNote').val();

        
        let data = new FormData();
        data.append('_token', "{{csrf_token()}}");
        data.append('class_name', class_name);
        data.append('class_note', class_note);

        let url = "{{route('teacher.update.class', ':class_id')}}";
        url = url.replace(':class_id', class_id);

        $.ajax({
            type: 'post',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (response) => {
                window.location.reload();
            }
        });
    });
    });

    $('.edit-btn').click((e) => {
        let button = $(e.currentTarget); // Nút được nhấn
        let class_id = button.data('class_id');
        let class_name = button.data('class_name');
        let class_note = button.data('class_note');
        
        // Gán giá trị vào modal
        $('#editClassName').val(class_name);
        $('#editClassNote').val(class_note);
        $('#editClassModal').data('class_id', class_id); // Lưu ID để sử dụng khi cập nhật
    });
</script>


@endsection