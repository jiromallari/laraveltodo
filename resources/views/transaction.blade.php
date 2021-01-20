@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="http://localhost/BillTracker/public/assets/css/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>


<body id="homeBlade">
<div class="row-fluid">
    <div class="row">
        <div class="col-2 alert-danger text-md-center " id="navbar">
            <div class="list-group col-form-label-lg m-0 p-0">
                <div class="scroll-bar inner">

                    @if (Route::has('home'))
                    <a href="{{ route('home') }}" class="list-group-item list-group-item"><h1 class="text-primary"><i class="fas fa-home"></i> HOME</h1></a>
                    @endif

                    @if (Route::has('wallet'))
                    <a href="{{ route('wallet') }}" class="list-group-item list-group-item"><h1 class="text-primary"><i class="fas fa-wallet"></i> WALLET</h1></a>
                    @endif

                    <a href="#" class="list-group-item list-group-item"><h2 class="text-primary"><i class="fas fa-chart-area"></i> REPORTS</h2></a>

                    @if (Route::has('transaction'))
                    <a href="{{ route('transaction') }}" class="list-group-item list-group-item-action active"><h3><i class="fas fa-file-invoice"></i> TRANSACTIONS</h3></a>
                    @endif

                    <div class="card border-light mb-3" style="max-width: 20rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h4 class="card-title">Light card title</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 alert-danger ml-lg-3">
            <table class="table table-responsive table-bordered mt-3 shadow-lg">
                <tbody>
                <tr class="table-success">
                    <th scope="row">Log ID</th>
                    <th scope="row">Transaction</th>
                    <th scope="row">Company</th>
                    <th scope="row">Amount Due</th>
                    <th scope="row">Payment</th>
                    <th scope="row">Balance</th>
                    <th scope="row">Subscription</th>
                    <th scope="row">Due Date</th>
                    <th scope="row">Date of Payment</th>
                    <th scope="row">Date Created</th>
                    <th scope="row">Action</th>
                </tr>
                @foreach($transactions as $transaction)
                <tr class="table-secondary">
                    <td>{{ $transaction->log_id }}</td>
                    <td>{{ $transaction->type_of_transaction }}</td>
                    <td>{{ $transaction->company }}</td>
                    <td>{{ $transaction->amount_due }}</td>
                    <td>{{ $transaction->payment }}</td>
                    <td>{{ $transaction->balance }}</td>
                    <td>{{ $transaction->subscription }}</td>
                    <td>{{ $transaction->due_date }}</td>
                    <td>{{ $transaction->date_of_payment }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td><form action="{{ route('transaction.destroy',$transaction->log_id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('transaction.edit',$transaction->log_id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="rounded">
                <ul class="pagination justify-content-sm-center">
                    <li class="page-item active shadow-lg"">
                        <a href="'{{$transactions->links()}}</a>"
                    </li>
                </ul>
            </div>
            <div class="container-xl  mt-3 row ml-0 justify-content-sm-center">
                <div class="card bg-light shadow-lg  mt-3 mb-3 mr-2 ml-1" style="width: 21rem; height: 15rem">
                    <div class="card-body">
                        <h2 class="card-title">Food & Drinks</h2>
                        <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_breakfast_psiw.svg" align="center" width="90%"/>
                    </div>
                </div>
                <div class="card bg-light shadow-lg  mt-3 mb-3 mr-2" style="width: 21rem; height: 15rem">
                    <div class="card-body">
                        <h2 class="card-title">Bills & Payment</h2>
                        <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_online_payments_luau.svg" align="center" width="88%"/>
                    </div>
                </div>
                <div class="card bg-light shadow-lg  mt-3 mb-3" style="width: 21rem; height: 15rem">
                    <div class="card-body">
                        <h2 class="card-title">Entertainment</h2>
                        <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_landscape_mode_53ej.svg" align="center" width="73%"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




</body>

@endsection

