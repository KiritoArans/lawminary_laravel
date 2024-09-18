<!-- resources/views/includes/logo.blade.php -->

@if ($sysconData->isNotEmpty() && $sysconData->first()->logo_path)
    <img src="{{ $sysconData->first()->logo_path ? Storage::url($sysconData->first()->logo_path) : asset('imgs/Lawminary_Logo_2-Gold.png') }}" alt="Logo" />
@else
    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
@endif
