@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    <h2>الأدوار</h2>

    <p>
        <a href="{{route("Role.Create")}}">{{__('allResources.Add new role')}}</a>
    </p>
    <table class="table">
        <tr>
            <th>
                {{ __('allResources.Name') }}
            </th>
            <th>
                {{ __('allResources.description') }}
            </th>
            <th></th>
        </tr>
        @foreach ($Roles as $role)
            <tr>
                <td>
                    {{ $role->name}}
                </td>
                <td>
                    {{ $role->description }}
                </td>
                <td>
                    <a class="btn btn-success" href="{{route("Role.Edit",['id'=>$role->id])}}">{{__('allResources.Edit')}}</a>
                    <a class="btn btn-info" href="{{route("Role.Details",['id'=>$role->id])}}">{{__('allResources.Details')}}</a>
                    <a class="btn btn-danger" href=" {{route("Role.Delete",['id'=>$role->id])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach


    </table>
@endsection
