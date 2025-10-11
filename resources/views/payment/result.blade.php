<!DOCTYPE html>
<html>

    <head>
        <title>Payment Result</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: sans-serif;
                text-align: center;
                padding: 2em;
                background-color: #f8fafc;
            }

            .result {
                background: #fff;
                padding: 2em;
                border-radius: 10px;
                display: inline-block;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .success {
                color: green;
            }

            .failed {
                color: red;
            }
        </style>
    </head>

    <body>
        <div class="result">
            @if ($payment['status'] === 'open')
                <h2 class="success">✅ Payment Successful!</h2>
                <p>Thank you for your payment.</p>
            @else
                <h2 class="failed">❌ Payment Failed</h2>
                <p>There was an issue processing your payment. Please try again.</p>
            @endif
            <p>Payment ID: {{ $payment['id'] }}</p>
            <p>Amount: {{ $payment['amount']['value'] }}</p>
            <p>Currency: {{ $payment['amount']['currency'] }}</p>
            <p>Payment Method: {{ $payment['method'] }}</p>
            <p>status: {{ $payment['status'] }}</p>
            <p>organization ID: {{ $payment['organizationId'] }}</p>
            <p>sequence Type: {{ $payment['sequenceType'] }}</p>
        </div>
    </body>
</html>
