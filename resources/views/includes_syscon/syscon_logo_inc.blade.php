<!-- resources/views/includes/logo.blade.php -->
@if ($sysconData->isNotEmpty() && !empty($sysconData->first()->logo_path))
    <a href="/home">
        <img src="{{ Storage::url($sysconData->first()->logo_path) }}" alt="Logo" />
    </a>
@else
    <a href="/home">
        <img src="{{ asset('../imgs/Lawminary_Logo_2-Gold.png') }}" alt="Logo">
    </a>
@endif
