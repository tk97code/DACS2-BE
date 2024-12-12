@extends('layouts.master')


@section('content')

<head>
    <style>
        .choices__inner {
            border-radius: 5px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
        }

        .choices__item--selectable {
            background-color: #e9ecef;
            color: #495057;
        }

        .choices__list--dropdown {
            border-radius: 5px;
        }
        .editor {
            width: 100%;
            /* margin: 50px auto 40px; */
            height: 500px;
            display: flex;
        }

        #editor {
            height: 500px;
            background-color: white;
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

    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css" integrity="sha384-nB0miv6/jRmo5UMMR1wu3Gz6NLsoTkbqJghGIsx//Rlm+ZU03BU6SQNC66uf4l5+" crossorigin="anonymous">

    <!-- The loading of KaTeX is deferred to speed up page rendering -->
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js" integrity="sha384-7zkQWkzuo3B5mTepMUcHkMB5jZaolc2xDwL6VFqjFALcbeS9Ggm/Yr2r3Dy4lfFg" crossorigin="anonymous"></script>

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="{{asset('assets/js/image-resize.min.js')}}"></script>

    <!-- <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/base.min.css" />                                                                    -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />

</head>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> Exam/Create test
        </h3>
    </div>

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
                            <select class="form-select choices" name="class_id" id="class_id" multiple required>
                                <!-- <option disabled selected>Select class</option> -->
                                <option value="0">No class (everyone can access)</option>
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
                            <div class="d-flex input-group">
                                <input type="text" class="start_at form-control date-form" placeholder="Start time" data-input>
                                <span class="input-group-text">to</span>
                                <input type="text" class="end_at form-control date-form" placeholder="End time" data-input>
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
            <div id="editor">
                <!-- <div class="editor__code">
                    <div id="editorCode"></div>
                </div> -->
            </div>
        </div>
        <div class="col-6 grid-margin">
            <div class="card">
                <h3>Preview</h3>
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
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js" integrity="sha384-43gviWU0YVjaDtb/GhzOouOXtZMP/7XUzwPTstBeZFe/+rCMvRwr4yROQP43s0Xk" crossorigin="anonymous"
        onload="renderMathInElement(document.body);"></script>

<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendors/flatpickr/flatpickr.js')}}"></script>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/loader.js"></script> -->
<script type="module" src={{asset('assets/js/create-test.js')}}></script>

<!-- Include Choices JavaScript (latest) -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Or versioned -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

<script>

    var created_question = 0;
    var test_id = "";

    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('.choices');
        elements.forEach(element => {
            new Choices(element, {
                removeItemButton: true, // Cho phép xóa các lựa chọn
                placeholderValue: 'Select class', // Placeholder
                noResultsText: 'No matches found', // Text khi không có kết quả
                maxItemCount: -1, // Giới hạn số lượng chọn
                searchPlaceholderValue: 'Search for classes...', // Placeholder của thanh tìm kiếm
                shouldSort: false
            });
        });

        window.onbeforeunload = (e) => {
            if (created_question == 0 && test_id != '') {
                let url = "{{route('teacher.dashboard.test.destroy', ':test_id')}}";
                url = url.replace(':test_id',test_id);
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                        'Content-Type': 'application/json',
                    },
                    success: function(response) {
                    }
                });
            }
        };
    });


    $(document).ready(() => {

        flatpickr(".date-form", {
            enableTime: true,
            format: 'DD:MM:YYYY HH:ii'
        });

        $('.form-create-question').hide();

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
            testData.class_id = $('#class_id').val();
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


            // console.log(testData.class_id);


            $.ajax({
                type: 'POST',
                url: "{{route('teacher.dashboard.test.store')}}",
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
                    test_id = response.test_id;
                    questionData.test_id = response.test_id;
                    console.log(questionData.test_id);
                }
            });


        });


        $('#create-test-button').click((e) => {

            let formData = new FormData();
            formData.append("_token", questionData._token);
            formData.append('test_id', questionData.test_id);
            let sanitizedQuestions = questions_arr.map(question => {
                let { lineElement, ...rest } = question; // Tách lineElement và giữ phần còn lại
                return rest;
            });
            formData.append('questions_arr', JSON.stringify(sanitizedQuestions));

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

                    created_question = 1;

                    window.location.href = "{{route('teacher.dashboard.test.index')}}";
                }
            });
        });

    });
</script>


@endsection