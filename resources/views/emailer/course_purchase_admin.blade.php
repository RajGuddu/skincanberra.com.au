<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Course Purchased</title>
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
              <h2 style="color: #333333; margin-top: 0;">New Course Purchased – {{ $client_name }}</h2>
              <p style="color: #555555; font-size: 15px;">Hello Admin,</p>
              <p style="color: #555555; font-size: 15px;">A new course has been purchased by a user. Please check the details below:</p>
              <p style="color: #555555; font-size: 15px;"><strong>Purchase Details:</strong></p>

              <table cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 15px;">
               
                <tr>
                  <td style="border: 1px solid #ddd;">Customer Name</td>
                  <td style="border: 1px solid #ddd;">{{ $client_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Course Name</td>
                  <td style="border: 1px solid #ddd;">{{ $course_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Amount Paid</td>
                  <td style="border: 1px solid #ddd;">${{ $course_price }}</td>
                </tr>
                
                <tr>
                  <td style="border: 1px solid #ddd;">Purchase Date</td>
                  <td style="border: 1px solid #ddd;">{{ $purchase_date }}</td>
                </tr>
                
              </table>

              <p style="color: #555555; font-size: 14px; margin-top: 20px;">Please verify the payment if required and ensure the user has access to the course.</p>
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
