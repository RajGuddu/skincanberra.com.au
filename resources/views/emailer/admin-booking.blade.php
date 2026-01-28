<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Booking Request Received</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f9f9f9; padding: 30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; border: 1px solid #e0e0e0;">
          <tr>
            <td style="background-color: #fff; padding: 20px; text-align: center;">
              <img src="{{ url('assets/frontend/images/skin-canberra.svg') }}" alt="Skin Canberra" width="160">
            </td>
          </tr>
          <tr>
            <td style="padding: 30px;">
              <h2 style="color: #333333; margin-top: 0;">New Booking Request Received – {{ $client_name }}</h2>
              <p style="color: #555555; font-size: 15px;">Hello Admin,</p>
              <p style="color: #555555; font-size: 15px;">A new booking request has been submitted on the website:</p>

              <table cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 15px;">
                <tr>
                  <td style="border: 1px solid #ddd;">Client Name</td>
                  <td style="border: 1px solid #ddd;">{{ $client_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Email</td>
                  <td style="border: 1px solid #ddd;">{{ $client_email }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Phone</td>
                  <td style="border: 1px solid #ddd;">{{ $client_phone }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Service</td>
                  <td style="border: 1px solid #ddd;">{{ $service_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Preferred Date & Time</td>
                  <td style="border: 1px solid #ddd;">{{ $date_time }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Total Amount</td>
                  <td style="border: 1px solid #ddd;">${{ $total_amount }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Paid Amount</td>
                  <td style="border: 1px solid #ddd;">${{ $paid_amount }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Dues Amount</td>
                  <td style="border: 1px solid #ddd;">${{ $dues_amount }}</td>
                </tr>
                
              </table>

              <p style="color: #555555; font-size: 14px; margin-top: 20px;">Please log in to the admin dashboard to approve or decline this booking.</p>
              <p style="color: #555555; font-size: 14px; margin-top: 20px;">Thanks,</p>
            </td>
          </tr>
          <tr>
            <td style="background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #777;">
              Skin Canberra Website Notification
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
