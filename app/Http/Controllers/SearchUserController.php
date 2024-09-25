<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTwoLaws;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SearchUserController extends Controller
{
    public function findPossibleCharges(Request $request)
    {
        // Get the user's input
        $concern = $request->input('user_concern');

        // Define the Python script path and pass the user's concern
        $process = new Process([
            base_path('venv/Scripts/python'), // Ensure correct Python path
            base_path('app/PythonScripts/concern_analyzer.py'),
            $concern,
        ]);
        $process->run();

        // Check if the process ran successfully
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Get the output from Python (refined keywords)
        $output = $process->getOutput();
        $keywords = json_decode($output, true);

        // Check if $keywords is valid before using it in the query
        if (is_array($keywords) && !empty($keywords)) {
            // Use the keywords to search in the database
            $possibleCharges = BookTwoLaws::where(function ($query) use (
                $keywords
            ) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('synonyms', 'LIKE', "%{$keyword}%");
                }
            })->get();
        } else {
            $possibleCharges = []; // Set as empty if no valid keywords
        }

        // Return the results to the Blade view
        return view('users.search', [
            'possibleCharges' => $possibleCharges,
            'concern' => $concern,
        ]);
    }
}
