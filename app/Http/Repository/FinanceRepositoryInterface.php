<?php

namespace App\Http\Repository;

use App\Models\Income;
use App\Models\Costs;

interface FinanceRepositoryInterface
{
    public function findById(int $id): ?Income;

    // public function findByTitle(string $title): ?Note;
    public function save(Income $note, array $data);
}