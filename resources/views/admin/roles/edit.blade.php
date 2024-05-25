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
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.update",[$role->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group mt-3">
                <label class="required" for="title">{{ trans('cruds.role.fields.permissions') }}</label>
                <div class="row mb-4 mt-3">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <label class="form-check-label" for="checkAll">
                               Select All
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    @foreach ($groupedPermissions as $prefix => $permissions)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-header card-title">
                                    <div class="form-check">
                                        <input class="form-check-input check-all-group" type="checkbox" id="checkAll_{{ $prefix }}">
                                        <label class="form-check-label" for="checkAll_{{ $prefix }}">
                                            {{ ucfirst($prefix) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach ($permissions as $permission)
                                        <div class="custom-control custom-checkbox pt-1">
                                            <input type="checkbox" name="permissions[]" class="custom-control-input permission-checkbox" id="checkbox_{{$permission->id}}" value="{{$permission->id}}" @if($role->permissions->contains('id', $permission->id)) checked @endif>
                                            <label class="custom-control-label" for="checkbox_{{$permission->id}}">{{$permission->title}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-theme" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary me-3">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script>
      $(document).ready(function() {
        // Function to update "Select All" checkboxes based on permission checkboxes
        function updateSelectAllCheckboxes() {
            const allChecked = $('.permission-checkbox:checked').length === $('.permission-checkbox').length;
            $('#checkAll').prop('checked', allChecked);

            $('.check-all-group').each(function() {
                const card = $(this).closest('.card');
                const groupCheckboxes = card.find('.permission-checkbox');
                const groupChecked = groupCheckboxes.length === groupCheckboxes.filter(':checked').length;
                $(this).prop('checked', groupChecked);
            });
        }

        // Initial update of "Select All" checkboxes
        updateSelectAllCheckboxes();

        // Handle changes in permission checkboxes
        $('.permission-checkbox').change(function() {
            updateSelectAllCheckboxes();
        });

        // Handle changes in "Select All" checkboxes
        $('#checkAll').change(function() {
            const checked = this.checked;
            $('.permission-checkbox').prop('checked', checked);
            $('.check-all-group').prop('checked', checked);
        });

        $('.check-all-group').change(function() {
            const groupChecked = this.checked;
            const card = $(this).closest('.card');
            card.find('.permission-checkbox').prop('checked', groupChecked);
        });
    });
    </script>
@endsection
