<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href={{asset("assets/vendors/mdi/css/materialdesignicons.min.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/ti-icons/css/themify-icons.css")}}>
    <link rel="stylesheet" href={{asset("assets/vendors/css/vendor.bundle.base.css")}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset("assets/vendors/font-awesome/css/font-awesome.min.css")}}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{asset("assets/vendors/font-awesome/css/font-awesome.min.css")}}>
    <!-- <link rel="stylesheet" href={{asset("assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css")}}> -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" type="text/css" href={{asset("assets/css/style.css")}}>
    <!-- End layout styles -->
    <link rel="shortcut icon" href={{asset("assets/images/favicon.png")}}>

    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>
    <link rel="stylesheet" href="{{asset('assets/css/do-test.css')}}">
</head>

<body>

    <nav class="quiz-header navbar navbar-expand-sm fixed-top justify-content-center">
        <!-- <div class="d-flex justify-content-between align-items-center"> -->
        <div class="container-fluid">
            <a href="#" class="logo nav-brand">
                <div></div>
                <img class="logo-icon" src="{{asset('assets/images/logo.png')}}" alt="">
            </a>
            <span class="nav-item">Test: {{$test->test_name}}</span>
            <span class="nav-item">Student: {{Auth::user()->name}}</span>

            <!-- <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                    </svg>
                </button>
                <button class="btn btn-light">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <img src="/placeholder.svg?height=32&width=32" alt="User" class="rounded-circle">
            </div> -->
        </div>
    </nav>

    <main class="container-fluid quiz-container">
        <div class="row">
            <div class="col-md-8 left-panel">
                <!-- Question 1 -->
                @foreach ($questions as $question)
                <div class="question-card">
                    <h2 class="h4 mb-4" id="question-id-{{$loop->iteration}}-title">
                        {{$question->question_content}}
                    </h2>
                    @foreach ($question->options as $option)
                    <div class="box">
                        <input type="radio" name="choosed_option-{{ $loop->parent->iteration }}"
                            data-option_id="{{$option->option_id}}"
                            data-question_id="{{$question->question_id}}"
                            class="option-radio question-id-{{$loop->parent->iteration}}-input"
                            id="option-question{{ $loop->parent->iteration }}-{{ $loop->iteration }}">

                        <label for="option-question{{ $loop->parent->iteration }}-{{ $loop->iteration }}"
                            id="question-id-{{ $loop->parent->iteration }}-label"
                            class="option-{{ $loop->parent->iteration }}-{{ $loop->iteration }} option-label">
                            <div class="dot"></div>
                            <div class="text">{{$option->option_content}}</div>
                        </label>
                    </div>
                    @endforeach

                    <h2 class="btn h5 btn btn-outline-primary mt-4 btn-clear" id="question-id-{{$loop->iteration}}-clear">
                        Clear
                    </h2>

                </div>
                @endforeach
            </div>

            <div class="col-md-4 right-panel">
                <!-- Timer Card -->
                <div class="timer-card">
                    <div class="finish-text">FINISH BEFORE</div>
                    <!-- <div class="timer-circle">
                        {{$test->time_do_test}}:00
                    </div> -->
                    <div id="revese-timer" data-minute="{{$test->time_do_test}}"></div>
                </div>

                <!-- Question Navigation -->
                <div class="question-card question-list mt-4">
                    <div class="question-nav">
                        @foreach ($questions as $question)
                        <button class="question-nav-btn" id="question-id-{{$loop->iteration}}-btn">
                            {{$loop->iteration}}
                        </button>
                        @endforeach
                    </div>
                    <button class="btn btn-outline-primary btn-submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>


    </main>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            var data = new FormData();
            data.append('_token', '{{csrf_token()}}');
            data.append('test_id', '{{$test->test_id}}');
            data.append('id', '{{Auth::user()->id}}');
            $.ajax({
                type: 'POST',
                url: "{{route('studentResult.getTimePassed', ['id' => $test->test_id])}}",
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (response) => {
                    if (('{{$test->time_do_test}}' * 60 - response.time_passed) < 0) {
                        // document.body.innerHTML = '';
                        // Swal.fire({
                        //     title: 'Error!',
                        //     text: "You have run out of time to do the test",
                        //     icon: 'error',
                        //     confirmButtonText: 'Go back'
                        // }).then(function(isConfirm) {
                        //     if (isConfirm) {
                        //         window.location.href = '{{route("student.dashboard.class.index")}}'
                        //     }
                        // })
                    } else {
                        if ($('#revese-timer').length) {

                            const FULL_DASH_ARRAY = 283;
                            const WARNING_THRESHOLD = 20;
                            const ALERT_THRESHOLD = 15;

                            const COLOR_CODES = {
                                info: {
                                    color: "green"
                                },
                                warning: {
                                    color: "orange",
                                    threshold: WARNING_THRESHOLD
                                },
                                alert: {
                                    color: "red",
                                    threshold: ALERT_THRESHOLD
                                }
                            };


                            var Minute = $('#revese-timer').data('minute');
                            var Seconds = Math.round(60 * Minute);
                            const TIME_LIMIT = Seconds;
                            let timePassed = Number('{{$time_passed}}');
                            let timeLeft = TIME_LIMIT;
                            let timerInterval = null;
                            let remainingPathColor = COLOR_CODES.info.color;

                            document.getElementById("revese-timer").innerHTML = `
                                <div class="base-timer">
                                <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <g class="base-timer__circle">
                                    <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                                    <path
                                        id="base-timer-path-remaining"
                                        stroke-dasharray="283"
                                        class="base-timer__path-remaining ${remainingPathColor}"
                                        d="
                                        M 50, 50
                                        m -45, 0
                                        a 45,45 0 1,0 90,0
                                        a 45,45 0 1,0 -90,0
                                        "
                                    ></path>
                                    </g>
                                </svg>
                                <span id="base-timer-label" class="base-timer__label">${formatTime(
                                    timeLeft
                                )}</span>
                                </div>
                            `;

                            startTimer();

                            function onTimesUp() {
                                clearInterval(timerInterval);
                            }

                            function startTimer() {
                                timerInterval = setInterval(() => {
                                    timePassed = timePassed += 1;
                                    timeLeft = TIME_LIMIT - timePassed;
                                    document.getElementById("base-timer-label").innerHTML = formatTime(
                                        timeLeft
                                    );
                                    setCircleDasharray();
                                    setRemainingPathColor(timeLeft);

                                    if (timeLeft === 0) {
                                        onTimesUp();
                                    }
                                }, 1000);
                            }

                            function formatTime(time) {
                                const minutes = Math.floor(time / 60);
                                let seconds = time % 60;

                                if (seconds < 10) {
                                    seconds = `0${seconds}`;
                                }

                                return `${minutes}:${seconds}`;
                            }

                            function setRemainingPathColor(timeLeft) {
                                const {
                                    alert,
                                    warning,
                                    info
                                } = COLOR_CODES;
                                if (timeLeft <= alert.threshold) {
                                    document
                                        .getElementById("base-timer-path-remaining")
                                        .classList.remove(warning.color);
                                    document
                                        .getElementById("base-timer-path-remaining")
                                        .classList.add(alert.color);
                                } else if (timeLeft <= warning.threshold) {
                                    document
                                        .getElementById("base-timer-path-remaining")
                                        .classList.remove(info.color);
                                    document
                                        .getElementById("base-timer-path-remaining")
                                        .classList.add(warning.color);
                                }
                            }

                            function calculateTimeFraction() {
                                const rawTimeFraction = timeLeft / TIME_LIMIT;
                                return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
                            }

                            function setCircleDasharray() {
                                const circleDasharray = `${(calculateTimeFraction() * FULL_DASH_ARRAY).toFixed(0)} 283`;
                                document
                                    .getElementById("base-timer-path-remaining")
                                    .setAttribute("stroke-dasharray", circleDasharray);
                            }

                        }
                    }
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('studentResult.getSubmittedStatus', ['id' => $test->test_id])}}",
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (response) => {
                    document.body.innerHTML = '';
                    if (response.submitted) {
                        Swal.fire({
                            title: 'Error!',
                            text: "This test is submitted",
                            icon: 'error',
                            confirmButtonText: 'Go back'
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.href = '{{route("student.dashboard.class.index")}}'
                            }
                        })
                    }
                }
            });

            function getCurrentDateTime() {
                const now = new Date();

                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Lấy tháng (0-11) + 1 để chuyển sang (1-12)
                const day = String(now.getDate()).padStart(2, '0'); // Lấy ngày trong tháng
                const hours = String(now.getHours()).padStart(2, '0'); // Lấy giờ
                const minutes = String(now.getMinutes()).padStart(2, '0'); // Lấy phút
                const seconds = String(now.getSeconds()).padStart(2, '0'); // Lấy giây

                // Trả về theo định dạng Y-m-d H:i:s
                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }

            function getElapsedMinutes() {
                const current = getCurrentDateTime();
                const enter = '{{$result->enter_time}}';

                const current_date = new Date(current.replace(" ", "T"));
                const enter_date = new Date(enter.replace(" ", "T"));


                const elapsed_time = current_date - enter_date;

                console.log(elapsed_time * 1000);

                return elapsed_time / 1000;
            }

            // --------Reveser-timer-----------

            // --------End-Reveser-timer-----------

            $('.question-nav-btn').click((e) => {
                let question_id = e.currentTarget.id.replace('btn', 'title');
                window.scrollTo(0, document.getElementById(question_id).offsetTop - 128 - 32);
                // console.log(e.currentTarget.id);
            });

            $('input[type="radio"].option-radio').on('change', function(e) {
                let question_id = e.currentTarget.classList[1].replace('input', 'btn')
                let question_button = document.getElementById(question_id);

                if ($('input[type="radio"].option-radio:checked').length > 0) {
                    question_button.classList.add('question-button-selected'); // Thêm class nếu có radio được chọn
                } else {
                    question_button.classList.remove('question-button-selected'); // Xóa class nếu không có radio nào được chọn
                }
            });


            $('.btn-clear').click((e) => {
                let btn_clear_id = e.currentTarget.id.replace('clear', 'input');
                console.log(btn_clear_id)
                let btn_clear = document.getElementsByClassName(btn_clear_id);
                console.log(btn_clear);
                Array.from(btn_clear).forEach(element => {
                    element.checked = false;
                    $(element).trigger('change');
                });
            });

            function convertToSecond(time) {
                const [minutes, seconds] = time.split(':').map(Number); // Tách chuỗi và chuyển sang số
                return minutes * 60 + seconds; // Tính tổng số giây
            }

            window.onbeforeunload = (e) => {
                time = $('#base-timer-label').text();
                let elapsed_time = Number('{{$test->time_do_test}}') * 60 - convertToSecond(time);
                let data = new FormData();
                data.append('_token', '{{csrf_token()}}');
                data.append('elapsed_time', elapsed_time);
                data.append('test_id', '{{$test->test_id}}');
                data.append('id', '{{Auth::user()->id}}');
                $.ajax({
                    type: 'POST',
                    url: "{{route('studentResult.updateElapsedTime', ['id' => $test->test_id])}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                });
            };


            $('.btn-submit').click((e) => {
                let choosed_option_arr = [];
                Array.from(document.querySelectorAll('input[type="radio"]:checked')).forEach((el) => {
                    let option_detail = [];
                    option_detail.push(el.dataset.question_id);
                    option_detail.push(el.dataset.option_id);
                    choosed_option_arr.push(JSON.stringify(option_detail));
                });

                let data = new FormData();

                data.append('_token', '{{csrf_token()}}');
                data.append('test_id', '{{$test->test_id}}');
                data.append('choosed_option_arr', JSON.stringify(choosed_option_arr));
                $.ajax({
                    type: 'post',
                    url: "{{route('studentResult.storeResult', ['id' => $test->test_id])}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: (response) => {

                    }
                });
            });
        });
    </script>
</body>

</html>