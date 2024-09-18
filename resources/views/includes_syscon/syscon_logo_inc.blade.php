<!-- resources/views/includes/logo.blade.php -->

@if ($sysconData->isNotEmpty() && $sysconData->first()->logo_path)
    <img src="{{ Storage::url($sysconData->first()->logo_path) }}" alt="" />
@else
    <p>No logo available</p>
@endif
