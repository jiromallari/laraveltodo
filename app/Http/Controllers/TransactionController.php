<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $user_id = Auth::user()->id;
        $transactions = Transaction::where(['users_id' => $user_id])->paginate(5);

        return view('transaction',compact('transactions'));

        return view('transaction');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $transaction = new Transaction();
        $transaction->type_of_transaction = $request->input('type_of_transaction');
        $transaction->company = $request->company;
        $transaction->amount_due = $request->amount_due;
        $transaction->payment = $request->payment;
        $transaction->balance = ($transaction->amount_due - $transaction->payment)  ;
        $transaction->subscription = $request->input('subscription');
        $transaction->due_date = $request->due_date;
        $transaction->date_of_payment = $request->date_of_payment;
        $transaction->users_id = $request->users_id;
        $transaction->save();

        if($transaction != null){
            return redirect()->back()->with(session()->flash('alert-success', 'Transaction created.'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

        Transaction::where('log_id', $transaction)->delete();
        return redirect()->back()->with(session()->flash('alert-warning', 'Transaction deleted.'));
    }
}
