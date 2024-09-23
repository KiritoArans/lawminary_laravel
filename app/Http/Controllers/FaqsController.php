<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function getFAQs()
    {
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

        // Pass the FAQs to the Blade view
        return view('moderator.mfaqs', compact('faqs'));
    }
}
