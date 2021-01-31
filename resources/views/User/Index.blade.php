@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif
    <h2>المستخدمين</h2>

    <p>
        <a href="{{route("User.Create")}}">{{__('allResources.Add new user')}}</a>
    </p>
    <table class="table">
        <tr>
            <th>
                {{ __('allResources.Name') }}
            </th>
            <th>
                {{ __('allResources.E-Mail Address') }}
            </th>
            <th>
                {{ __('allResources.User Type') }}
            </th>
            <th>
                {{ __('allResources.User Type') }}
            </th>
            <th></th>
        </tr>
        @foreach ($Users as $user)
            <tr>
                <td>
                    {{ $user->name}}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->type }}
                </td>
                <td>
                    <ul>
                        @foreach ($user->roles  as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach

                    </ul>

                </td>
                <td>
                    <a href="{{route("User.Edit",['id'=>$user->id])}}">{{__('allResources.Edit')}}</a>|
                    <a href="{{route("User.Details",['id'=>$user->id])}}">{{__('allResources.Details')}}</a>|
                    <a href=" {{route("User.Delete",['id'=>$user->id])}}">{{__('allResources.Delete')}}</a>

                </td>
            </tr>
        @endforeach
    </table>
@endsection
