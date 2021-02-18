<?php

use Illuminate\Pagination\LengthAwarePaginator;

/*
 * Custom Paginate helper. Meta will adjust the
 * paginated urls based on the params provided
 * during search.
 */
if (!function_exists('paginated')) {
    /**
     * @param LengthAwarePaginator $results
     * @param mixed $resource
     * @param int $page
     * @param array $params
     */
    function paginated($results, $resource, $page = 1, $params = [])
    {
        if (!($results instanceof LengthAwarePaginator)) {
            throw new Exception('Parameter results must be from an eloquent paginate query.');
        }

        // set the custom url params
        $urlParams = http_build_query($params);

        $nextPageUrl = ($results->nextPageUrl()) ? $results->nextPageUrl() . '&' . $urlParams : null;
        $previousPageUrl = ($results->previousPageUrl()) ? $results->previousPageUrl() . '&' . $urlParams : null;

        return [
            'data' => $resource::collection($results),
            'meta' => [
                'total' => $results->total(),
                'currentPage' => $page,
                'lastPage' => $results->lastPage(),
                'perPage' => $results->perPage(),
                'previousPageUrl' => $previousPageUrl,
                'nextPageUrl' => $nextPageUrl,
                'url' => $results->url($page) . '&' . $urlParams,
            ],
        ];
    }
}
