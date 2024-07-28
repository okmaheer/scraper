@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">

        <div class="row g-4 justify-content-center">

            <div class="container p-5">
                <div class="row">
                    <h1 class="mb-4">Reading Tests Instruction</h1>
                    @if ($test->category == 1)
                        <p>
                            <b>You have chosen to take an IELTS Academic Reading Test.</b></br>
                            It will take 60 minutes to solve the test.</br></br>
                            <b>What is in this test?</b>
                        <ul>
                            <li>You must read three different passages or texts and answer 40 questions.</li>
                            <li>You can see a timer on-screen so you know how much time has passed, you cannot stop
                                it. If you want to submit before 60 minutes, use the Finish Test button at the end of the
                                page. After 60 minutes the test will close, and you can check your results.</li>
                            <li>There is an on-screen highlighter as well like in the actual IELTS test. Use <i
                                    class="fas fa-pen"></i> to
                                highlight the selected text. <i class="fas fa-trash-alt"></i> to remove selected words or
                                text and <i class="fas fa-times-circle"></i> to
                                clear all the highlighted text.</li>
                            <li>In the actual IELTS test you should write all answers in capital letters except Roman
                                numbers (i, ii, iii, iv, ….), as sometimes the answers can be proper nouns which should be
                                written with the first letter as capital but here it will not be considered.</li>
                            <li>To solve the test it is recommended to do it on desktop or laptop.</li>    
                            </ul>
                        <b> Follow the instructions given with each question.</b>

                        </p>
                    @else
                        <p>
                            <b>You have chosen to take an IELTS General Training Reading Test</b></br>
                            It will take 60 minutes to solve the test.</br></br>
                            <b>What is in this test?</b>
                        <ul>
                            <li>You must read five different passages or texts and answer 40 questions.</li>
                            <li>You can see a timer on-screen so you know how much time has passed, you cannot stop
                                it. If you want to submit before 60 minutes, use the Finish Test button at the end of the
                                page. Ater 60 minutes the test will close, and you can check your results.
                            </li>
                            <li>There is an on-screen highlighter as well like in the actual IELTS test. Use <i
                                    class="fas fa-pen"></i> to
                                highlight the selected text. <i class="fas fa-trash-alt"></i> to remove selected words or
                                text and <i class="fas fa-times-circle"></i> to
                                clear all the highlighted text.</li>
                            <li>In the actual IELTS test you should write all answers in capital letters except Roman
                                numbers (i, ii, iii, iv, ….), as sometmes the answers can be proper nouns which should be
                                written with the first letter as capital but here it will not be considered.</li>
                                <li>To solve the test it is recommended to do it on desktop or laptop.</li>    

                            </b>

                            </ul>
                            <b> Follow the instructions given with each question.</b>    </p>
                    @endif
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('reading.test', ['id' => $test->id]) }}"
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
