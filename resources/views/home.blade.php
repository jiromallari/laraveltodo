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
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action active"><h1><i class="fas fa-home"></i> HOME</h1></a>
                    @endif

                    @if (Route::has('wallet'))
                    <a href="{{ route('wallet') }}" class="list-group-item list-group-item"><h1 class="text-primary"><i class="fas fa-wallet"></i>{{ __('Wallet') }}</h1></a>
                    @endif

                    <a href="#" class="list-group-item list-group-item"><h2 class="text-primary"><i class="fas fa-chart-area"></i> REPORTS</h2></a>

                    @if (Route::has('transaction'))
                    <a href="{{ route('transaction') }}" class="list-group-item list-group-item"><h3 class="text-primary"><i class="fas fa-file-invoice"></i> TRANSACTIONS</h3></a>
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
            <div class="col-6 ml-lg-5" style="font-family:'Helvetica Neue';">
                <div class="flash-message">

                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' .$msg))
                    <p class="alert alert-{{ $msg }}"> {{ Session::get('alert-' .$msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><button type="button" class="close" data-dismiss="alert">&times;</button></p>

                    @endif
                    @endforeach
                </div>
                <p class="mt-3">
                    <button class="btn btn-success col-xl" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <h2>Click to enter transaction</h2>
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="container align-middle">
                        <div class="row justify-content-lg-center">
                            <div class="card col-lg mt-3 shadow-lg">
                                <div class="card-header" style="font-family:'Helvetica Neue';"><h4>Enter Transaction</h4></div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('transaction.store') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Type of Transaction </label>
                                            <select name="type_of_transaction" class="custom-select col-md-6" id="type_of_transaction" required autocomplete="name" autofocus>
                                                <option selected="" disabled selected>Open to select</option>
                                                <option value="Food and Drinks">Food and Drinks</option>
                                                <option value="Bills and Payment">Bills and Payment</option>
                                                <option value="Entertainment">Entertainment</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Company </label>
                                            <input type="text" class="form-control col-md-6" placeholder="Company" name="company" required autocomplete="name" autofocus>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Amount Due </label>
                                            <input type="number" class="form-control col-md-6" placeholder="Amount Due" name="amount_due" required autocomplete="name" autofocus>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Payment </label>
                                            <input type="number" class="form-control col-md-6" placeholder="Payment" name="payment" required autocomplete="name" autofocus>
                                        </div>
<!--                                        <div class="form-group row">-->
<!--                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Subscription </label>-->
<!--                                            <input type="text" class="form-control col-md-6" placeholder="Subscription" name="subscription" required autocomplete="name" autofocus>-->
<!--                                        </div>-->
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Subscription </label>
                                            <select name="subscription" class="custom-select col-md-6" id="subscription" required autocomplete="name" autofocus>
                                                <option selected="" disabled selected>Open to select</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Yearly">Yearly</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Due Date </label>
                                            <input type="date" class="form-control col-md-6" placeholder="Due Date" name="due_date" required autocomplete="name" autofocus>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right" for="inputDefault">Date of Payment </label>
                                            <input type="datetime-local" class="form-control col-md-6" placeholder="Date of Payment" name="date_of_payment" required autocomplete="name" autofocus>
                                        </div>
                                        <div class="form-group row">
                                            <label type="hidden" class="col-md-4 col-form-label text-md-right"></label>
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="users_id">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-form-label offset-md-4">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                    Submit Transaction
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-3 ">
                <div class="card bg-light shadow-lg  mt-3 mb-3" style="width: 21rem; height: 15rem">
                    <div class="card-body">
                        <h2 class="card-title">Food & Drinks</h2>
                        <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_breakfast_psiw.svg" align="center" width="90%"/>
                    </div>
                </div>
            <div class="card bg-light shadow-lg  mt-2 mb-3" style="width: 21rem; height: 15rem">
                <div class="card-body">
                    <h2 class="card-title">Bills & Payment</h2>
                    <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_online_payments_luau.svg" align="center" width="88%"/>
                </div>
            </div>
            <div class="card bg-light shadow-lg  mt-2 mb-3" style="width: 21rem; height: 15rem">
                <div class="card-body">
                    <h2 class="card-title">Entertainment</h2>
                    <img src= "http://localhost/BillTracker/public/assets/img/illustration/undraw_landscape_mode_53ej.svg" align="center" width="73%"/>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>




</body>

@endsection

