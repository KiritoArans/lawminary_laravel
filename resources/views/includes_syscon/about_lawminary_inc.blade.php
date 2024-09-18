@if ($sysconData->isNotEmpty() && $sysconData->first()->about_lawminary)
    <div class="about-lawminary">
        @foreach (preg_split('/(\r?\n)+/', $sysconData->first()->about_lawminary) as $paragraph)
            <p>{!! trim($paragraph) !!}</p>
        @endforeach
    </div>
@else
    <p>No information about Lawminary available.</p>
@endif
