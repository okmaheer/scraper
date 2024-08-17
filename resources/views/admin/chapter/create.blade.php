@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Add New Chapter</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Chapter Details</h1>

            <form action="{{ route('admin.chapter-list.store') }}" method="post">
                @csrf

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Manhwa</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid required" name="manhwa_id">
                            @foreach($manhwas as $manhwa)
                                <option value="{{ $manhwa->id }}">{{ $manhwa->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Chapter Number</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" placeholder="Enter Chapter Number" name="chapter_number" />
                    </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Link" name="link" />
                    </div>

                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Source</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Source" name="source" />
                    </div>
                </div>

                <div class="row g-9 mb-8">
               

                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Processed</span>
                        </label>
                        <!--end::Label-->
                        <div class="form-check form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="processed" id="processedCheckbox">
                            <label class="form-check-label" for="processedCheckbox">
                                Processed
                            </label>
                        </div>
                    </div>
                </div>

                <!--begin::Actions-->
                <div class="text-start">
                    <button type="reset" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
@endsection
