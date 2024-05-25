@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
       <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th>{{ trans('cruds.user.fields.name') }}</th>
                <td>{{$user->name ?? ''}}</td>
            </tr>
            <tr>
                <th>{{ trans('cruds.user.fields.email') }}</th>
                <td>{{$user->email ?? ''}}</td>
            </tr>
            <tr>
                <th>{{ trans('cruds.user.fields.roles') }}</th>
                <td>
                    @foreach($user->roles as $key => $roles)
                        <span class="badge bg-primary">{{ $roles->title }}</span>
                    @endforeach
                </td>
            </tr>
        </tbody>
       </table>
        <a href="{{ route('admin.users.index') }}" class="btn btn-default me-3">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>
@endsection
