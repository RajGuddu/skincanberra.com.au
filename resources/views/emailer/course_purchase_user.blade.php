<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Course Purchased</title>
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
              <h2 style="color: #333333; margin-top: 0;">Course Purchased – Skin Canberra</h2>
              <p style="color: #555555; font-size: 15px;">Hi {{ $client_name }},</p>
              <p style="color: #555555; font-size: 15px;">Thank you for purchasing the {{ $course_name }} course!<br>Your payment has been successfully received, and your course is now active in your account.</p>

              <table cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse; margin-top: 15px;">
                <tr>
                  <td style="border: 1px solid #ddd;">Course Name</td>
                  <td style="border: 1px solid #ddd;">{{ $course_name }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Price</td>
                  <td style="border: 1px solid #ddd;">${{ $course_price }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #ddd;">Purchase Date</td>
                  <td style="border: 1px solid #ddd;">{{ $purchase_date }}</td>
                </tr>
              </table>

              <p style="color: #555555; font-size: 15px; margin-top: 20px;">You can start learning anytime:</p>
              <p style="color: #555555; font-size: 15px;">If you have any questions or need help, feel free to message us anytime.</p>
              <p style="color: #555555; font-size: 15px;">Thank you for shopping with us!</p>

              <!-- <div style="margin-top: 25px; text-align: center;">
                <a href="{{ url('/') }}" style="background-color: #006d6f; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block;">Visit Website</a>
              </div> -->
            </td>
          </tr>
          <tr>
            <td style="background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #777;">
              Team Skin Canberra. 
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
