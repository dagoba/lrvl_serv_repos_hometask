<?php

namespace App\Http\Repository;

use App\Models\Income;
use App\Models\Costs;

class FinanceRepository implements FinanceRepositoryInterface
{

    /** @var Income */
    private $model;

    public function __construct()
    {
        $this->model = app()->make(Income::class);
    }

    public function findById(int $id): ?Income
    {
        return $this->model->find($id);
    }

    public function save(Income $note, array $data)
    {
        $note->name = $data['name'];
        $note->summ = $data['summ'];
        $note->source = $data['source'];
        $note->comment = $data['comment'];
        $note->save();
    }

}