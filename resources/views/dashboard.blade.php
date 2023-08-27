@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection



@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($orders as $order)
                    <div id="div-{{ $order->id }}" class="card mt-5">
                        <div class="card-body">

                            <h6 class="card-subtitle mb-2 text-muted">Order ID {{ $order->id }}</h6>
                            {{ $order->created_at }}
                            </br>
                            <div class="row">

                                <div class="col-md-6">

                                    <p class="card-text">{{ $order->customer->name }}
                                        <br>{{ $order->customer->email }}
                                        <br>{{ $order->customer->address }}
                                        <br>{{ $order->customer->contact }}
                                    </p>

                                </div>
                            </div>
                            <h6 class="card-subtitle mt-3 mb-2 text-muted">Dishes</h6>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <?php $totalPrice = 0; ?>
                                    <!-- Initialize the total price variable outside the loop -->
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->dish->name }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->dish->price }}</td>
                                            <?php
                                            // Convert the price to float if it is in string format
                                            $price = $orderItem->dish->price;
                                            $itemTotalPrice = $price * $orderItem->quantity;
                                            $totalPrice += $itemTotalPrice;
                                            ?>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" style="text-align: left;"><strong>Total:</strong></td>
                                        <td><strong>{{ number_format($totalPrice, 2) }}</strong></td>
                                    </tr>
                                </table>

                            </div>
                            <button class="btn btn-primary text-end">Dispatch</button>

                            <button class="download-btn" data-target="div-{{ $order->id }}">Download PDF</button>
                            <button class="print-btn" data-target="div-{{ $order->id }}">Print</button>
                @endforeach


            </div>
        </div>
    </div>
    

    <script>
        // Function to refresh the page
        function refreshPage() {
            location.reload();
        }

        // Set the timeout to refresh after 2 minutes (120 seconds)
        setTimeout(refreshPage, 120000); // 120000 milliseconds = 2 minutes
    
        </script>
        <script>
            document.querySelectorAll('.download-btn').forEach(button => {
              button.addEventListener('click', () => {
                const targetDivId = button.dataset.target;
                alert(targetDivId)
                const contentToPrint = document.getElementById(targetDivId);
                // html2pdf().from(contentToPrint).save(`content_${targetDivId}.pdf`);
              });
            });
          
            document.querySelectorAll('.print-btn').forEach(button => {
              button.addEventListener('click', () => {
                const targetDivId = button.dataset.target;
                const contentToPrint = document.getElementById(targetDivId);
                html2pdf().from(contentToPrint).output('datauristring').then((pdfString) => {
                  const iframe = document.createElement('iframe');
                  iframe.style.display = 'none';
                  iframe.src = pdfString;
                  document.body.appendChild(iframe);
                  iframe.contentWindow.print();
                  document.body.removeChild(iframe);
                });
              });
            });
          </script>
          
@endsection
