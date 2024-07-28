<div class="modal fade" id="testimonial-image-{{ $testimonial->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered "style="max-width:800px;">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="card h-100 shadow-lg">


                <img src="{{ asset('frontend/testimonial/' . $testimonial->image) }}" alt="" sizes="" srcset="">
            </div>
        </div>
        <!--end::Modal content-->
    </div>
  
</div>
