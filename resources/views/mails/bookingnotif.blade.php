<html>
    <head>
        <style>
            * {
                font-family: 'Arial', sans-serif;
            }
            td {
                border: 1px solid #000;
                padding: 1rem;
            }
        </style>
    </head>
    <body>
        <h3>Hey there,</h3>
        <p>Someone has book a reservation on your site! See details below</p>
        <table style="border-collapse: collapse; border: 1px solid #000;">
            <tr>
                <td>Full Name</td>
                <td>{{ $data->fullname }}</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <td>Contact number</td>
                <td><a href="tel:{{ $data->contact }}">{{ $data->contact }}</a></td>
            </tr>
            <tr>
                <td>Local Guests</td>
                <td>{{ $data->local_guests }}</td>
            </tr>
            <tr>
                <td>Foreign Guests</td>
                <td>{{ $data->foreign_guests }}</td>
            </tr>
            <tr>
                <td>Event Date</td>
                <td>{{ $data->event_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td>Pick Up Info</td>
                <td>{{ $data->pick_up_info }}</td>
            </tr>
            <tr>
                <td>Special Request</td>
                <td>{{ $data->special_requests }}</td>
            </tr>
            <tr>
                <td>Pax/Rate (Price per person)</td>
                <td>{{ $data->product->item }} (&#8369;{{ $data->product->rate }})</td>
            </tr>
            <tr>
                <td>Booking ID</td>
                <td>{{ str_pad($data->id, 6, "0", STR_PAD_LEFT); }}</td>
            </tr>
            <tr>
                <td>Booking Time</td>
                <td>{{ $data->created_at->format('F j, Y, g:i A') }}</td>
            </tr>
        </table>
        <br><br>
        <p>DISCLAIMER: This is a temporary email sent to you by jjamtravelcebu.com. Your admin panel is still work in progress. Please keep in touch.</p>
    </body>
</html>
