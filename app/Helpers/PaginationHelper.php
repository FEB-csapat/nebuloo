<?php

namespace App\Helpers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationHelper
{
    public static function paginate(AnonymousResourceCollection $results, $showPerPage = 10)
    {
        $pageNumber = Paginator::resolveCurrentPage('page');
        
        $baseUrl = Paginator::resolveCurrentPath();
        $total = $results->count();
        $currentPage = $pageNumber;
        $perPage = $showPerPage ?? config('app.pagination.per_page');

        $items = $results->forPage($pageNumber, $showPerPage)->values();

        $paginator = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => $baseUrl,
                'pageName' => 'page',
            ]
        );

        $links = [];

        if ($paginator->currentPage() > 1) {
            $links[] = [
                'url' => $paginator->previousPageUrl(),
                'label' => 'Previous',
                'active' => false,
            ];
        }

        foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url) {
            $links[] = [
                'url' => $url,
                'label' => $page,
                'active' => $paginator->currentPage() === $page,
            ];
        }

        if ($paginator->hasMorePages()) {
            $links[] = [
                'url' => $paginator->nextPageUrl(),
                'label' => 'Next',
                'active' => false,
            ];
        }

        return [
            'data' => $items,
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $currentPage,
                'from' => $paginator->firstItem(),
                'last_page' => $paginator->lastPage(),
                'links' => $links,
                'path' => $baseUrl,
                'per_page' => $perPage,
                'to' => $paginator->lastItem(),
                'total' => $total,
            ],
        ];
    }
}