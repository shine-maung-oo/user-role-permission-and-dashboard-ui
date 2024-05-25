@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.permission.title_singular') }}
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
         <tbody>
             <tr>
                 <th>{{ trans('cruds.permission.fields.title') }}</th>
                 <td>{{$permission->title ?? ''}}</td>
             </tr>
         </tbody>
        </table>
         <a href="{{ route('admin.permissions.index') }}" class="btn btn-default me-3">
             {{ trans('global.back_to_list') }}
         </a>
     </div>
</div>
@endsection
