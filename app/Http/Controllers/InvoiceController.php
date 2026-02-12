<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Feetype;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['student', 'classes'])->get();
        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        $classes = Classes::all();
        $feetypes = Feetype::all();
        return view('invoice.add', compact('classes', 'feetypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classesID' => 'required|exists:classes,classesID',
            'studentID' => 'required', // could be "all" or ID
            'feetypesID' => 'required|exists:feetypes,feetypesID',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'date' => 'required|date',
        ]);

        $feetype = Feetype::findOrFail($request->feetypesID);
        $date = \Carbon\Carbon::parse($request->date);
        
        $studentIDs = [];
        if ($request->studentID === 'all') {
            $studentIDs = Student::where('classesID', $request->classesID)->pluck('studentID')->toArray();
        } else {
            $studentIDs = (array)$request->studentID;
        }

        foreach ($studentIDs as $sID) {
            Invoice::create([
                'schoolyearID' => session('schoolyearID', 1),
                'classesID' => $request->classesID,
                'studentID' => $sID,
                'feetypesID' => $request->feetypesID,
                'feetypes' => $feetype->feetypes,
                'amount' => $request->amount,
                'discount' => $request->discount ?? 0,
                'paidamount' => 0,
                'status' => 0, // 0: unpaid, 1: partially, 2: fully
                'date' => $request->date,
                'day' => $date->format('d'),
                'month' => $date->format('m'),
                'year' => $date->format('Y'),
                'paidstatus' => 0,
                'userID' => auth()->id(),
                'usertypeID' => auth()->user()->usertypeID ?? 1,
                'uname' => auth()->user()->name,
                'create_date' => now(),
            ]);
        }

        return redirect()->route('invoice.index')->with('success', 'Factura(s) creada(s) correctamente.');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['student', 'classes'])->findOrFail($id);
        $payments = \App\Models\Payment::where('invoiceID', $id)->get();
        return view('invoice.view', compact('invoice', 'payments'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $classes = Classes::all();
        $feetypes = Feetype::all();
        $students = Student::where('classesID', $invoice->classesID)->get();
        return view('invoice.edit', compact('invoice', 'classes', 'feetypes', 'students'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $request->validate([
            'feetypesID' => 'required|exists:feetypes,feetypesID',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'date' => 'required|date',
        ]);

        $feetype = Feetype::findOrFail($request->feetypesID);
        $date = \Carbon\Carbon::parse($request->date);

        $invoice->update([
            'feetypesID' => $request->feetypesID,
            'feetypes' => $feetype->feetypes,
            'amount' => $request->amount,
            'discount' => $request->discount ?? 0,
            'date' => $request->date,
            'day' => $date->format('d'),
            'month' => $date->format('m'),
            'year' => $date->format('Y'),
        ]);

        return redirect()->route('invoice.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        \App\Models\Payment::where('invoiceID', $id)->delete();

        return redirect()->route('invoice.index')->with('success', 'Factura eliminada correctamente.');
    }
}
