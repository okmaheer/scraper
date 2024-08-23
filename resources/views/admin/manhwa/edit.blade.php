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
                <li class="breadcrumb-item text-gray-500">Update Manhwa</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Test Details</h1>

            <form action="{{ route('admin.manhwa.update') }}" method="post">
                @csrf
                <div class="row g-9 mb-8">
               
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Manhwa Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" placeholder="Enter name" value="{{$manhwa->name}}"  name="name" />
                    </div>

                 
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Manhwa Fast Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" placeholder="Enter Fast Link" value="{{$manhwa->manhwafast_link}}"  name="manhwafast_link" />

                    </div>
                 
                </div>
                <div class="row g-9 mb-8">
            
                 
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Manhwa Clan Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" value="{{$manhwa->manhwaclan_link}}"  placeholder="Enter Clan Link" name="manhwaclan_link" />

                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Tecnoscans Clan Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" value="{{$manhwa->tecnoscans_link}}"  placeholder="Enter Tecnoscans Link" name="tecnoscans_link" />

                    </div>
               
                 
                </div>
                <div class="row g-9 mb-8">
            
                 
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">MG Demon Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" value="{{$manhwa->mgdemon_link}}"  placeholder="Enter MG Link" name="mgdemon_link" />

                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Flame Comics Clan Link</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" value="{{$manhwa->asuracomic_link}}"  placeholder="Enter Asura Link" name="asuracomic_link" />

                    </div>
               
                 
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Manhwa Starting Limit</span>
                        </label>
                        <!--end::Label-->
                        <input type="number" class="form-control form-control-solid required" placeholder="Enter limit" value="{{$manhwa->starting_limit}}"  name="starting_limit" />

                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Deep check</span>
                        </label>
                        <!--end::Label-->
                        <div class="form-check form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" {{$manhwa->deep_check ? 'checked': ''}} name="deep_check" id="processedCheckbox">
                           
                        </div>
                     </div>
                </div>




                <div class="row g-9 mb-8">
               
                    <input type="hidden" name="id" value="{{ $manhwa->id }}">


                </div>



                <!--begin::Actions-->
                <div class="text-start">
                    <button type="reset" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
@endsection
