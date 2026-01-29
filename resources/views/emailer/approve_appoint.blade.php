<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Booking Approved</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f8f8; padding: 30px 0;">
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
              <h2 style="color: #333333; margin-top: 0;">Booking Approved</h2>
              <p style="color: #555555; font-size: 15px;">Hi {{ $client_name }},</p>
              <p style="color: #555555; font-size: 15px;">Good news! Your appointment has been <strong>approved</strong></p>

              <table cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 15px;">
                <tr>
                  <td style="border: 1px solid #ddd;">Service</td>
                  <td style="border: 1px solid #ddd;">{{ $service_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Date & Time:</td>
                  <td style="border: 1px solid #ddd;">{{ $selected_date }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Location</td>
                  <td style="border: 1px solid #ddd;">Skin Canberra</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Total Amount</td>
                  <td style="border: 1px solid #ddd;">${{ $total_price }}</td>
                </tr>
                
              </table>

              <!-- <p style="color: #555555; font-size: 15px; margin-top: 20px;">We look forward to seeing you soon!</p> -->
              <div style="margin-top: 25px; text-align: center;">
                <p style="color: #555555; font-size: 15px;">Please complete your payment using the link below:</p>
                <a href="{{ STRIPE_PAY_LINK }}" 
                          style="background-color: #006d6f; 
                          color: #ffffff; 
                          text-decoration: none; 
                          padding: 12px 24px; 
                          border-radius: 5px; 
                          display: inline-block;
                          font-size: 15px;">
                          Pay Now
                </a>
              </div>
              <p style="color: #555555; font-size: 15px;">If you need to reschedule, simply reply to this email.</p>
              <p style="color: #555555; font-size: 15px;">Warm regards,</p>

              <!-- <div style="margin-top: 25px; text-align: center;">
                <a href="{{ url('/') }}" style="background-color: #006d6f; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;">Visit Website</a>
              </div> -->
            </td>
          </tr>
          <tr>
            <td style="background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #777;">
              Team Skin Canberra
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
