<html>

<head>
    <style>
        .reftable {
            border-collapse: collapse;
            border: 1px solid #ddd;
            width: 100%;
        }
        .reftable td {
            padding: 10px;
            border: 1px solid #ddd;
            color:#455056;
            font-size: 15px;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
  <!--100% body table-->
  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'); font-family: 'Poppins', sans-serif;">
    <tr>
      <td>
        <table style="background-color: #ffffff;max-width:670px;margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td style="height:40px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align:center;">
                <img src="https://www.jjamtravelcebu.com/j-jam.jpg" alt="" style="width:100px">
             <h1 style="color:#282828; font-weight:600; margin:0;font-size:24px;font-family:'Rubik',sans-serif;">
                J-Jam BudgetBreeze Island Escape
            </h1>
            </td>
          </tr>
          <tr>
            <td style="height:20px;">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center;">
                <tr>
                  <td style="height:40px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="padding:0 35px;">
                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                        Thank you!
                    </h1>
                    <br><br>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                         We're excited to have you on board and can't wait to show you the beauty of the islands!
                    </p>
                    <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0; margin-top: 10px">
                        For your reference: <br><br>
                        {{-- Your booking ID is <span style="background-color: #f6ae5d;padding: .25rem .35rem;color: #fff;border-radius: 4px;font-weight: 600;">#{{ str_pad($data->id, 6, "0", STR_PAD_LEFT);  }}</span> --}}
                    </p>
                    <table class="reftable">
                        <tr>
                            <td>Booking ID</td>
                            <td>{{ str_pad($data->id, 6, "0", STR_PAD_LEFT); }}</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td>{{ $data->fullname }}</td>
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
                            <td>Booking Time</td>
                            <td>{{ $data->created_at->format('F j, Y, g:i A') }}</td>
                        </tr>
                    </table>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0; margin-top: 35px">
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="height:40px;">&nbsp;</td>
                </tr>
              </table>
            </td>
          <tr>
            <td style="height:20px; text-align:center;color:#c1c1c1;">
                <p><a href="tel:+639193811795" style="text-transform: uppercase; color:inherit; text-decoration:none;">Call us: +63 919 381 1795</a></p>
                <p><a href="https://www.jjamtravelcebu.com/" style="text-transform: uppercase; color:inherit; text-decoration:none;">jjamtravelcebu.com</a></p>
                <p>All Rights Reserved. &copy; 2024</p>
            </td>
          </tr>
          <tr>
          </tr>
          <tr>
            <td style="height:80px;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!--/100% body table-->
</body>

</html>
