@extends('layouts.master')

@section('content')

<head>
    <!-- <link rel="stylesheet" href="{{asset('assets/css/do-test.css')}}"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css" integrity="sha384-nB0miv6/jRmo5UMMR1wu3Gz6NLsoTkbqJghGIsx//Rlm+ZU03BU6SQNC66uf4l5+" crossorigin="anonymous">

    <!-- The loading of KaTeX is deferred to speed up page rendering -->
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js" integrity="sha384-7zkQWkzuo3B5mTepMUcHkMB5jZaolc2xDwL6VFqjFALcbeS9Ggm/Yr2r3Dy4lfFg" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('assets/css/result.css')}}">

</head>


<div class="content-wrapper">
    <div class="container-fluid">

        <div class="col-md-8 left-panel mx-auto">
            <h1 class="h4 mb-4">Result of test</h1>

            <div class="row mb-5">
                <div class="col-md-8">
                    <h2 class="h5 mb-3">Infomation</h2>
                    <div class="mb-3">
                        <label class="fw-bold">Full name:</label>
                        <div>{{Auth::user()->name}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Email:</label>
                        <div>{{Auth::user()->email}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Test:</label>
                        <div>{{$test->test_name}}</div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <h2 class="h5 mb-3">Score:</h2>
                    <div class="score-circle mx-auto">
                        <svg width="150" height="150">
                            <circle class="score-background" cx="75" cy="75" r="70" />
                            <circle class="score-progress" cx="75" cy="75" r="70"
                                stroke-dasharray="440" stroke-dashoffset="{{ 440 - (440 * ($result->score*10) / 100) }}" />
                        </svg>
                        <div class="score-text">{{$result->score}}</div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="h5 mb-3">THÔNG TIN</h2>
                <div class="row mb-3">
                    <div class="col-md-6">Thời gian làm: 00:00:18</div>
                    <div class="col-md-6">Thời gian kết thúc bài thi: 16:12 27/11/2024</div>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" style="width: 14%"></div>
                    <div class="progress-bar bg-danger" style="width: 86%"></div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div class="fw-bold">Hoàn thành</div>
                        <div>14%</div>
                    </div>
                    <div class="col">
                        <div class="fw-bold">Số câu đúng</div>
                        <div>3</div>
                    </div>
                    <div class="col">
                        <div class="fw-bold">Số câu sai</div>
                        <div>2</div>
                    </div>
                    <div class="col">
                        <div class="fw-bold">Số câu bỏ trống</div>
                        <div>29</div>
                    </div>
                </div>
            </div>

            @if ($test->allow_show_answer)
            <div class="mb-4">
                <h2 class="h5 mb-3">Result Detail</h2>

                <div class="d-flex gap-2 mb-3">
                    @foreach ($testDetail as $detail)
                        <button class="question-number question-nav-btn">{{$loop->iteration}}</button>
                    @endforeach
                </div>
                <hr>

                <div class="question-section">
                    @foreach ($questions as $question)
                    <div class="">
                        <h2 class="h4 mb-4" id="question-id-{{$loop->iteration}}-title">
                            Question {{$loop->iteration}}: {!!$question->question_content!!}
                        </h2>
                        @foreach ($question->options as $option)
                        @php
                        $resultDetail = App\Models\ResultDetailModel::where('result_id', $result->result_id)
                        ->where('question_id', $question->question_id)->first();
                        @endphp
                        <div class="box">
                            <input type="radio" name="choosed_option-{{ $loop->parent->iteration }}"
                                data-option_id="{{$option->option_id}}"
                                @if ($resultDetail->choosed_option_id === $option->option_id)
                                checked
                                @endif
                            data-question_id="{{$question->question_id}}"
                            class="option-radio question-id-{{$loop->parent->iteration}}-input"
                            id="option-question{{ $loop->parent->iteration }}-{{ $loop->iteration }}">

                            <label id="question-id-{{ $loop->parent->iteration }}-label"
                                @if ($option->is_answer)
                                    class="option option-correct"
                                    style="background: #98D8AA; border-color: #98D8AA;"
                                @else
                                    class="option option-incorrect"
                                @endif
                                class="option-{{ $loop->parent->iteration }}-{{ $loop->iteration }}">
                                <div class="dot"></div>
                                <div class="text">{!!$option->option_content!!}</div>
                            </label>
                        </div>
                        @endforeach

                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        

    </div>
</div>


</div>

<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js" integrity="sha384-43gviWU0YVjaDtb/GhzOouOXtZMP/7XUzwPTstBeZFe/+rCMvRwr4yROQP43s0Xk" crossorigin="anonymous"
    onload="renderMathInElement(document.body);"></script>

@endsection