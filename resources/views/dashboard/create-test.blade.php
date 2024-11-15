@extends('layouts.master')


@section('content')

<head>
    <style>
        .editor {
            width: 100%;
            /* margin: 50px auto 40px; */
            height: 500px;
            display: flex;
        }

        .editor__code {
            position: relative;
            border: none;
            /* flex-basis: 50%; */
            width: 100%;
        }

        .editor__code>* {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            background: #f8f9fa;
            padding: 0.75rem;
            border-radius: 50%;
            margin: 0 auto 1rem;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .thumbnail {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
            cursor: pointer;
        }

        .next-button {
            background: linear-gradient(to right, #0d6efd, #0b5ed7);
            border: none;
            padding: 0.5rem 2rem;
        }

        .required {
            color: #dc3545;
        }

        .form-label {
            font-weight: 500;
        }
    </style>

    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flatpickr/flatpickr.min.css')}}">

</head>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> Exam/Create test
        </h3>
    </div>

    <!-- <form action={{route('create-test.handle')}} method="post">
        @csrf
        <input type="text" name="nasme">
        <button type="submit">asdfsd</button>
    </form> -->


    <div class="row form-create-test">
        <div class="container my-4">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-4">
                    <h5 class="mb-3">Ảnh đề thi</h5>
                    <div class="upload-area mb-3">
                        <div class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <p class="text-muted mb-0">Tải ảnh lên hoặc chọn ảnh đề thi</p>
                    </div>

                    <h6 class="mb-2">Chọn ảnh đại diện</h6>
                    <div class="thumbnail-grid">
                        <img src="https://placehold.co/100x150" alt="Thumbnail 1" class="thumbnail">
                        <img src="https://placehold.co/100x150" alt="Thumbnail 2" class="thumbnail">
                        <img src="https://placehold.co/100x150" alt="Thumbnail 3" class="thumbnail">
                        <img src="https://placehold.co/100x150" alt="Thumbnail 4" class="thumbnail">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="form">
                        <div class="mb-3">
                            <label class="form-label">
                                Name of test<span class="required">*</span>
                            </label>
                            <input type="text" class="form-control test_name" name="test_name" placeholder="Enter name of test" required>
                            <div class="form-text text-danger">This field is required.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Class<span class="required">*</span>
                            </label>
                            <select class="form-select" name="class_id" id="class_id" required>
                                <option value="" selected>Select class</option>
                                @foreach ($classes as $class)
                                <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            <div class="form-text text-danger">This field is required.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Open Test:<span class="required">*</span>
                            </label>
                            <!-- <div class="selector"></div> -->
                            <div>

                                <input type="text" class="datepicker start_at" placeholder="Start time" data-input>

                                <input type="text" class="datepicker end_at" placeholder="End time" data-input>

                            </div>
                            <!-- <div class="form-text text-danger">This field is required.</div> -->
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Time of Test:<span class="required">*</span>
                            </label>
                            <!-- <div class="selector"></div> -->
                            <div>

                                <input type="number" class="form-control time_do_test" placeholder="00" data-input>

                            </div>
                            <!-- <div class="form-text text-danger">This field is required.</div> -->
                        </div>

                        


                        <div class="mb-4">  
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="5" name="description" placeholder="For description"></textarea>
                        </div>

                        <button class="btn btn-primary next-button">
                            Next step
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row form-create-question">
        <div class="col-6 grid-margin">
            <div class="editor">
                <div class="editor__code">
                    <div id="editorCode"></div>
                </div>
            </div>
        </div>
        <div class="col-6 grid-margin">
            <div class="card">
                <h3>Kết quả xem trước</h3>
                <div class="card-body">
                    <div id="preview"></div>
                    <div id="content-preview"></div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary" id="create-test-button">
            Create test
        </button>
    </div>

</div>
<script src={{asset('vendor/jquery/jquery.min.js')}}></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendors/flatpickr/flatpickr.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/loader.js"></script>
<script type="module" src={{asset('assets/js/create-test.js')}}></script>

<script>
    $(document).ready(() => {

        flatpickr(".datepicker", {
            enableTime: true,
            format: 'DD:MM:YYYY HH:ii'
        });

        $('.form-create-question').hide();

        let testData = {
            _token: '{{csrf_token()}}',
            test_name: '',
            creator: "{{Auth::user()->id}}",
            class_id: '',
            start_at: '',
            end_at: '',
            time_do_test: '',
            questions: [] // Mảng để lưu các câu hỏi
        };



        // $('#create-test-btn').click((e) => {
        //     e.preventDefault();

        //     let data = new FormData();
        //     data.append('_token', '{{csrf_token()}}');
        //     data.append('test_name', $('.test_name').val());
        //     data.append('creator', "{{Auth::user()->id}}");
        //     data.append('questions_arr', JSON.stringify(questions_arr));

        //     $.ajax({
        //         type: "POST",
        //         url: "{{route('create-test.handle')}}",
        //         data: data,
        //         dataType: 'json',
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             console.log("Request success:", response);
        //         }
        //     });
        // });

        $('.next-button').click((e) => {
            e.preventDefault();

            // Lưu dữ liệu form bài thi vào biến tạm testData
            testData.test_name = $('.test_name').val();
            testData.class_id = document.getElementById('class_id').value;

            // Chuyển sang form câu hỏi
            $('.form-create-test').hide();
            $('.form-create-question').show();
        });

        $('#create-test-button').click((e) => {
            e.preventDefault();

            // Chuẩn bị dữ liệu để gửi
            let formData = new FormData();

            testData.questions.push(questions_arr)

            for (let key in testData) {
                if (key === 'questions') {
                    // Nếu là mảng câu hỏi, stringify để truyền vào
                    formData.append(key, JSON.stringify(testData[key]));
                } else {
                    formData.append(key, testData[key]);
                }
            }

            // Gửi yêu cầu AJAX lên server
            $.ajax({
                type: 'POST',
                url: "{{route('create-test.handle')}}",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("Request success:", response.status);
                    console.log("Request content:", response.request);
                    // Có thể thêm logic để chuyển trang hoặc hiển thị thông báo thành công
                }
            });
        });
    });
</script>


@endsection