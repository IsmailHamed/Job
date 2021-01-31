@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    <h2>الوظائف المتقدم لها</h2>

    <table class="table">
        <tr>
            <th>
                {{ __('allResources.Job title') }}
            </th>
            <th>
                {{ __('allResources.Apply date') }}
            </th>
            <th>
                {{ __('allResources.Message') }}
            </th>
            <th></th>
        </tr>
        @foreach ($jobs as $job)
            <tr>
                <td>
                    {{ $job->jobTitle}}
                </td>
                <td>
                    {{ $job->created_at}}
                </td>
                <td>
                    {{ $job->message}}
                </td>

                <td>
                    <a href="{{route("Job.EditApplyJob",['id'=>$job->jobId])}}">{{__('allResources.Edit')}}</a> |
                    <a href="{{route("Job.Details",['id'=>$job->jobId])}}">{{__('allResources.Details')}}</a> |
                    <a href="{{route("Job.DeleteApplyJob",['id'=>$job->jobId])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach


    </table>
@endsection