<div class="container">
    <div class="row">
        <div class="col-12">

            @if ($question->image_url)
                {{-- <button class="mb-1" type="button" data-bs-toggle="modal" data-bs-target="#question-image-{{ $question->id }}"> --}}
                <img src="{{ $question->image_url }}" alt="{{ $question->image_url }}">

                {{-- </button> --}}
                </br>
            @endif
            <p >
                @if ($question->fillInBlank->fill_1)
                    {!! $question->fillInBlank->fill_1 !!}  <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                        onkeyup="changeColorCodefill(this.value,'question_{{ $question->id }}')" name="fill[{{ $question->id }}][]"
                        id="fill_{{ $question->fillInBlank->id }}">
                @endif

                @if ($question->fillInBlank->fill_2)
                    {!! $question->fillInBlank->fill_2 !!} 
                    @if ($question->fillInBlank->ans_sec_1 || $question->fillInBlank->ans_sec_2 || $question->fillInBlank->ans_sec_3)
                      <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                            onkeyup="changeColorCodefill(this.value,'question_{{ $question->id }}')" name="fill[{{ $question->id }}][]"
                            id="fill_{{ $question->fillInBlank->id }}">
                    @endif
                @endif

                @if ($question->fillInBlank->fill_3)

                    {!! $question->fillInBlank->fill_3 !!}
                    @if ($question->fillInBlank->ans_third_1 || $question->fillInBlank->ans_third_2 || $question->fillInBlank->ans_third_3)
                         <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                            onkeyup="changeColorCodefill(this.value,'question_{{ $question->id }}')"
                            name="fill[{{ $question->id }}][]" id="fill_{{ $question->fillInBlank->id }}">
                    @endif
                @endif

                @if ($question->fillInBlank->fill_4)
                    {!! $question->fillInBlank->fill_4 !!}  <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                        onkeyup="changeColorCodefill(this.value,'question_{{ $question->id }}')" name="fill[{{ $question->id }}][]"
                        id="fill_{{ $question->fillInBlank->id }}">
                @endif


            </p>
            <div>
            </div>
        </div>
    </div>
</div>
