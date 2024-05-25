@extends('layouts.admin')
@section('styles')
<style>
    .card-title {
        color: #fff;
        background-color: #8a19fc !important;
        padding: 0.5rem 1rem;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
         <tbody>
             <tr>
                 <th>{{ trans('cruds.role.fields.title') }}</th>
                 <td>{{$role->title ?? ''}}</td>
             </tr>

             <tr>
                 <th>{{ trans('cruds.role.fields.permissions') }}</th>
                 <td>
                     @foreach($role->permissions as $key => $permission)
                         <span class="badge bg-primary">{{ $permission->title }}</span>
                     @endforeach
                 </td>
             </tr>
         </tbody>
        </table>
         <a href="{{ route('admin.roles.index') }}" class="btn btn-default me-3">
             {{ trans('global.back_to_list') }}
         </a>
    </div>
</div>
@endsection

