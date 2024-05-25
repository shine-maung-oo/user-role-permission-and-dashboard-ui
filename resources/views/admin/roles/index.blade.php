@extends('layouts.admin')
@section('content')
    @can('role_create')
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-12 d-flex justify-content-end">
                <div style="padding: 30px; padding-top: 0 !important; padding-bottom: 0 !important;">
                    <a class="btn btn-theme" href="{{ route('admin.roles.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                    </a>
                </div>
            </div>
        </div>
    @endcan

    <div class="card">
        <h5 class="card-header">Role List</h5>
        <div class="p-lg-4 p-3">
            <div class="card-datatable table-responsive pt-0">
                <table class="table datatable border-top">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.role.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.role.fields.title') }}
                            </th>
                            <th width="70%">
                                {{ trans('cruds.role.fields.permissions') }}
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->title ?? '' }}</td>
                                <td width="70%">
                                    @foreach ($role->permissions as $key => $item)
                                        <span class="badge bg-primary">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('role_show')
                                        <a class="me-2" href="{{ route('admin.roles.show', $role->id) }}"><i
                                                class="bx bx-show-alt me-1"></i></a>
                                    @endcan
                                    @can('role_edit')
                                        <a class="me-2" href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i></a>
                                    @endcan
                                    @can('role_delete')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs">
                                                <i class="bx bx-trash me-1 icon-color"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
