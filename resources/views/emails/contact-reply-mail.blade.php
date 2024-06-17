<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- SITE TITLE -->
    <title>Contact | Pocket Studio</title>
    <style>
        body{
            font-family: 'Times New Roman', sans-serif;
            font-size: 14px;
        }
        h4,h6{
            font-size: 14px;
            font-weight: 100;
            font-family: 'Times New Roman','Segoe UI' !important;
        }
    </style>
</head>

<body style="background:#ededed61;">
<div style="background: #67b67d;padding: 8px;text-align: center;margin: 0 0 40px 0;">
    <img src="https://pocketstudionepal.com/mail-images/company.png" style="width: 150px;">
</div>
<div style="padding: 40px;letter-spacing: 0.2px;">
    @if($content) {!! $content !!} @endif
</div>
<div style="color: #000;background: #67b67d;margin-top: 2%;padding: 20px;">
    <img src="https://pocketstudionepal.com/mail-images/company.png" style="width: 130px;">
    <h4 style="color: #000;">
        {{$site_data->address}}<br>
        <a href="mailto:{{$site_data->email}}" style="color:#000;">{{$site_data->email}}</a>
        <br>
        @if($site_data->mobile_no){{$site_data->mobile_no}}<br>@endif
        @if($site_data->mobile_no_2){{$site_data->mobile_no_2}}<br>@endif
        <a href="https://pocketstudionepal.com/" style="color:#000;"  target="_blank">https://pocketstudionepal.com/</a> </h4>
    <div style="display: -webkit-inline-box;">
        @if($site_data->facebook)
            <a href="{{$site_data->facebook}}" target="_blank" style="padding: 0 2px;">
                <img src="https://pocketstudionepal.com/mail-images/fv.png" style="width: 21px;">
            </a>
        @endif
        @if($site_data->instagram)
            <a href="{{$site_data->instagram}}" target="_blank" style="padding: 0 2px;">
                <img src="https://pocketstudionepal.com/mail-images/insta.png" style="width: 21px;">
            </a>
        @endif
    </div>
</div>
</body>
</html>