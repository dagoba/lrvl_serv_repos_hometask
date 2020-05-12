<?php

namespace App\Http\Services;

use App\Models\Income;
use App\Models\Costs;
use Illuminate\Database\Eloquent\Collection;

interface FinanceServiceInterface
{

    /**
     * @param int $id
     *
     * @throws \Exception
     * @return Income
     */
    public function getNoteById(int $id): Income;

    /**
     * @throws \Exception
     * @param int $id
     * @param array $noteData
     * @return int
     */
    public function updateNote(int $id, array $noteData): int;

}