@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($jobs as $job)

                <div class="col-md-3">
                    <div class="card">
                        <img style="height: 150px;" src="/storage/{{ $job->jobImage}}" class="card-img-top"
                             alt="{{ $job->jobTitle}}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->jobTitle}}</h5>
                            <p class="card-text">{{ $job->jobContent}}</p>
                            <a href="{{route("Job.Details",['id'=>$job->id])}}"
                               class="btn btn-primary">{{__('allResources.Details')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

@endsection
