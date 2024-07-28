@extends('layouts.frontend-app')
@section('css')
    <style>
        .wrapper {
            max-width: 760px;
            margin: 50px auto;
            padding: 40px 20px
        }

        .wrapper .search {
            border: 1px solid #c8c8c8;
            overflow: hidden;
            border-radius: 25px;
            padding: 0 10px;
            margin: 15px 0 20px;
            transition: all 0.3s
        }

        .wrapper .search:hover,
        .wrapper .search:focus-within {
            border: 1px solid transparent;
            box-shadow: 2px 5px 8px #1f1f1f10, 0px -4px 5px #1f1f1f10
        }

        .wrapper .search .form-control {
            box-shadow: none;
            outline: none;
            border: none
        }

        .wrapper .search .form-control:focus::placeholder {
            opacity: 0
        }

        .wrapper .accordion-button {
            font-size: 0.9rem;
            font-weight: 500
        }

        .wrapper .accordion-button:hover {
            background-color: #f8f8f8
        }

        .wrapper .accordion-button:focus {
            box-shadow: none
        }

        .wrapper .accordion-button::after {
            background-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #c8c8c8;
            background-position: center center;
            border-radius: 50%
        }

        .wrapper .accordion-button:not(.collapsed) {
            color: #000;
            background-color: #f7f7f7;
            font-weight: 600;
            border-bottom: 1px solid #ddd !important
        }

        .accordion-button:not(.collapsed)::after {
            border-color: #1E88E5
        }

        .wrapper .accordion-button.collapsed {
            border-bottom: 1px solid #ddd !important
        }

        .wrapper .accordion-collapse.show {
            border-bottom: 1px solid #ddd !important
        }

        .wrapper .accordion-collapse {
            background-color: #eaf3fa
        }

        .wrapper .accordion-collapse ul li {
            line-height: 2rem;
            width: 100%;
            padding: 0.5rem 1.3rem
        }

        .wrapper .accordion-collapse ul li:hover {
            background-color: #c9e7ff
        }

        .wrapper .accordion-collapse ul li a {
            text-decoration: none;
            color: #333;
            font-size: 0.85rem;
            font-weight: 400;
            display: block
        }

        .wrapper .accordion-collapse ul li:hover a {
            color: #222
        }

        @media (max-width: 777px) {
            .wrapper {
                margin: 50px 20px
            }
        }

        @media (max-width: 365px) {
            .wrapper {
                margin: 50px 10px
            }

            .w-75 {
                width: 90% !important
            }
        }
    </style>
@endsection
@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="wrapper bg-white rounded shadow">
                <div class="h2 text-center fw-bold">Ieltsprepandpractice</div>
                <div class="h3 text-primary text-center">How can we help you?</div>
              
                <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                What is IELTS? </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <P>
                                            The International English Language Testing System (IELTS) is a standardized test
                                            designed to
                                            evaluate the English language proficiency of non-native English speakers. It is
                                            widely used for
                                            academic and immigration purposes. It has a scoring system called “Band Scores”
                                            on a
                                            scale of 1
                                            to 9.

                                        </P>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Which IELTS Test do I need to attempt? </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            IELTS Academic is for study visa and admission purposes at universities. While
                                            IELTS General
                                            Training is to apply for Work Visa and Immigration purposes.

                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">How much score do I need?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            Score requirements vary for each person. Therefore, it is better to check the
                                            immigration
                                            website of the country where you intend to move or the University Admissions
                                            office if you are
                                            applying for studies.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFour" aria-expanded="false"
                                aria-controls="flush-collapseFour">Which testing body should I choose and how can I book the
                                exam?</button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            Two testing bodies conduct the IELTS exam: IDP and the British Council. Search
                                            which one is
                                            available in your country and book the exam through their website.

                                        </p>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFive" aria-expanded="false"
                                aria-controls="flush-collapseFive">How can "IELTS PREP & PRACTICE" help me with my IELTS
                                preparation? </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            Our platform offers a comprehensive range of resources, including study
                                            materials, mock tests,
                                            expert guidance, and preparation courses designed to enhance your skills and
                                            boost your
                                            confidence for the IELTS exam.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                What kind of study materials do you offer? </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            We provide a variety of study materials covering all sections of the IELTS test,
                                            including reading,
                                            writing, listening, and speaking. These include practice exercises, tips, and
                                            strategies to help
                                            improve your performance. </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseSeven" aria-expanded="false"
                                aria-controls="flush-collapseSeven">
                                Do you offer practice tests similar to the actual IELTS exam?
                            </button>
                        </h2>
                        <div id="flush-collapseSeven" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            Yes, we offer practice tests that simulate the real IELTS exam environment. These
                                            tests are
                                            designed to familiarize you with the test format, time constraints, and types of
                                            questions you'll
                                            encounter on the actual exam day.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseEight" aria-expanded="false"
                                aria-controls="flush-collapseEight">
                                How do your courses work?
                            </button>
                        </h2>
                        <div id="flush-collapseEight" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            Our courses, including Crash Course compelete and Full Preparation Course and Itensive Prep Course, provide
                                            structured lessons, mock speaking tests, writing task evaluations, practice
                                            materials, and expert
                                            guidance to prepare you for the IELTS exam. In each course, live classes are
                                            conducted via Zoom
                                            on 1 on 1 basis for individual feedback and improvement.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseNine" aria-expanded="false"
                                aria-controls="flush-collapseNine">
                                Is "IELTS PREP & PRACTICE" affiliated with the official IELTS test administrators?


                            </button>
                        </h2>
                        <div id="flush-collapseNine" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            We are an independent platform providing resources and guidance for IELTS
                                            preparation. We are
                                            not directly affiliated with the official IELTS testing organizations
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTen" aria-expanded="false"
                                aria-controls="flush-collapseTen">
                                Are the mock tests and materials on your platform free?


                            </button>
                        </h2>
                        <div id="flush-collapseTen" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            We offer both free and premium resources. While some materials and tests are
                                            accessible for
                                            free, premium options with additional features and support are available at a
                                            cost.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseEleven" aria-expanded="false"
                                aria-controls="flush-collapseEleven">
                                How can I enroll in your courses?


                            </button>
                        </h2>
                        <div id="flush-collapseEleven" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            You can enroll in our courses by visiting our website and following the
                                            instructions for
                                            registration. Select your desired course and proceed with the enrollment process.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwelve" aria-expanded="false"
                                aria-controls="flush-collapseTwelve">
                                What if I have more questions or need support?



                            </button>
                        </h2>
                        <div id="flush-collapseTwelve" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            If you have further inquiries or need support, please contact our customer
                                            service team at info@ieltsprepandpractice.com, and we'll be happy to assist you.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThirteen" aria-expanded="false"
                                aria-controls="flush-collapseThirteen">
                                Can I guarantee a specific score improvement with your materials and courses?



                            </button>
                        </h2>
                        <div id="flush-collapseThirteen" class="accordion-collapse collapse border-0"
                            aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion">
                            <div class="accordion-body p-0">
                                <ul class="list-unstyled m-0">
                                    <li>
                                        <p>
                                            While our resources and courses are designed to enhance your skills and
                                            readiness for the IELTS
                                            exam, individual performance can vary. Your improvement depends on various
                                            factors, including
                                            your effort and the extent of practice and study you engage in.
                                        </p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
