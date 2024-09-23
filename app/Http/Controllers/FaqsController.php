<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;

class FaqsController extends Controller
{
    public function getFAQs()
    {
        // Define the Python script path and Python executable path
        $pythonScript = base_path('app/PythonScripts/spacy_analyze.py');
        $pythonExecutable =
            'C:/xampp/htdocs/lawminary_laravel/venv/Scripts/python.exe';

        // Run the Python script and capture the output
        $output = shell_exec("$pythonExecutable $pythonScript 2>&1");

        // Decode the JSON output
        $faqs = json_decode($output, true);

        // Check if there was an error decoding JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(
                [
                    'error' => 'JSON decoding failed: ' . json_last_error_msg(),
                ],
                500
            );
        }

        // Pass the decoded data to the view
        return view('moderator.mfaqs', ['faqs' => $faqs]);
    }
}
