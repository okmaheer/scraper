@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">

        <div class="row g-4 justify-content-center">

            <div class="container p-5">
                <div class="row">
                    <h1 class="mb-4">Listening Tests Instruction</h1>
                    <p>
                        <b>You have chosen to take an IELTS Listening Test </b></br>
                        It will take 32 minutes to solve the test.</br></br>
                        <b>What is in this test?</b>
                    <ul>
                        <li>You must answer 40 questions as you listen to the recording.</li>
                        <li> You can see a timer on-screen so you know how much time has passed, you cannot stop
                            it. If you want to submit before 32 minutes, use the Finish Test button at the end of the
                            page. After 32 minutes the test will close, and you can check your results. 
                            </li>
                            <li>There is an on-screen highlighter as well like in the actual IELTS test. Use <i class="fas fa-pen"></i> to
                                highlight the selected text. <i
                                class="fas fa-trash-alt"></i> to remove selected words or text and <i
                                class="fas fa-times-circle"></i> to
                                clear all the highlighted text.</li>
                        <li>In the actual IELTS test you should write all answers in capital letters as sometimes the
                            answers can be proper nouns which should be written with the first letter as capital but
                            here it will not be considered. 
                            </li>
                            <li>To solve the test it is recommended to do it on desktop or laptop.</li>    

                    </ul>
                    <b> Follow the instructions given with each question.</b>

                    </p>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('listening.test', ['id' => $test->id]) }}"
                        style="border-radius:30px"> Start Test </a>


                </div>
            </div>
        </div>
        <!-- About Start -->
    </div>
    <!-- Testimonial End -->
@endsection

@section('script')
@endsection
