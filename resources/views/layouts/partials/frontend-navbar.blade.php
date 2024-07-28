<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('frontend.index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><img class="img-fluid mt-3 ms-5" width="135px"
                src="{{ asset('frontend/logo/logo.png') }}" alt=""></h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('frontend.index') }}#prepration-courses" class="nav-item nav-link"> IELTS Prepration Courses</a>
            <a href="{{ route('frontend.index') }}#prepration-material" class="nav-item nav-link"> IELTS Prepration Material</a>
            <a href="{{ route('frontend.index') }}#ielts-mock-test" class="nav-item nav-link"> IELTS Mock Test</a>
            <a href="{{ route('frontend.index') }}#prepration-testimonial" class="nav-item nav-link">Testimonial</a>
            <a href="{{route('frontend.faqs')}}" class="nav-item nav-link">Faqs</a>
        </div>
      
    </div>
</nav>
