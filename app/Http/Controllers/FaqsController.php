<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class FaqsController extends Controller
{
    public function getFAQs(Request $request)
    {
        $faqs = DB::table('tblposts')
            ->select('concern AS question', DB::raw("'tblposts' AS source"))
            ->union(
                DB::table('tblfeedbacks')->select(
                    'feedback AS question',
                    DB::raw("'tblfeedbacks' AS source")
                )
            )
            ->get();

        // Group and sort questions by similarity
        $groupedFaqs = $this->groupSimilarQuestions($faqs);

        // Sort by the number of related questions, descending
        usort($groupedFaqs, function ($a, $b) {
            return count($b['related']) <=> count($a['related']);
        });

        // Pagination as before
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = collect($groupedFaqs)
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $paginatedFAQs = new LengthAwarePaginator(
            $currentPageItems,
            count($groupedFaqs),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('moderator.mfaqs', ['faqs' => $paginatedFAQs]);
    }

    // Function to group similar questions using Jaccard similarity
    private function groupSimilarQuestions($faqs)
    {
        $similarGroups = [];
        $processed = [];

        foreach ($faqs as $faq) {
            $question = $faq->question;

            // Skip if already processed
            if (in_array($question, $processed)) {
                continue;
            }

            $relatedQuestions = [$question];

            // Compare with other questions to find similar ones
            foreach ($faqs as $otherFaq) {
                if ($faq === $otherFaq) {
                    continue;
                }

                $otherQuestion = $otherFaq->question;

                // Calculate Jaccard similarity
                $similarity = $this->calculateJaccardSimilarity(
                    $question,
                    $otherQuestion
                );

                if ($similarity >= 0.5) {
                    // Adjust threshold as needed
                    $relatedQuestions[] = $otherQuestion;
                    $processed[] = $otherQuestion;
                }
            }

            // Add group to the result
            $similarGroups[] = [
                'question' => $question,
                'related' => array_unique($relatedQuestions),
            ];
        }

        return $similarGroups;
    }

    // Jaccard Similarity calculation
    private function calculateJaccardSimilarity($str1, $str2)
    {
        $tokens1 = explode(' ', strtolower($str1));
        $tokens2 = explode(' ', strtolower($str2));

        $intersection = array_intersect($tokens1, $tokens2);
        $union = array_unique(array_merge($tokens1, $tokens2));

        return count($intersection) / count($union);
    }

    // Method to fetch related questions dynamically based on the keyword
    public function fetchRelatedQuestions(Request $request)
    {
        $keyword = $request->query('keyword');

        // Fetch all related questions from `tblposts` and `tblfeedbacks` based on the keyword
        $relatedQuestions = DB::table('tblposts')
            ->where('concern', 'LIKE', "%{$keyword}%")
            ->pluck('concern') // Get the 'concern' column from 'tblposts'
            ->merge(
                DB::table('tblfeedbacks')
                    ->where('feedback', 'LIKE', "%{$keyword}%")
                    ->pluck('feedback') // Get the 'feedback' column from 'tblfeedbacks'
            )
            ->unique() // Ensure uniqueness in case of exact duplicates
            ->toArray();

        return response()->json(['relatedQuestions' => $relatedQuestions]);
    }

    // Search FAQs
    // Search FAQs
    public function searchFAQs(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Query `tblposts` and `tblfeedbacks` for matching questions or concerns
        $faqs = DB::table('tblposts')
            ->select('concern AS question', DB::raw("'tblposts' AS source"))
            ->where('concern', 'LIKE', "%{$searchQuery}%")
            ->union(
                DB::table('tblfeedbacks')
                    ->select(
                        'feedback AS question',
                        DB::raw("'tblfeedbacks' AS source")
                    )
                    ->where('feedback', 'LIKE', "%{$searchQuery}%")
            )
            ->get();

        // Group and sort similar questions as done in getFAQs
        $groupedFaqs = $this->groupSimilarQuestions($faqs);

        // Sort by the number of related questions, descending
        usort($groupedFaqs, function ($a, $b) {
            return count($b['related']) <=> count($a['related']);
        });

        // Pagination setup
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = collect($groupedFaqs)
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $paginatedFAQs = new LengthAwarePaginator(
            $currentPageItems,
            count($groupedFaqs),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Pass the paginated and filtered FAQs to the Blade view with search query
        return view('moderator.mfaqs', [
            'faqs' => $paginatedFAQs,
            'searchQuery' => $searchQuery,
        ]);
    }
}
