<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Upcoming Bookings Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f8f8; padding: 30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; border: 1px solid #e0e0e0;">
          
          <!-- Header Logo -->
          <tr>
            <td style="background-color: #fff; padding: 20px; text-align: center;">
              <img src="{{ url('assets/frontend/images/skin-canberra.svg') }}" alt="Skin Canberra" width="160">
            </td>
          </tr>

          <!-- Main Content -->
          <tr>
            <td style="padding: 30px;">
              
              <h2 style="color: #333333; margin-top: 0;">Upcoming Bookings Reminder</h2>

              <p style="color: #555555; font-size: 15px;">Hello Admin,</p>

              <p style="color: #555555; font-size: 15px;">
                Here are all the bookings scheduled after <strong>2 days</strong>:
              </p>

              <!-- Booking Table -->
              <table cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 15px;">
                <tr style="background-color: #f1f1f1;">
                  <th style="border: 1px solid #ddd; text-align: left;">Client Name</th>
                  <th style="border: 1px solid #ddd; text-align: left;">Service</th>
                  <th style="border: 1px solid #ddd; text-align: left;">Date & Time</th>
                </tr>

                @foreach ($bookings as $item)
                <tr>
                  <td style="border: 1px solid #ddd;">{{ $item['client_name'] }}</td>
                  <td style="border: 1px solid #ddd;">{{ $item['service_name'] }}</td>
                  <td style="border: 1px solid #ddd;">{{ $item['selected_date'] }}</td>
                </tr>
                @endforeach

              </table>

              <p style="color: #555555; font-size: 15px; margin-top: 20px;">
                Please check your admin dashboard for more details.
              </p>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #777;">
              Skin Canberra System
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
