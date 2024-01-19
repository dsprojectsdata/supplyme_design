              <!-- questionair -->
              <div class="d-flex flex-column pb-4">
                        <h2 class="pb-2">{{$questionnaireResponse->questionnaire->title}}</h2>
                        <p>{{$questionnaireResponse->questionnaire->description}}</p>
                </div>
                    @forelse ($questionnaireResponse->answers as $answer)    
                    <h4 class="my-2"><b class="mx-1">Q. {{ $loop->iteration }} </b>{{ $answer->question->question }}</h4>
                        @if ($answer->response_type != 'checkbox' && $answer->response_type != 'file')
                            <p class="my-3">{!! $answer->response !!}</p>
                        @elseif ($answer->response_type == 'checkbox')
                            <p class="my-3">{{ implode(',' , $answer->response) }}
                        @elseif ($answer->response_type == 'file' && $answer->response)
                            <p class="my-3">
                                <a href="{{asset($answer->response)}}" class="btn btn-sm" download="attachment">
                                    Attachment
                                </a>
                            </p>
                        @endif
                    @empty
                        
                    @endforelse
                 <!-- questionair end -->
                 <!-- submit questionnaire -->