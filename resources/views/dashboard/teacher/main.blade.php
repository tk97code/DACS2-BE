@extends('layouts.master')

@section('content')

<head>

<link rel="stylesheet" href={{asset('assets/css/class.css')}}>

</head>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
    </div>
    <h1 class="mb-4">Overview</h1>

<!-- Stats Cards -->
<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="stats-card bg-white">
            <div class="stats-icon bg-danger bg-opacity-10">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
            <h3 class="h6 text-muted">Classes</h3>
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
            <h3 class="h6 text-muted">Students</h3>
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
            <h3 class="h6 text-muted">Review Test</h3>
            <p class="h3 mb-0">0</p>
        </div>
    </div>
</div>
    
    <!-- <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">Increased by 60%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">45,6334</h2>
                    <h6 class="card-text">Decreased by 10%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Tickets</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Assignee </th>
                                    <th> Subject </th>
                                    <th> Status </th>
                                    <th> Last Update </th>
                                    <th> Tracking ID </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{asset('assets/images/faces/face1.jpg')}}" class="me-2" alt="image"> David Grey
                                    </td>
                                    <td> Fund is not recieved </td>
                                    <td>
                                        <label class="badge badge-gradient-success">DONE</label>
                                    </td>
                                    <td> Dec 5, 2017 </td>
                                    <td> WD-12345 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{asset('assets/images/faces/face2.jpg')}}" class="me-2" alt="image"> Stella Johnson
                                    </td>
                                    <td> High loading time </td>
                                    <td>
                                        <label class="badge badge-gradient-warning">PROGRESS</label>
                                    </td>
                                    <td> Dec 12, 2017 </td>
                                    <td> WD-12346 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{asset('assets/images/faces/face3.jpg')}}" class="me-2" alt="image"> Marina Michel
                                    </td>
                                    <td> Website down for one week </td>
                                    <td>
                                        <label class="badge badge-gradient-info">ON HOLD</label>
                                    </td>
                                    <td> Dec 16, 2017 </td>
                                    <td> WD-12347 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{asset('assets/images/faces/face4.jpg')}}" class="me-2" alt="image"> John Doe
                                    </td>
                                    <td> Loosing control on server </td>
                                    <td>
                                        <label class="badge badge-gradient-danger">REJECTED</label>
                                    </td>
                                    <td> Dec 3, 2017 </td>
                                    <td> WD-12348 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body p-0 d-flex">
                    <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Updates</h4>
                    <div class="d-flex">
                        <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                            <i class="mdi mdi-account-outline icon-sm me-2"></i>
                            <span>jack Menqu</span>
                        </div>
                        <div class="d-flex align-items-center text-muted font-weight-light">
                            <i class="mdi mdi-clock icon-sm me-2"></i>
                            <span>October 3rd, 2018</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 pe-1">
                            <img src="{{asset('assets/images/dashboard/img_1.jpg')}}" class="mb-2 mw-100 w-100 rounded" alt="image">
                            <img src="{{asset('assets/images/dashboard/img_4.jpg')}}" class="mw-100 w-100 rounded" alt="image">
                        </div>
                        <div class="col-6 ps-1">
                            <img src="{{asset('assets/images/dashboard/img_2.jpg')}}" class="mb-2 mw-100 w-100 rounded" alt="image">
                            <img src="{{asset('assets/images/dashboard/img_3.jpg')}}" class="mw-100 w-100 rounded" alt="image">
                        </div>
                    </div>
                    <div class="d-flex mt-5 align-items-top">
                        <img src="{{asset('assets/images/faces/face3.jpg')}}" class="img-sm rounded-circle me-3" alt="image">
                        <div class="mb-0 flex-grow">
                            <h5 class="me-2 mb-2">School Website - Authentication Module.</h5>
                            <p class="mb-0 font-weight-light">It is a long established fact that a reader will be distracted by the readable content of a page.</p>
                        </div>
                        <div class="ms-auto">
                            <i class="mdi mdi-heart-outline text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Due Date </th>
                                    <th> Progress </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Herman Beck </td>
                                    <td> May 15, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Messsy Adam </td>
                                    <td> Jul 01, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> John Richards </td>
                                    <td> Apr 12, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Peter Meggik </td>
                                    <td> May 15, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td> Edward </td>
                                    <td> May 03, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td> Ronald </td>
                                    <td> Jun 05, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-dark">Todo List</h4>
                    <div class="add-items d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                        <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                    </div>
                    <div class="list-wrapper">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked> Call John </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Create invoice </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Print Statements </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

@endsection