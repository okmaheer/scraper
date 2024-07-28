<div class="modal fade" id="test-category-{{ $test->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px"  style="max-width:600px;">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="card h-100 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center;"><p>Choose the Module which you would like to practice.</p>
                   
                  </div>

                     <div class="row">
                        <div class="col-md-6 mt-2">
                            <a class="btn btn-outline-primary btn-lg ms-5"
                            href="{{ route('show.listening.test', ['id' => $test->id]) }}"
                            style="border-radius:30px">Listening Test</a>
                  
                  
                        </div>

                        <div class="col-md-6  mt-2">
                            <a class="btn btn-outline-primary btn-lg ms-5"
                            href="{{ route('show.reading.test', ['id' => $test->id]) }}" style="border-radius:30px">
                            Reading Test </a>
                        </div>
                     </div>
                   
                 
               
            </div>
        </div>
        <!--end::Modal content-->
    </div>

</div>
