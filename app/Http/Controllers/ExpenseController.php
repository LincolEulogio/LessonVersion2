<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expense.index', compact('expenses'));
    }

    public function create()
    {
        return view('expense.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense' => 'required|string|max:128',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $date = \Carbon\Carbon::parse($request->date);

        Expense::create([
            'expense' => $request->expense,
            'amount' => $request->amount,
            'date' => $request->date,
            'expenseday' => $date->format('d'),
            'expensemonth' => $date->format('m'),
            'expenseyear' => $date->format('Y'),
            'note' => $request->note,
            'create_date' => now(),
            'userID' => auth()->id(),
            'usertypeID' => auth()->user()->usertypeID ?? 1,
            'uname' => auth()->user()->name,
            'schoolyearID' => session('schoolyearID', 1),
        ]);

        return redirect()->route('expense.index')->with('success', 'Gasto registrado correctamente.');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expense.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        
        $request->validate([
            'expense' => 'required|string|max:128',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $date = \Carbon\Carbon::parse($request->date);

        $expense->update([
            'expense' => $request->expense,
            'amount' => $request->amount,
            'date' => $request->date,
            'expenseday' => $date->format('d'),
            'expensemonth' => $date->format('m'),
            'expenseyear' => $date->format('Y'),
            'note' => $request->note,
        ]);

        return redirect()->route('expense.index')->with('success', 'Gasto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expense.index')->with('success', 'Gasto eliminado correctamente.');
    }
}
