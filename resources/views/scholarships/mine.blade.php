@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <main class="content">
        <div class="container-fluid p-0">

            @foreach ($applyScholarships as $item)
                @if ($item->payment_status == 'unpaid')
                    <div class="row">



                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="exampleModalLabel">Payment  Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="makePaymentForm" style="display: none">



                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input class="form-control" type="text" id="name"
                                                            name="name" placeholder="Enter Full Name"
                                                            value="{{ Auth::user()->name }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" type="email" id="email"
                                                            name="email" placeholder="example@example.com"
                                                            value="{{ Auth::user()->email }}" readonly>
                                                    </div>
                                                </div>

                                                <br>

                                                @php
                                                    $student = App\Models\Students::where(
                                                        'user_id',
                                                        auth()->user()->id,
                                                    )->first();
                                                    $mobile = $student ? $student->mobile : 'Not Found';
                                                @endphp

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone_number">Mobile Number</label>
                                                        <input class="form-control" type="text" id="phone_number"
                                                            name="phone_number" placeholder="e.g., +2557xxxxx"
                                                            value="{{ $mobile }}">
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Due Amount (USD)</label>
                                                        <input class="form-control" type="number" id="amount"
                                                            name="amount" placeholder="0.00" value="250" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-primary">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        @if($item->status == 'approved')
                        <p class="alert alert-primary" role="alert" data-toggle="modal" data-target="#exampleModal">
                            Please pay your $250 USD application fee within 7 days to avoid cancellation.
                            <a href="#" id="payNowLink">Click here to Pay</a>
                        </p>
                        @elseif($item->status == 'rejected')

                        <p class="alert alert-danger" role="alert" data-toggle="modal">
                          Your Application has been REJECT!!!! Please Contact the Administrator for Assistance.
                        </p>


                        @endif



                    </div>
                @elseif ($item->payment_status == 'paid')
                    <div class="row">
                        <p class="badge bg-warning text-lg">
                            >>>>> Your Scholarship is being processed by our staff <<<<<< </p>
                    </div>
                @endif
            @endforeach


            <div class="card">
                <div class="card-header">


                    <div class="row">
                        <div class="col">
                            <h1 class="h3 mb-3">My Scholarships Applications</h1>






                            {{--
                            <div class="row">
                                <p class="badge bg-success text-lg">
                                   >>>>> Congratulations scholarship fee amount of $150 through Mobile Number 07809120120, 7 days before deadline! <a href="#">Pay Now</a> <<<<<<
                                </p>
                            </div> --}}

                        </div>

                    </div>
                </div>
                <div class="card-body">



                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Application ID</th>
                                        <th>Application Status</th>
                                        <th>Application Fee</th>
                                        <th>Payment Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach ($applyScholarships as $item)
                                    <tr>
                                        <td><span class="badge bg-success"> {{ strtoupper($item->application_id) }}</span>
                                        </td>

                                        <td>

                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning"> {{ strtoupper($item->status) }}</span>
                                            @elseif($item->status == 'approved')
                                                <span class="badge bg-primary"> {{ strtoupper($item->status) }}</span>
                                            @elseif($item->status == 'rejected')
                                                <span class="badge bg-danger"> {{ strtoupper($item->status) }}</span>
                                            @else
                                                <span class="badge bg-danger">No status application</span>
                                            @endif


                                        </td>

                                        <td> $ {{ $item->application_fee }}</td>

                                        <td>{{ strtoupper($item->payment_status) }}</td>

                                        <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>

                                        <td><a href="#" class="btn btn-primary text-white"><i
                                                    class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {

            $('#payNowLink').click(function(e) {
                e.preventDefault();
                $('#makePaymentForm').show(); // Display the payment form
            });

            $('#makePaymentForm').submit(function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var email = $('#email').val();
                var phone_number = $('#phone_number').val();
                var amount = $('#amount').val();

                // Make payment
                makePayment(amount, email, phone_number, name);
            });

            function makePayment(amount, email, phone_number, name) {
                FlutterwaveCheckout({
                    public_key: "FLWPUBK-136a87478af55055105c297751db70fc-X",
                    tx_ref: "txref-DI0NzMx13",
                    amount: amount,
                    currency: "USD",
                    payment_options: "card, banktransfer, ussd",
                    meta: {
                        source: "docs-inline-test",
                        consumer_mac: "92a3-912ba-1192a"
                    },
                    customer: {
                        email: email,
                        phone_number: phone_number,
                        name: name
                    },
                    customizations: {
                        title: "IMS Scholarships",
                        description: "Test Payment",
                        logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png"
                    },
                    callback: function(data) {
                        console.log("Payment callback:", data);
                        // Handle payment callback response here (e.g., show success message)
                    },
                    onclose: function() {
                        console.log("Payment cancelled!");
                    }
                });
            }
        });
    </script>
@endsection
