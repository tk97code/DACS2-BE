@extends('layouts.master')

@section('content')

<head>

    <style>
        :root {
            --primary-color: #4763E4;
            --danger-color: #dc3545;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 8px;
        }

        .nav-tabs .nav-link {
            color: #666;
            border: none;
            padding: 0.5rem 1rem;
            margin-right: 1rem;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            background: none;
        }

        .search-box {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 8px 15px;
            width: 300px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .exam-card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .exam-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .exam-image {
            height: 150px;
            object-fit: cover;
        }

        .btn-exam {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
        }

        .btn-exam:hover {
            background-color: #a8a4e9;
            border-color: #a8a4e9;
        }

        .exam-container {
            padding: 20px;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .truncate {
            /* Avoids text being rendered outside the container */
            width: 100%;
            overflow: hidden;
            /* Avoid text going to multiple lines */
            white-space: nowrap;
            /* Sets the ... once the text overflows */
            text-overflow: ellipsis;
        }
    </style>

</head>

<div class="content-wrapper">

    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="#" class="logo">
                <div class="logo-icon"></div>
                <span>{{$class->class_name}}</span>
            </a>
            <button class="btn btn-danger">Trở về</button>
        </div>

        <!-- Navigation -->
        <ul class="nav nav-tabs border-0 mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="#">Đề thi ôn tập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Bài kiểm tra</a>
            </li>
        </ul>

        <!-- Search and Exam Count -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="search" class="search-box" placeholder="Nhập từ khóa tìm kiếm...">
            <span>4 Đề thi</span>
        </div>

        <!-- Exam Cards -->
        <div class="row">
            @foreach ($tests as $test)
            <div class="col-md-3 mb-4">
                <div class="card exam-card">
                    <img src="https://placehold.co/150x300" alt="Exam" class="exam-image w-100">
                    <div class="card-body">
                        <h5 class="card-title truncate">{{$test->test_name}}</h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3"></path>
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                                {{$test->start_at}} to {{$test->end_at}}
                            </small>
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">
                                <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                0
                            </span>
                            <span class="text-muted small">
                                <svg width="16" height="16" fill="none" stroke="currentColor" class="me-1" viewBox="0 0 24 24">
                                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                0
                            </span>
                        </div>
                        @if ($is_entered_test[$test->test_id])
                            
                            <button class="btn btn-exam w-100" onclick="goTest('{{$test->test_id}}')">Continue test</button>
                        @else
                            @if ($test->start_at > now()->format('Y-m-d H:i:s'))
                            <button class="btn btn-exam w-100 disabled" onclick="goTest('{{$test->test_id}}')">Test not opened</button>
                            @elseif ($test->end_at < now()->format('Y-m-d H:i:s'))
                            <button class="btn btn-exam w-100 disabled" onclick="goTest('{{$test->test_id}}')">Test closed</button>
                            @else
                            <button class="btn btn-exam w-100" onclick="goTest('{{$test->test_id}}')">Enter test</button>
                            @endif
                        @endif

                        <button class="btn w-100 mt-2 btn-success">Get result</button>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

</div>




<script>
    function goTest(test_id) {
        let url = "{{route('student.dashboard.test.show', ':test_id')}}";
        url = url.replace(':test_id', test_id);
        window.location.href = url;
    };
</script>

@endsection