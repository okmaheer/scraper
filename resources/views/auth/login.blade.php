<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IPP</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('/css/plugins/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        .password-wrap {
            position: relative;
        }

        .password-wrap .pass-icon {
            width: 14px;
            height: 13px;
            position: absolute;
            right: 15px;
            top: 18px;
            cursor: pointer;
            color: #181C32;
            opacity: 0.7;
        }

        .password-wrap .pass-icon {
            opacity: 1;
        }

        .form-control.is-invalid {
            background-image: none;
        }
    </style>
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #1c212e">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column justify-content-center text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="javascript:void(0)" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('/frontend/logo/logo.png') }}" width="50%" />
                        </a>
                        <!--end::Logo-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                            action="{{ route('login.post') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Sign In to IPP</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                {{-- <div class="text-gray-300 fw-bold fs-4">New Here?
                                <a href="javascript:void(0)" class="link-primary fw-bolder">Create an Account</a></div> --}}
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="Enter email" name="email" value="{{ old('email') }}"
                                    autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10 password-wrap">
                                <input id="password" type="password"
                                    class="form-control form-control-lg  @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" required autocomplete="off">
                                <img class="pass-icon fa-eye" alt="Show"
                                    src="https://aspca-beta.doobert.com/media/icons/pw-show.svg">
                                <img class="pass-icon fa-eye-slash" alt="hidden"
                                    src="https://aspca-beta.doobert.com/media/icons/pw-hidden.svg" style="display:none">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label text-uppercase">Sign In</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Submit button-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
</body>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
    $(document).ready(function() {
        const $triggerEye = $('.fa-eye');
        const $triggerEyeSlash = $('.fa-eye-slash');
        const $passwordField = $('#password');

        // Hide the fa-eye-slash icon by default
        $triggerEyeSlash.hide();

        $triggerEye.click(function() {
            $passwordField.attr('type', 'text');
            $triggerEye.hide();
            $triggerEyeSlash.show();
        });
        $triggerEyeSlash.click(function() {
            $passwordField.attr('type', 'password');
            $triggerEye.show();
            $triggerEyeSlash.hide();
        });
    });
</script>

</html>
