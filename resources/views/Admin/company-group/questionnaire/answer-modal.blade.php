              <!-- questionair -->
              <div class="d-flex flex-column pb-4">
                        <h2 class="pb-2">{{$questionnaire->title}}</h2>
                        <p>{{$questionnaire->description}}</p>
                </div>
                <form id="questionnare-answer-form" action="{{route('feed.submit-questionnaire', $questionnaire->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @forelse ($questionnaire->questions as $question)    
                    <p class="my-2"><b class="mx-1">Q. {{ $loop->iteration }} </b>{{ $question->question }}</p>
                        <div class="input-group">
                            @if ($question->response_type == 'text')
                                <input type="text" class="form-control" name="response[{{$question->id}}]" id="">
                            @elseif ($question->response_type == 'textarea')
                                <textarea name="response[{{$question->id}}]" id="" cols="30" rows="10"></textarea>
                            @elseif ($question->response_type == 'select')
                                <select name="response[{{$question->id}}][]" id="" class="form-control">
                                    <option value="">Select</option>
                                    @forelse ($question->response_values as $responses)
                                        <option value="{{$responses}}">{{ucwords($responses)}}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            @elseif ($question->response_type == 'checkbox')
                                @forelse ($question->response_values as $responses)
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="checkbox" name="response[{{$question->id}}][]" value="{{ $responses }}" id="check-response-{{$question->id}}">
                                        <label class="form-check-label" for="check-response-{{$question->id}}">
                                            {{ucwords($responses)}}
                                        </label>
                                    </div>
                                @empty
                                @endforelse
                            @elseif ($question->response_type == 'radio')
                                @forelse ($question->response_values as $responses)
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="radio" name="response[{{$question->id}}]" value="{{ $responses }}" id="check-response-{{$question->id}}">
                                        <label class="form-check-label" for="check-response-{{$question->id}}">
                                            {{ucwords($responses)}}
                                        </label>
                                    </div>
                                @empty
                                @endforelse
                            @elseif ($question->response_type == 'file')
                                <input type="file" class="form-control" name="response[{{$question->id}}]" id="">
                            @elseif ($question->response_type == 'date')
                                <input type="date" class="form-control" name="response[{{$question->id}}]" id="">
                            @endif

                        </div>
                    @empty
                        
                    @endforelse

                    <div class="input-group mt-2">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                 <!-- questionair end -->
                 <!-- submit questionnaire -->