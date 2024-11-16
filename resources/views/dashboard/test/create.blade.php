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

    <!-- <form action={{route('test.create')}} method="post">
        @csrf
        <input type="text" name="nasme">
        <button type="submit">asdfsd</button>
    </form> -->


    <div class="row form-create-test">
        <div class="container my-4">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-10">
                    <div class="form">
                        <div class="mb-3">
                            <label class="form-label">
                                Name of test:
                            </label>
                            <input type="text" class="form-control test_name" name="test_name" placeholder="Enter name of test" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Class:
                            </label>
                            <select class="form-select" name="class_id" id="class_id" required>
                                <option disabled selected>Select class</option>
                                <option value="">No class (everyone can access)</option>
                                @foreach ($classes as $class)
                                <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Open Test:
                            </label>
                            <!-- <div class="selector"></div> -->
                            <div class="d-flex">

                                <input type="text" class="start_at form-control date-form" placeholder="Start time" data-input>

                                <input type="text" class="end_at form-control date-form mx-2" placeholder="End time" data-input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Time of test:</span>
                                <input type="number" class="form-control time_do_test" placeholder="00" style="text-align: center" data-input>
                                <span class="input-group-text">minutes</span>

                            </div>
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


                <!-- Right Column -->
                <div class="col-md-2 d-flex justify-content-center" style="background: #fff; padding: 10px; border-radius: 5px;">
                    <div class="toggle-container">
                        <h5 class="mb-4" style="text-align: center;">Option</h5>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input allow_show_answer" type="checkbox">
                            <label class="form-check-label">Show answer</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input allow_show_mark" type="checkbox">
                            <label class="form-check-label">Show mark</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input is_shuffle" type="checkbox">
                            <label class="form-check-label">Shuffle</label>
                        </div>
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

        flatpickr(".date-form", {
            enableTime: true,
            format: 'DD:MM:YYYY HH:ii'
        });

        // $('.form-create-question').hide();

        let testData = {
            _token: '{{csrf_token()}}',
            test_name: '',
            creator_id: "{{Auth::user()->id}}",
            class_id: '',
            start_at: '',
            end_at: '',
            time_do_test: '',
            allow_show_answer: '',
            allow_show_mark: '',
            is_shuffle: '',
        };

        let questionData = {
            _token: '{{csrf_token()}}',
            test_id: '',
            questions_arr: '',
        };

        $('.next-button').click((e) => {
            testData.test_name = $('.test_name').val();
            testData.class_id = document.getElementById('class_id').value;
            testData.start_at = new Date($('.start_at').val()).toISOString().slice(0, 19).replace('T', ' ');
            testData.end_at = new Date($('.end_at').val()).toISOString().slice(0, 19).replace('T', ' ');
            testData.time_do_test = $('.time_do_test').val();
            testData.allow_show_answer = Number($('.allow_show_answer').is(':checked'));
            testData.allow_show_mark = Number($('.allow_show_mark').is(':checked'));
            testData.is_shuffle = Number($('.is_shuffle').is(':checked'));

            let formData = new FormData();

            for (let key in testData) {
                formData.append(key, testData[key]);
            }

            
            $.ajax({
                type: 'POST',
                url: "{{route('test.store')}}",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    // console.log("Request success:", response.status);
                    // console.log("Request content:", response.request);
                    // Có thể thêm logic để chuyển trang hoặc hiển thị thông báo thành công
                    $('.form-create-test').hide();
                    $('.form-create-question').show();

                    // console.log(response)

                    questionData.test_id = response.test_id;
                    console.log(questionData.test_id);
                }
            });


        });


        $('#create-test-button').click((e) => {

            let formData = new FormData();
            formData.append("_token", questionData._token);
            formData.append('test_id', questionData.test_id);
            formData.append('questions_arr', JSON.stringify(questions_arr));

            $.ajax({
                type: 'POST',
                url: "{{route('question.store')}}",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("Request success:", response.status);
                    console.log("Request content:", response.question);
                }
            });
        });







        // HEAD: merge question and test data
        // let testData = {
        //     _token: '{{csrf_token()}}',
        //     test_name: '',
        //     creator: "{{Auth::user()->id}}",
        //     class_id: '',
        //     start_at: '',
        //     end_at: '',
        //     time_do_test: '',
        //     allow_show_answer: '',
        //     allow_show_mark: '',
        //     is_shuffle: '',
        //     questions: [] // Mảng để lưu các câu hỏi
        // };

        // $('.next-button').click((e) => {
        //     e.preventDefault();

        //     // Lưu dữ liệu form bài thi vào biến tạm testData
        //     testData.test_name = $('.test_name').val();
        //     testData.class_id = document.getElementById('class_id').value;
        //     testData.start_at = new Date($('.start_at').val());
        //     testData.end_at = new Date($('.start_at').val());
        //     testData.time_do_test = $('.time_do_test').val();
        //     testData.allow_show_answer = Number($('.allow_show_answer').is(':checked'));
        //     testData.allow_show_mark = Number($('.allow_show_mark').is(':checked'));
        //     testData.is_shuffle = Number($('.is_shuffle').is(':checked'));

        //     // Chuyển sang form câu hỏi
        //     $('.form-create-test').hide();
        //     $('.form-create-question').show();
        // });

        // $('#create-test-button').click((e) => {
        //     e.preventDefault();

        //     // Chuẩn bị dữ liệu để gửi
        //     let formData = new FormData();

        //     testData.questions.push(questions_arr)

        //     for (let key in testData) {
        //         if (key === 'questions') {
        //             // Nếu là mảng câu hỏi, stringify để truyền vào
        //             formData.append(key, JSON.stringify(testData[key]));
        //         } else {
        //             formData.append(key, testData[key]);
        //         }
        //     }

        //     // Gửi yêu cầu AJAX lên server
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{route('test.create')}}",
        //         data: formData,
        //         dataType: 'json',
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             console.log("Request success:", response.status);
        //             console.log("Request content:", response.request);
        //             // Có thể thêm logic để chuyển trang hoặc hiển thị thông báo thành công
        //         }
        //     });
        // });
        // END:
    });
</script>


@endsection