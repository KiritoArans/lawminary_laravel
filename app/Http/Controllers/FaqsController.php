<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator; // Import LengthAwarePaginator
use Illuminate\Support\Collection; // Import Collection

class FaqsController extends Controller
{
    public function getFAQs(Request $request)
    {
        // Accepting request for pagination
        // Path to Python script
        $pythonScript = base_path('app/PythonScripts/spacy_analyze.py');

        // Ensure the correct Python executable is used
        $pythonExecutable =
            'C:/xampp/htdocs/lawminary_laravel/venv/Scripts/python.exe';

        // Run the Python script using shell_exec
        $command = escapeshellcmd("$pythonExecutable $pythonScript");
        $output = shell_exec($command);

        // Check if the output exists
        if ($output === null) {
            return response()->json(
                ['error' => 'Failed to execute Python script'],
                500
            );
        }

        // Decode the JSON output from the Python script
        $faqs = json_decode($output, true);

        // Check if the JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(
                ['error' => 'JSON decoding failed: ' . json_last_error_msg()],
                500
            );
        }

        // Convert the decoded JSON into a Laravel Collection for pagination
        $faqCollection = collect($faqs); // Convert array to collection

        // Manual Pagination (since we're using a collection)
        $perPage = 10; // Define how many items you want per page
        $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Get the current page

        // Slice the data to get the items for the current page
        $currentPageItems = $faqCollection
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->all();

        // Create LengthAwarePaginator instance
        $paginatedFAQs = new LengthAwarePaginator(
            $currentPageItems,
            $faqCollection->count(), // Total items
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()] // Add pagination path and query
        );

        // Pass the paginated FAQs to the Blade view
        return view('moderator.mfaqs', ['faqs' => $paginatedFAQs]);
    }
}
