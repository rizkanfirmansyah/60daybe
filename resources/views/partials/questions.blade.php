<div id="for-questions" class="my-5">
    <div class="container">
        <div class="row text-center row-title">
            <h2>Frequently Asked Questions</h2>
            <p>Audience questions that can be asked on our platform</p>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="accordion col-lg-10" id="questions">
                @foreach ($questions as $question)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="question-{{ $question->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThe{{ $question->id }}"
                                aria-expanded="false"
                                aria-controls="collapseThe{{ $question->id }}">
                                {{ $question->question }}
                            </button>
                        </h2>
                        <div id="collapseThe{{ $question->id }}" class="accordion-collapse collapse"
                            aria-labelledby="question-{{ $question->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $question->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
