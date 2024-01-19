@forelse($conversations as $conversation)
    @if($conversation->attachments)
        @forelse(json_decode($conversation->attachments, true) as $attachment)
        <li class="border-bottom d-flex gap-2 text-start" data-id="{{$conversation->id}}">
            <a href="{{asset($attachment['path'])}}" download="{{$attachment['original_filename']}}">
                <div>
                    <i class="bi bi-file-earmark-arrow-down text-primary"></i>
                    <span class="badge bg-success badge-dot"></span>
                </div>
                <div class="pt-1">
                    <p class="fw-bold mb-0">{{$attachment['original_filename']}}</p>
                    <p class="small text-muted">{{$attachment['display_size']}}</p>
                </div>
            </a>
        </li>
        @empty
        @endforelse
    @endif
@empty
@endforelse