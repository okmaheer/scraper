<div class="col-12 mt-3 ">
    <p > {!! $question->name !!}</p>
    <div>
        @foreach ($question->options as $key => $option)
            <div>
                @if ($question->image_url)
                    <button type="button" data-bs-toggle="modal" data-bs-target="#question-image-{{ $question->id }}">
                        <span class="indicator-label"> <img src="{{ $question->image_url }}"
                                alt="{{ $question->image_url }}"></span>

                    </button>
                    </br>
                @endif
                <input type="checkbox" onclick="changeColorCode('question_{{ $question->id }}','{{ $question->id }}')"
                    name="fivechoice[{{ $question->id }}][]" value="{{ $option->id }}" id="option-{{ $option->id }}">


                <label for="option-{{ $option->id }}" class="box first">
                    <div class="course"> <span style="border-radius:17%;" class="circle"></span> <span class="subject">

                            {{ $option->name }}
                        </span> </div>
                </label>
            </div>
        @endforeach
    </div>
</div>
