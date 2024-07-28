<div class="modal fade" id="mcqs-modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header justify-content-end border-0 pb-0">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-lg-5 my-7">
                <!--begin::Modal title-->
                <h2 class="fw-bolder text-center mb-15">Add Treatment Category</h2>
                <!--end::Modal title-->

                <!--begin::Form-->
                <form class="form" id="treatment-category-form">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7">
                        <!--begin::Form Row-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Category</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control" placeholder="Enter a name" name="category_name" id="category-name" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Form Row-->

                        <!--begin::Repeater-->
                        <div id="treatment-service-repeater">
                            <div data-repeater-list="treatment-service">
                                <div data-repeater-item="treatment-service">
                                    <div class="fv-row row mb-5">
                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 mb-2">Clinical Specialization</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select data-index="0" class="form-select clinical-specialization" name="clinicalspecialization_id[0]" data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                @isset($clinicalSpecializations)
                                                    @foreach ($clinicalSpecializations as $specialization)
                                                        <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <!--begin::Select2-->
                                        </div>

                                        <div class="col-4">
                                            <!--begin::Label-->
                                            <label class="required form-label fs-6 mb-2">Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" data-index="0" class="form-control service-name" name="treatmentservice_name[0]" placeholder="Service Name" />
                                            <!--begin::Input-->
                                        </div>

                                        <div class="col-3">
                                            <!--begin::Label-->
                                            <label class="required form-label fs-6 mb-2">Cost</label>
                                            <!--end::Label-->
                                            <!--begin::Input Group-->
                                            <div class="input-group">
                                                <span class="input-group-text text-gray-500">₹</span>
                                                <input data-index="0" type="number" class="form-control service-cost" placeholder="Enter cost" name="treatmentservice_cost[0]">
                                            </div>
                                            <!--end::Input Group-->
                                        </div>

                                        <div class="col-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Form group-->
                            <div class="form-group mb-5">
                                <a href="javascript:;" data-repeater-create="treatment-service" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-plus"></i>Add Treatment Service
                                </a>
                            </div>
                            <!--end::Form group-->
                        </div>
                        <!--end::Repeater-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" data-dismiss="treatment-category">Discard</button>
                        <button type="button" class="btn btn-primary" data-create="treatment-category">
                            <span class="indicator-label">Create Category</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>