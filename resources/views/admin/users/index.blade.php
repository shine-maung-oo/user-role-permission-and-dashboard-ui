@extends('layouts.admin')
@section('content')
    @can('user_create')
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-lg-12 d-flex justify-content-end">
                <div style="padding: 30px; padding-top: 0 !important; padding-bottom: 0 !important;">
                    <a class="btn btn-theme" href="{{ route('admin.users.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                    </a>
                </div>
            </div>
        </div>
    @endcan
    <div class="card">
        <h5 class="card-header">User List</h5>
        <div class="p-lg-4 p-3">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatable table border-top">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name ?? '' }}</td>
                                <td>{{ $user->email ?? '' }}</td>
                                <td>{{ $user->email_verified_at ?? '' }}</td>
                                <td>
                                    @foreach ($user->roles as $key => $item)
                                        <span class="badge bg-primary">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('user_show')
                                        <a class="me-2" href="{{ route('admin.users.show', $user->id) }}"><i
                                                class="bx bx-show-alt me-1"></i></a>
                                    @endcan
                                    @can('user_edit')
                                        <a class="me-2" href="{{ route('admin.users.edit', $user->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i></a>
                                    @endcan
                                    @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
