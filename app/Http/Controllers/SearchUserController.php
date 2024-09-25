<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SearchUserController extends Controller
{
    public function findPossibleCharges(Request $request)
    {
        Log::info('findPossibleCharges method was called.');

        $concern = $request->input('user_concern');
        Log::info('User concern: ' . $concern);

        // Get the current environment variables and add them to the process
        $env = array_merge($_ENV, ['SystemRoot' => getenv('SystemRoot')]);

        $process = new Process(
            [
                base_path('venv/Scripts/python'),
                base_path('app/PythonScripts/concern_analyzer.py'),
                $concern,
            ],
            null,
            $env
        );

        $process->run();

        if (!$process->isSuccessful()) {
            Log::error('Python script failed: ' . $process->getErrorOutput());
            return view('users.search', [
                'possibleCharges' => [],
                'concern' => $concern,
                'error' => $process->getErrorOutput(),
            ]);
        }

        $output = $process->getOutput();
        $keywords = json_decode($output, true);

        Log::info('Extracted keywords: ' . json_encode($keywords));

        // Prepare bindings for secure queries
        $bindingsArray = array_map(function ($keyword) {
            return "%{$keyword}%";
        }, $keywords);

        // Run the actual query with relevance calculation
        $possibleCharges = \DB::table('tblbooktwo')
            ->select('tblbooktwo.*')
            ->selectRaw(
                '
            (
                ' .
                    implode(
                        ' + ',
                        array_fill(
                            0,
                            count($keywords),
                            '(CASE WHEN description LIKE ? THEN 1 ELSE 0 END)'
                        )
                    ) .
                    '
            ) as relevance
        ',
                $bindingsArray
            )
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('description', 'LIKE', "%{$keyword}%");
                }
            })
            ->orderByDesc('relevance')
            ->limit(5)
            ->get();

        Log::info('Query result: ' . json_encode($possibleCharges));

        return view('users.search', [
            'possibleCharges' => $possibleCharges,
            'concern' => $concern,
        ]);
    }
}
