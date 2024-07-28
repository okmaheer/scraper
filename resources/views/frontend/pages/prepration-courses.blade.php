@extends('layouts.frontend-app')

@section('content')
	

	
		<!-- Service Start -->
		<div class="container-xxl py-5">
			<div class="container">
				<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
					<h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
					<h1 class="mb-5">IELTS
                        PREPARATION
                        COURSES</h1>
                        <p>Unlock IELTS Success with Our Preparation
                            Courses. Join our 1 on 1 IELTS preparation courses
                            and empower yourself for success. Our expertly
                            designed programs provide the guidance, resources,
                            and support you need to excel in the IELTS exam.
                            Prepare with confidence and achieve your desired
                            band score with us.</p>
				</div>
				<div class="row g-4 justify-content-center">
				
					<div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
						<div class="course-item bg-light">
							<div class="position-relative overflow-hidden">
								<img class="img-fluid" src="{{asset('frontend/img/course-2.jpg')}}" alt="">
								<div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
								
									<a href="{{route('registeration-request-front-end.create')}}" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
								</div>
							</div>
							<div class="text-center p-4 pb-0">
								<h3 class="mb-0">$20.00</h3>
								<div class="mb-3">
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small>(47)</small>
								</div>
								<h5 class="mb-4">IELTS Crash
                                    Course
                                    </h5>

							</div>
							<div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>1 on 1 Live Sessions</small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>30 Days</small>
								<small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>230 Students</small>
							</div>
                            <div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-book text-primary me-2"></i>Mock Speaking Tests</small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-pen text-primary me-2"></i>Writing Task Evaluation/Guidance</small>
								<small class="flex-fill text-center py-2"><i class="fa fa-music text-primary me-2"></i>Listening and Reading Guidance</small>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
						<div class="course-item bg-light">
							<div class="position-relative overflow-hidden">
								<img class="img-fluid" src="{{asset('frontend/img/course-3.jpg')}}" alt="">
								<div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
									{{-- <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a> --}}
									<a href="{{route('registeration-request-front-end.create')}}" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
								</div>
							</div>
							<div class="text-center p-4 pb-0">
								<h3 class="mb-0">$50.00</h3>
								<div class="mb-3">
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small class="fa fa-star text-primary"></small>
									<small>(29)</small>
								</div>
								<h5 class="mb-4">Full Preparation
                                    Course</h5>
							</div>
                            <div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>1 on 1 Live Sessions</small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>30 Days</small>
								<small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>230 Students</small>
							</div>
                            <div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-book text-primary me-2"></i>Mock Speaking Tests</small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-pen text-primary me-2"></i>Writing Task Evaluation/Guidance</small>
								<small class="flex-fill text-center py-2"><i class="fa fa-music text-primary me-2"></i>Listening and Reading Guidance</small>
							</div>
                            <div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-page text-primary me-2"></i>Additional material
                                    </small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-users text-primary me-2"></i>Expert guidance</small>
								<small class="flex-fill text-center py-2"><i class="fa fa-blub text-primary me-2"></i>Tips for reading</small>
							</div>
					
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Service End -->
	
	


	
	

			
	

	
@endsection

@section('script')

 
@endsection