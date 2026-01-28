<!DOCTYPE html>
<html>
<head>
<title>Appointment Approve</title>
<link href="https://fonts.googleapis.com/css2?family=Lato&family=Oswald:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Thank You for Choosing Us</h2>
    <p>Dear {{$fname??''}} {{$lname??''}},</p>
    <p>Your Appointment has been approved and here is your details:</p>
    <table >
        <tr>
            <th><strong>First Name: </strong></th>
            <td>{{$fname??''}}</td>
        </tr>
        <tr>
            <th><strong>Last Name: </strong></th>
            <td>{{$lname??''}}</td>
        </tr>
        <tr>
            <th><strong>Phone: </strong></th>
            <td>{{$country??''}} {{$phone??''}}</td>
        </tr>
        <tr>
            <th><strong>Email: </strong></th>
            <td>{{$email??''}}</td>
        </tr>
        @if(isset($v_name) || (isset($service_name)))
        <tr>
            <th><strong>Service Name: </strong></th>
            <td>{{$v_name??''}}{{$service_name??''}}</td>
        </tr>
        @endif
        @if(isset($date))
        <tr>
            <th><strong>Preferred Date: </strong></th>
            <td>{{$date??''}}</td>
        </tr>
        @endif
        @if(isset($time))
        <tr>
            <th><strong>Preferred Time: </strong></th>
            <td>{{$time??''}}</td>
        </tr>
        @endif
        @if(isset($msg))
        <tr>
            <th><strong>Message: </strong></th>
            <td>{{$msg??''}}</td>
        </tr>
        @endif
    </table>
    <table>
        <tfoot>
                <tr>
                    <td style="text-align: center;background-color: #f1f1f1;padding:15px;font-family: 'Lato', sans-serif;"><p>
                        <b>Reach us at</b><br> info@skincanberra.com </p>
                        <ul style="display:inline-block;list-style:none;text-align: center; margin: 0px; padding: 0px;"></ul>
                    </td>
                </tr>
        </tfoot>
    </table>
   
</body>
</html>