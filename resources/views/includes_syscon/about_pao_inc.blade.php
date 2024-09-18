@if ($sysconData->isNotEmpty() && $sysconData->first()->about_pao)
    <div class="about-pao">
        @foreach (preg_split('/(\r?\n)+/', $sysconData->first()->about_pao) as $paragraph)
            <p>{!! trim($paragraph) !!}</p>
        @endforeach
    </div>
@else
    <p>No information about PAO available.</p>
@endif
