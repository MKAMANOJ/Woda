<?php

namespace App\EBP\Repositories;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class BaseRepository
 * @package App\EBP\Repositories
 */
abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * @param       $id
     * @param array $columns
     *
     * @return Collection|null
     */
    public function findWithoutFail(int $id, array $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (\Exception $e) {
            logger()->debug($e);

            return null;
        }
    }

    /**
     * Multi Delete Data
     * @param array $selectedIds
     * @return int
     */
    public function multiDelete(array $selectedIds)
    {
        return $this->model->destroy($selectedIds);
    }
}
