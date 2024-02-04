@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection


@push('after-styles')
<link rel="stylesheet" href="{{ mix('modules/constant/style.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <div class="d-flex flex-wrap gap-3">
                <x-backend.quick-action url='{{ route("backend.$module_name.bulk_action") }}'>
                    <div class="">
                        <select name="action_type" class="form-control select2 col-12" id="quick-action-type" style="width:100%">
                            <option value="">{{ __('messages.no_action') }}</option>
                            <option value="change-status">{{ __('messages.status') }}</option>
                            <option value="delete">{{ __('messages.delete') }}</option>
                        </select>
                    </div>
                    <div class="select-status d-none quick-action-field" id="change-status-action">
                        <select name="status" class="form-control select2" id="status" style="width:100%">
                            <option value="1">{{ __('messages.active') }}</option>
                            <option value="0">{{ __('messages.inactive') }}</option>
                        </select>
                    </div>
                </x-backend.quick-action>
              <div>
                <button type="button" class="btn btn-secondary" data-modal="export">
                  <i class="fa-solid fa-download"></i> Export
                </button>
  {{--          <button type="button" class="btn btn-secondary" data-modal="import">--}}
  {{--            <i class="fa-solid fa-upload"></i> Import--}}
  {{--          </button>--}}
              </div>
            </div>
            <x-slot name="toolbar">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping">
                </div>
                @hasPermission('add_staff')
                  <x-buttons.offcanvas target='#form-offcanvas' title="{{ __('messages.create') }} {{ __($module_title) }}">{{ __('messages.create') }} {{ __($module_title) }}</x-buttons.offcanvas>
                @endhasPermission
            </x-slot>
        </x-backend.section-header>
        <table id="datatable" class="table table-striped border table-responsive">
        </table>
    </div>
</div>

<div data-render="app">
    <employee-offcanvas default-image="{{user_avatar()}}" create-title="{{ __('messages.create') }} {{ __('messages.new') }} {{ __($module_title) }}" edit-title="{{ __('messages.edit') }} {{ __($module_title) }}" :customefield="{{ json_encode($customefield) }}">
    </employee-offcanvas>
    <change-password create-title="Change Password"></change-password>
</div>
@endsection

@push('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push('after-scripts')
<script src="{{ mix('modules/employee/script.js') }}"></script>
<script src="{{ asset('js/form-offcanvas/index.js') }}" defer></script>
<script src="{{ asset('js/form-modal/index.js') }}" defer></script>

<!-- DataTables Core and Extensions -->
<script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="text/javascript" defer>
    const columns = [{
            name: 'check',
            data: 'check',
            title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" onclick="selectAllTable(this)">',
            width: '0%',
            exportable: false,
            orderable: false,
            searchable: false,
        },
        {
            data: 'image',
            name: 'image',
            title: "{{ __('employee.lbl_image') }}",
            orderable: false,
            searchable: false
        },
        {
            data: 'first_name',
            name: 'first_name',
            title: "{{ __('employee.lbl_first_name') }}"
        },
        {
            data: 'last_name',
            name: 'last_name',
            title: "{{ __('employee.lbl_last_name') }}"
        },
        {
            data: 'email',
            name: 'email',
            title: "{{ __('employee.lbl_Email') }}"
        },
        {
            data: 'branch_id',
            name: 'branch_id',
            title: "{{ __('branch.title') }}",
            orderable: false,
            searchable: false
        },
        {
            data: 'is_manager',
            name: 'is_manager',
            title: "{{ __('employee.lbl_role') }}"
        },
        {
            data: 'email_verified_at',
            name: 'email_verified_at',
            orderable: true,
            searchable: false,
            title: "{{ __('employee.lbl_verification_status') }}"
        },
        {
            data: 'is_banned',
            name: 'is_banned',
            orderable: true,
            searchable: true,
            title: "{{ __('employee.lbl_blocked') }}"
        },
        {
            data: 'status',
            name: 'status',
            orderable: true,
            searchable: true,
            title: "{{ __('employee.lbl_status') }}"
        },
        {
        data: 'updated_at',
        name: 'updated_at',
        title: "{{ __('customer.lbl_update_at') }}",
        orderable: true,
        visible: false,
       },
    ]

      const actionColumn = [{
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false,
        title: "{{ __('employee.lbl_action') }}"
    }]

    const customFieldColumns = JSON.parse(@json($columns))

    let finalColumns = [
        ...columns,
        ...customFieldColumns,
        ...actionColumn
    ]

    document.addEventListener('DOMContentLoaded', (event) => {
        initDatatable({
            url: '{{ route("backend.$module_name.index_data") }}',
            finalColumns,
            orderColumn: [[ 10, "desc" ]],
        })
    })

    function resetQuickAction() {
        const actionValue = $('#quick-action-type').val();
        if (actionValue != '') {
            $('#quick-action-apply').removeAttr('disabled');

            if (actionValue == 'change-status') {
                $('.quick-action-field').addClass('d-none');
                $('#change-status-action').removeClass('d-none');
            } else {
                $('.quick-action-field').addClass('d-none');
            }
        } else {
            $('#quick-action-apply').attr('disabled', true);
            $('.quick-action-field').addClass('d-none');
        }
    }

    $('#quick-action-type').change(function() {
        resetQuickAction()
    });

    $(document).on('update_quick_action', function() {
        // resetActionButtons()
    })
</script>
@endpush
