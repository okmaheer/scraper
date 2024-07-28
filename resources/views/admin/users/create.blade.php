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
                <li class="breadcrumb-item text-gray-500">Add New User</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">User Details</h1>

            <form action="{{ route('admin.user.store') }}" method="post">
                @csrf

                <div class="row g-9 mb-8">

                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">User Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid required" placeholder="Enter name"
                            name="name" />
                    </div>


                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                        <!--end::Label-->
                        <input type="phone" class="form-control form-control-solid required" placeholder="Enter Phone"
                            name="phone" />
                    </div>

                </div>





                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <!--end::Label-->
                        <input type="email" class="form-control form-control-solid required" placeholder="Enter Email"
                            name="email" />
                    </div>


                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Country</span>
                        </label>
                        <!--end::Label-->
                       
                        <select class="form-control form-control-solid required" name="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                        
                              <option value="{{$country}}">{{$country}}</option>
                              @endforeach
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Password</span>
                        </label>
                        <!--end::Label-->
                        <input type="password" class="form-control form-control-solid required" placeholder="Enter Password"
                            name="password" />
                    </div>


                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Duration</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid required" name="duration">
                            <option value="">Select Status</option>
                            <option value="1">15 Days</option>
                            <option value="2">1 Month</option>
                            <option value="3">2 Month</option>
                            <option value="4">3 Month</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                </div>
                <div class="row g-9 mb-8">
              


                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Status</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid required" name="status">
                            <option value="">Select Status</option>
                            <option value="0">InActive</option>
                            <option value="1">Active</option>
                           
                            <!-- Add more options as needed -->
                        </select>
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
