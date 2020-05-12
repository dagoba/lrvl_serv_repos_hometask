<?php

namespace App\Http\Services;

use App\Http\Repository\FinanceRepositoryInterface;
use App\Models\Income;
use App\Models\Costs;
use Illuminate\Database\Eloquent\Collection;

class FinanceService implements FinanceServiceInterface
{

    private $financeRepository;

    public function __construct(FinanceRepositoryInterface $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    /**
     * @param int $id
     *
     * @return Income
     * @throws \Exception
     */
    public function getNoteById(int $id): Income
    {
        $note = $this->financeRepository->findById($id);
        if (!$note) {
            throw new \Exception('Note not found');
        }
        return $note;
    }

    /**
     * @param int|null $page
     * @return Collection
     */
    public function getAllNotes(int $page = null): Collection
    {
        // TODO: Implement getAllNotes() method.
    }

    /**
     * @param array $noteData
     * @return int
     * @throws \Exception
     */
    public function createNote(array $noteData): int
    {
        //
    }

    /**
     * @param int $id
     * @param array $noteData
     * @return int
     * @throws \Exception
     */
    public function updateNote(int $id, array $noteData): int
    {
        $note = $this->financeRepository->findById($id);
        $this->financeRepository->save($note, $noteData);

        return $note->id;
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteNote(int $id): void
    {
        // TODO: Implement deleteNote() method.
    }
    
}