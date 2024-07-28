<div class="modal fade" id="test-type" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px" style="max-width:600px;">
        <!--begin::Modal content-->
        <div class="modal-content">
            
            <div class="card h-100 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title"><p style="text-align: center;">Choose the Type of Test which you would like to take.</p>
                   
                  </div>
                
                  <div class="row">
                    <div class="col-md-6 mt-2">
                    <a class="btn btn-outline-primary btn-lg"
                        href="{{ route('academic.training.test', ['type' => '1']) }}"
                        style="border-radius:30px">Academic Test  </a>
                </div>
               
                    <div class="col-md-6 mt-2">
                    <a class="btn btn-outline-primary btn-lg"
                        href="{{ route('general.training.test', ['type' => '1']) }}"
                        style="border-radius:30px"> General Training Test                  </a>
                </div>
            </div>
        </div>
        <!--end::Modal content-->
    </div>
  
</div>
