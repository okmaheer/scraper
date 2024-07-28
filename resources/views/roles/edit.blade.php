@extends('layouts.app')

@section('content')
    <div class="card card-flush">
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" action="{{ route('admin.roles.update', [$role->id]) }}" method="POST">
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bolder form-label mb-2">
                            <span class="required">Role name</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" value="{{$role->name}}" placeholder="Enter a role name" name="name" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Permissions-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                    <!--begin::Table row-->
                                    @isset($modules)
                                        @foreach ($modules as $module)    
                                            <tr>
                                                <!--begin::Label-->
                                                <td class="text-gray-800">{{ $module->name }}</td>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <td>
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex">
                                                        @isset($module->permissions)
                                                            @foreach ($module->permissions as $permission)    
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 w-250px">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }} />
                                                                    <span class="form-check-label">{{ ucwords($permission->name) }}</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            @endforeach
                                                        @endisset
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </td>
                                                <!--end::Options-->
                                            </tr>
                                        @endforeach
                                    @endisset
                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="pt-15">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection