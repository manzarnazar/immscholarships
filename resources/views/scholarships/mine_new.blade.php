@extends('../layout/' . $layout)

@section('subhead')
    <title>IMS - Scholarship Portal</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">My Scholarship Applications</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500" id="entries-info"></div>

        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Application ID</th>
                        <th class="whitespace-nowrap">Application Status</th>
                        <th class="whitespace-nowrap">Application Fee</th>
                        <th class="whitespace-nowrap">Payment Status</th>
                        <th class="whitespace-nowrap">Date Created</th>
                        <th class="whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="attachments-data">
                    @php
    $applicationId = null; 
    $price='0';
@endphp
                    @forelse ($applyScholarships as $item)
                        @php
        $applicationId = $item->id; 
         $price =$item->application_fee;
    @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-success"> {{ strtoupper($item->application_id) }}</span></td>
                            <td>
                                @if ($item->status == 'pending')
                                    <span class="badge bg-warning"> {{ strtoupper($item->status) }}</span>
                                @elseif($item->status == 'approved')
                                    <span class="badge bg-primary text-white"> {{ strtoupper($item->status) }}</span>
                                @elseif($item->status == 'rejected')
                                    <span class="badge bg-danger"> {{ strtoupper($item->status) }}</span>
                                @else
                                    <span class="badge bg-danger">No status application</span>
                                @endif
                            </td>
                            <td>$ {{ $item->application_fee }}</td>
                            <td>{{ strtoupper($item->payment_status) }}</td>
                            <td>{{ $item->created_at->format('F j, Y \a\t g:i A') }}</td>
                            <td><a href="{{ route('view-applyscholarship', ['id' => $item->id]) }}" class="btn btn-primary text-white"><i data-feather="eye"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-danger">No Information available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination" id="pagination">
                    {{ $applyScholarships->links() }}
                </ul>
            </nav>
            <select id="entries-per-page" class="w-20 form-select box mt-3 sm:mt-0">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="35">35</option>
                <option value="50">50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>

    <!-- Modals -->

    @foreach ($applyScholarships as $item)
        @if ($item->payment_status == 'unpaid')
            <div id="exampleModal-{{ $item->id }}"
                class="fixed inset-0 z-[200] hidden bg-gray-900 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-8 rounded-md w-96">
                    <div class="modal-header flex justify-between items-center">
                        <h5 class="text-xl font-bold text-danger">Payment Confirmation</h5>
                        <button type="button" class="text-2xl close-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="makePaymentForm-{{ $item->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            placeholder="Enter Full Name" value="{{ Auth::user()->name }}" readonly>

                                            <input type="hidden" id="applicationId" name="applicationId"  value="{{ strtoupper($applicationId) }}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            placeholder="example@example.com" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $student = App\Models\Students::where('user_id', auth()->user()->id)->first();
                                        $mobile = $student ? $student->mobile : 'Not Found';
                                    @endphp
                                    <div class="form-group">
                                        <label for="phone_number">Mobile Number</label>
                                        <input class="form-control" type="text" id="phone_number" name="phone_number"
                                            placeholder="e.g., +2557xxxxx" value="{{ $mobile }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Due Amount (USD)</label>
                                        <input class="form-control" type="number" id="amount" name="amount"
                                            placeholder="0.00" value="{{ $price}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="w-full py-3 px-6 rounded-md bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 transition duration-300 shadow">
    Pay Now
</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>



            @if ($item->status == 'approved')
                <div class="bg-green-50 border-l-8 border-green-800 text-green-800 p-6 rounded-md shadow-lg max-w-2xl mx-auto transition duration-300 transform hover:scale-105 hover:shadow-2xl hover:border-green-600" role="alert">
    <p class="text-xl font-semibold">
        Please pay your ${{ $price }} USD Scholarship fee after receiving your admission and scholarship documents. 
        <button type="button" id="payNowLink" data-target="#exampleModal-{{ $item->id }}" class="ml-3 inline-block px-4 py-2 bg-green-800 text-white font-bold rounded-md transition-colors duration-300 hover:bg-green-700">
            Click here to Pay
        </button>
    </p>
</div>




            @elseif($item->status == 'rejected')
                <p class="alert alert-danger text-white" role="alert" data-toggle="modal">
                    Your Application has been REJECT!!!! Please Contact the IMS admission office  for Assistance.
                </p>
            @endif
        @endif
    @endforeach
@endsection

@section('script')
    <!-- JavaScript libraries -->
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {

            $('#payNowLink').on('click', function(e) {
                e.preventDefault(); // Prevent default anchor action
                var targetModal = $(this).data('target');
                $(targetModal).removeClass('hidden'); // Show the modal
            });

            // Close modal when the close button is clicked
            $('.close-modal').on('click', function() {
                $(this).closest('.fixed').addClass('hidden'); // Hide the modal
            });

            // Optional: Close modal when clicking outside of the modal content
            $(document).on('click', function(e) {
                if ($(e.target).hasClass('fixed')) {
                    $(e.target).addClass('hidden'); // Close modal
                }
            });

            $('form[id^="makePaymentForm"]').submit(function(e) {
                e.preventDefault();

                let formId = $(this).attr('id');
                let modalId = formId.replace('makePaymentForm-', '#exampleModal-');
                let name = $(`${modalId} #name`).val();
                let email = $(`${modalId} #email`).val();
                let phone_number = $(`${modalId} #phone_number`).val();
                let amount = $(`${modalId} #amount`).val();
                  let applicationId = $(`${modalId} #applicationId`).val();

                

                // Make payment
                makePayment(amount, email, phone_number, name,applicationId);
            });

            // function makePayment(amount, email, phone_number, name) {
            //     FlutterwaveCheckout({
            //         public_key: "FLWPUBK_TEST-9a2bd509c7c6f4ec0e3188b5eeaf039b-X",
            //         tx_ref: "txref-DI0NzMx13",
            //         amount: 1,
            //         currency: "USD",
            //         payment_options: "card, banktransfer, ussd",
            //         meta: {
            //             source: "docs-inline-test",
            //             consumer_mac: "92a3-912ba-1192a"
            //         },
            //         customer: {
            //             email: email,
            //             phone_number: phone_number,
            //             name: name
            //         },
            //         customizations: {
            //             title: "IMS Scholarships",
            //             description: "Test Payment",
            //             logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png"
            //         },
            //         callback: function(data) {
            //             console.log("Payment callback:", data);
            //             // Handle payment callback response here (e.g., show success message)
            //         },
            //         onclose: function() {
            //             console.log("Payment cancelled!");
            //         }
            //     });
            // }



        });



async function makePayment(amount, email, phone_number, name, applicationId) {
    try {
        const response = await fetch('/dashboard/api/flutterwave-keys');
        const keys = await response.json();

        if (!keys.public_key) {
            console.error("Flutterwave public key not found.");
            return;
        }

        FlutterwaveCheckout({
            public_key: keys.public_key,
            tx_ref: "txref-" + new Date().getTime(),
            amount: amount,
            currency: "USD",
            payment_options: "card, banktransfer, ussd",
            redirect_url: `https://apply.imsscholarships.com/dashboard/handle-flutterwave-payment?applicationId=${applicationId}`,
            customer: {
                email: email,
                phone_number: phone_number,
                name: name,
            },
            customizations: {
                title: "IMS Scholarships",
                description: "Scholarship Application Payment",
                logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png",
            },
            onclose: function () {
                console.log("Payment window closed.");
            },
        });
    } catch (error) {
        console.error("Error making payment:", error);
    }
}




//          async function makePayment(amount, email, phone_number, name,applicationId) {
//     try {
        
//         const response = await fetch('/dashboard/api/flutterwave-keys');
//         const keys = await response.json();

//         if (!keys.public_key) {
//             console.error("Flutterwave public key not found.");
//             return;
//         }

     
//         FlutterwaveCheckout({
//             public_key: keys.public_key, 
//             tx_ref: "txref-" + new Date().getTime(),
//             amount: 1,
//             currency: "USD",
//             payment_options: "card, banktransfer, ussd",
//             redirect_url: 'https://apply.imsscholarships.com/dashboard/handle-flutterwave-payment',
//         //     meta: {
//         //     consumer_id: 23,
//         //     consumer_mac: '92a3-912ba-1192a',
//         // },
//             customer: {
//                 email: email,
//                 phone_number: phone_number,
//                 name: name
//             },
//             customizations: {
//                 title: "IMS Scholarships",
//                 description: "Test Payment",
//                 logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png"
//             },
//             callback: async function(data) {
//                 console.log("Payment callback:", data);

//                 if (data.status === "successful") {
//                     // Send transaction details to the backend
//                      console.log('yes');
//                     const saveResponse = await fetch('/dashboard/api/save-transaction', {

//                         method: 'POST',
//                         headers: {
//                             'Content-Type': 'application/json',
//                             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                         },
//                         body: JSON.stringify({
//                             transaction_id: data.transaction_id,
//                             tx_ref: data.tx_ref,
//                             amount: data.amount,
//                             currency: data.currency,
//                             customer: data.customer,
//                             applicationId : applicationId
//                         }),
//                     });

//                     const saveResult = await saveResponse.json();
//                     if (saveResult.success) {
//                         alert("Payment successful and transaction saved!");
//                     } else {
//                         alert("Payment successful, but failed to save transaction.");
//                     }
//                 } else {
//                     alert("Payment failed!");
//                 }
//             },
//             onclose: function() {
//                 console.log("Payment cancelled!");
//             }
//         });
//     } catch (error) {
//         console.error("Error making payment:", error);
//     }
// }

    </script>
@endsection
