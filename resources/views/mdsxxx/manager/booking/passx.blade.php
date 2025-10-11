<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        .invoice-box table tr td h4 {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        /* body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			} */

        body h1 {
            font-size: 16;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 30px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        @media print {
            .invoice-box {
                max-width: unset;
                box-shadow: none;
                border: 0px;
            }
        }
    </style>
</head>

<body>
    <!-- <h1>A simple, clean, and responsive HTML invoice template</h1>
    <h3>Because sometimes, all you need is something simple.</h3>
    Find the code on <a href="https://github.com/sparksuite/simple-html-invoice-template">GitHub</a>. Licensed under the
    <a href="http://opensource.org/licenses/MIT" target="_blank">MIT license</a>.<br /><br /><br /> -->

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ public_path('assets/img/gallery/afc-asian-cup-qatar-2023.jpg')}}" alt="Company logo" style="width: 100%; max-width: 100px" />
                            </td>
                            <td class="title">
                                <!-- <p class="mb-0 ms-3 text-900 zoom"> {{$qr_code}}</p> -->
                                <img src="data:image/png;base64, {{ $qr_code }}">
                                <!-- <img src="{{ public_path('assets/img/gallery/Qrcode_wikipedia.jpg')}}" alt="Company logo" style="width: 100%; max-width: 100px" /> -->
                            </td>

                            <!-- <td>
                                Invoice #: 123<br />
                                Created: January 1, 2023<br />
                                Due: February 1, 2023
                            </td> -->
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h4 class="centertext">Master Delivery Schedule (MDS)<br>Booking Ref: <b>MDSNOV1234567</b></h4>
                </td>
            </tr>
            <!-- <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br />
                                12345 Sunny Road<br />
                                Sunnyville, TX 12345
                            </td>

                            <td>
                                Acme Corp.<br />
                                John Doe<br />
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> -->

            <tr class="heading">
                <td colspan="2">Receipient company: {{$receipeint_company}}</td>

                <!-- <td>Check #</td> -->
            </tr>

            <tr class="item">
                <td>Booking Date:</td>
                <td>{{format_date($booking->booking_date)}}</td>
            </tr>
            <!-- <tr class="item">
                <td>RSP Arrival time (if required):</td>
                <td>1000</td>
            </tr> -->
            <tr class="item">
                <td>RSP:</td>
                <td>{{$booking->schedule->rsp->title}}</td>
            </tr>
            <tr class="item">
                <td>Site Arrival Time:</td>
                <td>{{time_range_segment($booking->schedule?->rsp_booking_slot, 'from')}}</td>
            </tr>
            <tr class="item">
                <td>Site Name:</td>
                <td>{{$booking->schedule->venue->title}}</td>
            </tr>

            <tr class="heading">
                <td colspan="2">Driver/Vehicle Information</td>

                <!-- <td>Price</td> -->
            </tr>

            <tr class="item">
                <td>Driver Name:</td>
                <td>{{$booking->driver->first_name}} {{$booking->driver->last_name}}</td>
            </tr>
            <tr class="item">
                <td>Vehicle License Plate:</td>
                <td>{{$booking->vehicle->license_plate}}</td>
            </tr>
            <tr class="item">
                <td>Delivery Vehicle Type:</td>
                <td>{{$booking->vehicle->vehicle_type->title}}</td>
            </tr>
            <tr class="item">
                <td>Driver QID/Passport No:</td>
                <td>{{$booking->driver->national_identifier_number}}</td>
            </tr>

            <tr class="heading">
                <td colspan="2">Additional Information</td>

                <!-- <td>Price</td> -->
            </tr>

            <tr class="item">
                <td>Reciever Name:</td>
                <td>{{$booking->receiver_name}}</td>
            </tr>
            <tr class="item">
                <td>Reciever Contact Number:</td>
                <td>{{$booking->receiver_contact_number}}</td>
            </tr>
            <tr class="item">
                <td>Delivery / Collection:</td>
                <td>{{$booking->delivery_type->title}}</td>
            </tr>
            <tr class="item">
                <td>Cargo Description:</td>
                <td>{{$booking->cargo->title}}</td>
            </tr>
            <tr class="item">
                <td>Loading / Unloading Zone:</td>
                <td>{{$booking->zone->title}}</td>
            </tr>

        </table>
    </div>
</body>

</html>
