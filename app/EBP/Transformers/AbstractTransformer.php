<?php

namespace App\EBP\Transformers;

use League\Fractal;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

abstract class AbstractTransformer extends Controller
{
    /**
     * Returns paginated result of any model.
     * @param        $query
     * @param string $actionTaken
     * @param        $transformer
     * @param        $lastSyncDate
     * @param int    $perPage
     * @return array
     */
    public function getPaginatedResult($query, string $actionTaken, $transformer, $lastSyncDate, $perPage = 5)
    {
        if ($lastSyncDate) {
            if ($actionTaken == 'created_at') {
                $query->where('created_at', '>=', $lastSyncDate);
            } else if ($actionTaken == 'updated_at') {
                $query->where('updated_at', '>=', $lastSyncDate)
                    ->where('created_at', '<', $lastSyncDate)
                    ->whereRaw('created_at != updated_at');
            } else {
                $query->where('deleted_at', '>=', $lastSyncDate)
                    ->where('created_at', '<', $lastSyncDate)
                    ->onlyTrashed();
            }
        } else {
            if ($actionTaken != 'created_at') {
                $query->where('id', 'empty');
            }
        }
        $paginator = $query->orderBy('id', 'desc')->paginate($perPage);
        $objects   = $paginator->getCollection();
        $resource  = new Fractal\Resource\Collection($objects, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $this->fractal->createData($resource)->toArray();
    }

}