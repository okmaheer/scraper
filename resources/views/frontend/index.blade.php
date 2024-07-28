@extends('layouts.frontend-app')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">

            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('frontend/img/image.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown"> Cambridge IELTS 
                                    FREE Mock Test </h1>
                                <p class="fs-5 text-white mb-4 pb-2"> Practice authentic IELTS Listening and Reading Tests provided by  
                                 Cambridge for FREE to achieve success in your IELTS exam. Get expert-desgined, reliable and comprehensive IELTS resources.  
                                </p>
                                {{-- <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a> --}}
                                {{-- <a href="{{ route('registeration-request-front-end.create') }}"
                                    class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxxl ">
        <div class="row g-4 justify-content-center" id="prepration-courses">

            <div class="container p-5">
                <div class="row">
                    <h2 class="mb-4">IELTS Preparation Courses</h2>
                    <p class="mb-4">Join our 1 : 1 Online IELTS Courses to get guidance for all four modules, and we ensure that
                        students get their desired bands on the first attempt. 
                        </p>
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h2 class="card-title">Basic</h2>
                                    <small>IELTS Crash Course </small>
                                    <br><br>
                                    <span class="h4"><del class="mr-2"
                                            style="font-size: 15px; margin-right:8px">$50</del>$20 USD</span>
                                    <br><br>
                                </div>
                                <p class="card-text">Join our IELTS Crash Course, a focused 15-day program designed to accelerate your exam
                                    preparation. 
                                    </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Live sessions of 12 Hours</li>
                              
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Guidance for All Modules
                                </li>
                              
                            
                                
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>IELTS Preparation Resources

                                </li>
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>1 Month Access to Paid IELTS Mock Tests

                                </li>
                             
                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg"
                                    href="{{ route('registeration-request-front-end.create', ['type' => '1', 'plan' => 'basic']) }}"
                                    style="border-radius:30px">Join Now</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h2 class="card-title">Standard</h2>
                                    <small> IELTS Complete Prep Course</small>
                                    <br><br>
                                    <span class="h4"><del class="mr-2"
                                            style="font-size: 15px; margin-right:8px">$50</del>$30 USD</span>
                                    <br><br>
                                </div>
                                <p class="card-text">Embark on a comprehensive IELTS Complete Preparation Course spanning one month. </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg> Live sessions of 25 Hours
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Guidance for All Modules 

                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>IELTS Preparation Resources 

                                </li>
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>2 Months Access to Paid IELTS Mock Tests

                                </li>
                               
                              
                              
                             
                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg"
                                    href="{{ route('registeration-request-front-end.create', ['type' => '1', 'plan' => 'standard']) }}"
                                    style="border-radius:30px">Join Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card h-100 shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h2 class="card-title">Premium</h2>
                                    <small> IELTS Intensive Prep Course</small>
                                    <br><br>
                                    <span class="h4"><del class="mr-2"
                                            style="font-size: 15px; margin-right:8px">$150</del>$120 USD</span>
                                    <br><br>
                                </div>
                                <p class="card-text">Our Intensive IELTS Preparation Course, meticulously covers IELTS strategies, English grammar,
                                    and vocabulary.  </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Live sessions of 45 Hours 
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg> Improvement in English Level 

                                </li>
                               
                               
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Guidance for All Modules 


                           
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>IELTS Preparation Resources
                              
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Unlimited Access to Paid IELTS Mock Tests 


                                </li>
                           
                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg"
                                    href="{{ route('registeration-request-front-end.create', ['type' => '1', 'plan' => 'premium']) }}"
                                    style="border-radius:30px">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <div class="row g-4 justify-content-center" id="prepration-material">

            <div class="container p-5">
                <div class="row">
                    <h3 class="mb-4">IELTS Preparation Material</h3>
                    <p class="mb-4">Access FREE IELTS resources including Cambridge IELTS Books PDF, Books to develop Vocabulary, and Grammar
                        notes to start your IELTS preparation. </p>

                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card  shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h3 class="card-title">Free Access</h3>

                                </div>

                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Cambridge IELTS Books 
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M4.293 4.293a1 1 0 0 1 1.414 0L8 6.586l2.293-2.293a1 1 0 0 1 1.414 1.414L9.414 8l2.293 2.293a1 1 0 0 1-1.414 1.414L8 9.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 0-1.414z" />
                                </svg>Grammar & Vocabulary books
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path
                                        d="M4.293 4.293a1 1 0 0 1 1.414 0L8 6.586l2.293-2.293a1 1 0 0 1 1.414 1.414L9.414 8l2.293 2.293a1 1 0 0 1-1.414 1.414L8 9.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 0-1.414z" />
                                </svg>Band 7 Essays
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M4.293 4.293a1 1 0 0 1 1.414 0L8 6.586l2.293-2.293a1 1 0 0 1 1.414 1.414L9.414 8l2.293 2.293a1 1 0 0 1-1.414 1.414L8 9.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 0-1.414z" />
                                </svg>
                                    Free of cost 

                                </li>

                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg"
                                target="_blank"
                                    href="https://drive.google.com/drive/folders/1a9-l7xNPM4oX14sN78UsSqgEpJrjXulS?usp=sharing"
                                    style="border-radius:30px">Get Access</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card  shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h3 class="card-title">Paid Access</h3>

                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Cambridge IELTS Books </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Book for Speaking & Writing 
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Band 7 Essays
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg> <span class="h4"> $5 USD</span>
                                </li>
                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg"
                                    href="{{ route('registeration-request-front-end.create', ['type' => '2', 'plan' => 'paid']) }}"
                                    style="border-radius:30px">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center" id="ielts-mock-test">

            <div class="container p-5">
                <div class="row">
                    <h4 class="mb-4"> IELTS Mock Test </h4>
                    <p class="mb-4">Practice Cambridge IELTS Listening & Reading Tests for FREE. Through our interface, you can learn all
                        the features of Computer-Based IELTS Test. </p>

                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card  shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h4 class="card-title">Free Access</h4>

                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Access for Unlimited Time 
                                </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>8 Listening and Reading Mock Tests </li>

                                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Expert Feedback for both Modules 
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Free of cost 

                                </li>
                              
                            </ul>
                            <div class="card-body text-center">
                                <button style="border-radius:30px" type="button" data-bs-toggle="modal"
                                    data-bs-target="#test-type" class="btn btn-outline-primary btn-lg">
                                    <span class="indicator-label">Start Practicing</span>

                                </button>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card  shadow-lg">
                            <div class="card-body">
                                <div class="text-center p-3">
                                    <h4 class="card-title">Paid Access</h4>

                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Access for 2 Months </li>
                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>28 Listening and Reading Mock Test
                                </li>

                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>Expert Feedback for both Modules 
                                </li>




                                <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path
                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg> <span class="h4"> $5 USD</span>


                                </li>
                            </ul>
                            <div class="card-body text-center">
                                <a class="btn btn-outline-primary btn-lg" href="{{ route('show.loginForm') }}"
                                    style="border-radius:30px">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" id="prepration-testimonial" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h5 class="section-title bg-white text-center text-primary px-3">Testimonial</h5>

                </div>
                @php
                    $testimonials = [
                        (object) ['id' => 1, 'name' => 'Saba', 'score' => '7.0 bands', 'image' => 't1.jpg', 'country' => 'Pakistan', 'alt' => 'Image of IELTS TRF of a student who got 8 in IELTS Listening'],
                        // (object) ['id' => 2, 'name' => 'Nour el huda', 'score' => '6.5 bands', 'image' => 't2.jpg', 'country' => 'Jordan'],
                        (object) ['id' => 3, 'name' => 'Mudassir', 'score' => '6.5 bands', 'image' => 't3.jpg', 'country' => 'Pakistan', 'alt' => 'Image of IELTS TRF of a student who got 6.5 overall'],
                        // (object) ['id' => 4, 'name' => 'Majd Faris', 'score' => '6.5 bands', 'image' => 't4.jpg', 'country' => 'Jordan'],
                        // (object) ['id' => 5, 'name' => 'Abdullah', 'score' => '6.5 bands', 'image' => 't5.jpg', 'country' => 'Bahrain'],
                        // (object) ['id' => 6, 'name' => 'Hafsa', 'score' => '7.0 bands', 'image' => 't6.jpg', 'country' => 'Pakistan'],
                        (object) ['id' => 7, 'name' => 'Shahbaz', 'score' => '7.0 bands', 'image' => 't7.jpg', 'country' => 'Pakistan', 'alt' => 'Image of IELTS TRF of a student who got 6.5 overall'],
                        (object) ['id' => 8, 'name' => 'Lamisa', 'score' => '7.5 bands', 'image' => 't8.jpg', 'country' => 'Bangladesh', 'alt' => 'Image of IELTS TRF of a student who got 8 in IELTS Reading'],
                        (object) ['id' => 9, 'name' => 'Kanza', 'score' => '7.5 bands', 'image' => 't9.jpg', 'country' => 'Pakistan', 'alt' => 'Image of IELTS TRF of a student who got 8.5 in IELTS Reading'],
                        (object) ['id' => 10, 'name' => 'Ramya', 'score' => '7 bands', 'image' => 't10.jpg', 'country' => 'India', 'alt' => 'Image of IELTS TRF of a student who got 7.0 overall'],
                        (object) ['id' => 11, 'name' => 'Maryeni', 'score' => '7.5 bands', 'image' => 't11.jpg', 'country' => 'Ghana', 'alt' => 'Image of IELTS TRF of a student who got 8 in IELTS Speaking'],
                        (object) ['id' => 12, 'name' => 'Renise', 'score' => '6.5 bands', 'image' => 't12.jpg', 'country' => 'Cameroon', 'alt' => 'Image of IELTS TRF of a student who got 6.5 overall'],
                       
                    ];
                @endphp
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-item text-center">
                            <button class="mb-1" type="button" data-bs-toggle="modal"
                                data-bs-target="#testimonial-image-{{ $testimonial->id }}">
                                <img class="border  p-2 mx-auto mb-3"
                                    src="{{ asset('frontend/testimonial/' . $testimonial->image) }}"
                                    style="width: 150px; height: 200px;" />
                            </button>

                            <h5 class="mb-0">{{ $testimonial->name }}</h5>
                            <span>{{ $testimonial->score }}</span>
                            <p>{{ $testimonial->country }}</p>


                        </div>
                    @endforeach



                </div>
            </div>
        </div>
        @foreach ($testimonials as $testimonial)
            @include('layouts.partials.models.testimonial-image')
        @endforeach
        <!-- Testimonial End -->
    @endsection

    @section('script')
    @endsection
