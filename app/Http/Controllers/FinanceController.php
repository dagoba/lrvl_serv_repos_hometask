<?php

namespace App\Http\Controllers;

use App\Http\Services\FinanceService;
use App\Http\Services\FinanceServiceInterface;

use App\Models\Income;
use App\Models\Costs;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Session;

class FinanceController extends Controller
{
    /** @var FinanceServiceInterface */
    private $financeService;

    public function __construct(FinanceServiceInterface $financeService)
    {
        $this->financeService = $financeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();
        $costs = Costs::all();

        return view('finance.index', compact('incomes', 'costs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required|string|max:255|min:3',
            'summ' => 'required|integer',
            'source' => 'required|string|max:255|min:3',
            'comment' => 'required|string|max:10000||min:10',
        ]);

        if($request->type == 'income')
        {
            $income = new Income;

            $income->name = $request->name;
            $income->summ = $request->summ;
            $income->source = $request->source;
            $income->comment = $request->comment;
    
            $income->save();            
        } else if ($request->type == 'costs')
        {
            $costs = new Costs;

            $costs->name = $request->name;
            $costs->summ = $request->summ;
            $costs->source = $request->source;
            $costs->comment = $request->comment;
    
            $costs->save();            
        } else
        {
            return $request;
        }

        Session::flash('success', "Added Note Succesfully!");

        return redirect()->route('finance.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = $this->fetchNoteOrFail($id);
        return view('finance.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = $this->fetchNoteOrFail($id);
        var_dump($note->id);
        return view('finance.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'type' => 'required',
                'name' => 'required|string|max:255|min:3',
                'summ' => 'required|integer',
                'source' => 'required|string|max:255|min:3',
                'comment' => 'required|string|max:10000||min:10',
            ]);

            $this->financeService->updateNote($id, $request->all());
            return redirect(route('finance.show', ['note' => $id]));
        } catch (\Exception $exception) {
            return redirect(route('finance.edit', ['note' => $id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function fetchNoteOrFail(int $id)
    {
        try {
            return $this->financeService->getNoteById($id);
        } catch (\Exception $e) {
            abort(Response::HTTP_NOT_FOUND, $e->getMessage());
        }
    }

}
