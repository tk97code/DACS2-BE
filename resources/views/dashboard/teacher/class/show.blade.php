@extends('layouts.master')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin>

<div class="content-wrapper">


    <!-- <a href="{{route('teacher.dashboard.test.create')}}">Create test</a> -->
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-note-text-outline"></i>
            </span> {{$class_detail->class_name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <!-- <a href=http://127.0.0.1:8000/teacher/dashboard/test/create>Create test</a> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                    <!-- <button class="btn btn-primary" id="addNewTest" data-bs-toggle="modal" data-bs-target="#addClassModal">Invite code</button> -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#joinClassModal">Invite code</button>

                </li>
            </ul>
        </nav>
    </div>

    <!-- Class id: {{$class_detail->class_id}}<br>
    Class name: {{$class_detail->class_name}}<br>
    Class Note: {{$class_detail->class_note}}<br>
    Invite Code: {{$class_detail->invite_code}}<br>

    {{$students}} -->

    <div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="overflow-hidden card table-nowrap table-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New customers</h5>
                    <a href="#!" class="btn btn-light btn-sm">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dob</th>
                                <th>Phone number</th>
                                <th>Address</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr class="align-middle">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="avatar sm rounded-pill me-3 flex-shrink-0" alt="Customer">
                                        <div>
                                            <div class="h6 mb-0 lh-1">{{$student->name}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$student->email}}</td>
                                <td> <span class="d-inline-block align-middle">{{$student->dob}}</span></td>
                                <td><span>{{$student->phone_number}}</span></td>
                                <td>{{$student->address}}</td>
                                <td class="text-end">
                                    <div class="drodown">
                                        <a data-bs-toggle="dropdown" href="#" class="btn p-1" aria-expanded="false">
                                  <i class="fa fa-bars" aria-hidden="true"></i>
                                </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#!" class="dropdown-item">View Details</a>
                                            <a href="#!" class="dropdown-item">Delete user</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinClassModalLabel">Invite student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="invite_code" class="form-label">Invite Code</label>
                            <input type="text" class="form-control" id="invite_code" name="invite_code" value="{{$class_detail->invite_code}}" disabled style="font-size: 25px">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="copy-btn" id="creat-class-btn">Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- <div class="container mt-3 mb-4">
        <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                        <table class="table manage-candidates-top mb-0">
                            <thead>
                                <tr>
                                    <th>Candidate Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="action text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>Information Technology</li>
                                                        <li><i class="fas fa-map-marker-alt pr-1"></i>Rolling Meadows, IL 60008</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                        <span class="candidate-list-time order-1">Shortlisted</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#">Ronald Bradley</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>Human Resources</li>
                                                        <li><i class="fas fa-map-marker-alt pr-1"></i>Monroe Township, NJ 08831</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                        <span class="candidate-list-time order-1">Shortlisted</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#">Rafael Briggs</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>Recruitment Consultancy</li>
                                                        <li><i class="fas fa-map-marker-alt pr-1"></i>Haines City, FL 33844</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                        <span class="candidate-list-time order-1">Shortlisted</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#">Vickie Meyer</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>Human Resources</li>
                                                        <li><i class="fas fa-map-marker-alt pr-1"></i>Minneapolis, MN 55406</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                        <span class="candidate-list-time order-1">Shortlisted</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="candidates-list">
                                    <td class="title">
                                        <div class="thumb">
                                            <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="">
                                        </div>
                                        <div class="candidate-list-details">
                                            <div class="candidate-list-info">
                                                <div class="candidate-list-title">
                                                    <h5 class="mb-0"><a href="#">Nichole Haynes</a></h5>
                                                </div>
                                                <div class="candidate-list-option">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>Information Technology</li>
                                                        <li><i class="fas fa-map-marker-alt pr-1"></i>Botchergate, Carlisle</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="candidate-list-favourite-time text-center">
                                        <a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>
                                        <span class="candidate-list-time order-1">Shortlisted</span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                            <li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>
                                            <li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                            <li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-3 mt-sm-3">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled"> <span class="page-link">Prev</span> </li>
                                <li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span class="sr-only">(current)</span></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">25</a></li>
                                <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>

<script scr={{asset('vendor/jquery/jquery.min.js')}}></script>
<script type="module">
    import * as sR0eggyJs from 'https://esm.run/@s-r0/eggy-js';

    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('joinClassModal'));

        // You can add form submission logic here if needed
        document.querySelector('#joinClassModal .btn-primary').addEventListener('click', function() {
            // Add your logic to save the new class
            // console.log('Saving new class...');
            myModal.hide();
        });

        $('#copy-btn').click((e) => {
            var inputElement = document.getElementById("invite_code");
            navigator.clipboard.writeText(inputElement.value).then(function() {
                sR0eggyJs.Eggy({
                    title: 'Success!',
                    message: 'Copy successfully!',
                    type: 'success'
                });
            }).catch(function(err) {
                sR0eggyJs.Eggy({
                    title: 'Error!',
                    message: 'Unable to copy !',
                    type: 'error'
                });
            });
        });

    });
</script>


@endsection