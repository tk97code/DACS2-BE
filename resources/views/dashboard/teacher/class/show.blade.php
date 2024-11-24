@extends('layouts.master')

@section('content')



    <div class="content-wrapper">
    

        <a href="{{route('teacher.dashboard.test.create')}}">Create test</a>
    
        Class id: {{$class_detail->class_id}}<br>
        Class name: {{$class_detail->class_name}}<br>
        Class Note: {{$class_detail->class_note}}<br>
        Invite Code: {{$class_detail->invite_code}}<br>

        {{$students}}

    </div>

@endsection