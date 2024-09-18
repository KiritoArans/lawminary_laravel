@if ($sysconData->isNotEmpty() && $sysconData->first()->terms_of_service)
    <div class="terms-of-service">
        @foreach (preg_split('/(\r?\n)+/', $sysconData->first()->terms_of_service) as $paragraph)
            <p>{!! trim($paragraph) !!}</p>
        @endforeach
    </div>
@else
    <p>No terms of service available.</p>
@endif
