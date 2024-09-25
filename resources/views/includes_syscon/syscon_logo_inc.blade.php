<!-- resources/views/includes/logo.blade.php -->

@if ($sysconData->isNotEmpty() && !empty($sysconData->first()->logo_path))
    <img src="{{ Storage::url($sysconData->first()->logo_path) }}" alt="Logo" />
@else
    <img src="{{ asset('../imgs/Lawminary_Logo_2-Gold.png') }}" alt="Logo">
@endif
