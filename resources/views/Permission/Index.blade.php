@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    <h2>الصلاحيات</h2>

    <p>
        <a href="{{route("Permission.Create")}}">{{__('allResources.Add new permission')}}</a>
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
        @foreach ($Permissions as $permission)
            <tr>
                <td>
                    {{ $permission->name}}
                </td>
                <td>
                    {{ $permission->description }}
                </td>
                <td>
                    <a href="{{route("Permission.Edit",['id'=>$permission->id])}}">{{__('allResources.Edit')}}</a> |
                    <a href="{{route("Permission.Details",['id'=>$permission->id])}}">{{__('allResources.Details')}}</a> |
                    <a href="{{route("Permission.Delete",['id'=>$permission->id])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach


    </table>
@endsection
