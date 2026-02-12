<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['invoice', 'student'])->get();
        return view('payment.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $invoiceID = $request->get('invoiceID');
        $invoice = null;
        if ($invoiceID) {
            $invoice = Invoice::with('student')->findOrFail($invoiceID);
        }
        return view('payment.add', compact('invoice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoiceID' => 'required|exists:invoice,invoiceID',
            'paymentamount' => 'required|numeric|min:0.01',
            'paymenttype' => 'required|string',
            'paymentdate' => 'required|date',
        ]);

        $invoice = Invoice::findOrFail($request->invoiceID);
        $date = \Carbon\Carbon::parse($request->paymentdate);

        $payment = Payment::create([
            'schoolyearID' => session('schoolyearID', 1),
            'invoiceID' => $request->invoiceID,
            'studentID' => $invoice->studentID,
            'paymentamount' => $request->paymentamount,
            'paymenttype' => $request->paymenttype,
            'paymentdate' => $request->paymentdate,
            'paymentday' => $date->format('d'),
            'paymentmonth' => $date->format('m'),
            'paymentyear' => $date->format('Y'),
            'userID' => auth()->id(),
            'usertypeID' => auth()->user()->usertypeID ?? 1,
            'uname' => auth()->user()->name,
            'transactionID' => 'TRX-' . strtoupper(uniqid()),
            'notice' => $request->notice,
        ]);

        // Update Invoice status
        $totalPaid = Payment::where('invoiceID', $invoice->invoiceID)->sum('paymentamount');
        $invoice->paidamount = $totalPaid;
        
        $discountAmount = ($invoice->amount * $invoice->discount) / 100;
        $netAmount = $invoice->amount - $discountAmount;

        if ($totalPaid >= $netAmount) {
            $invoice->status = 2; // Fully paid
            $invoice->paidstatus = 2;
        } elseif ($totalPaid > 0) {
            $invoice->status = 1; // Partially paid
            $invoice->paidstatus = 1;
        } else {
            $invoice->status = 0; // Unpaid
            $invoice->paidstatus = 0;
        }
        $invoice->save();

        return redirect()->route('invoice.show', $invoice->invoiceID)->with('success', 'Pago registrado correctamente.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $invoiceID = $payment->invoiceID;
        $payment->delete();

        // Recalculate invoice status
        $invoice = Invoice::findOrFail($invoiceID);
        $totalPaid = Payment::where('invoiceID', $invoiceID)->sum('paymentamount');
        $invoice->paidamount = $totalPaid;
        
        $discountAmount = ($invoice->amount * $invoice->discount) / 100;
        $netAmount = $invoice->amount - $discountAmount;

        if ($totalPaid >= $netAmount) {
            $invoice->status = 2;
            $invoice->paidstatus = 2;
        } elseif ($totalPaid > 0) {
            $invoice->status = 1;
            $invoice->paidstatus = 1;
        } else {
            $invoice->status = 0;
            $invoice->paidstatus = 0;
        }
        $invoice->save();

        return redirect()->back()->with('success', 'Pago eliminado correctamente.');
    }
}
