<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <style>
        .student_section{
            height: 500px;
            margin-bottom: 10px;
        }
        .office_section{
            margin-top: 50px;
        }
        .header_container{
            width: 100%;
            text-align: center;
        }
        .logo{
            margin: 0;
        }
        .InstituteName{
            margin: 0;
            line-height: 1.0;
            font-size: 24px;
            font-weight: bold;
        }
        .basic_info{
            width: 100%;
            font-size: 15px;
            font-weight: bold;
        }
        .basic_info_text {
            width: 50%;
        }
        .date{
            text-align: right;
        }
        .pi{
            border-collapse: collapse;
        }
        .pi td, th {

            padding: 10px 5px;
            min-width: 175px;
            background: white;
            box-sizing: border-box;
            text-align: left;
        }
        .admission{
            text-align: center;
            font-size: 18px;
        }
        .guardianSignature{
            float: left;
            margin-top: 30px;
        }
        .signature{
            float: right;
            margin-top: 30px;
        }
        .guardian{
            border-top: 1px solid #000;
            float: left;
        }
        .value{
            border-bottom: 2px dotted;

        }
        .divider{
            border-top: 2px dotted #0a0a0a;
        }
    </style>
</head>
<body>
<div class="student_section">
    <div class="header_container ">
        <div class="logo">
            <img src="{{ url($systemSetting['logo']) }}" class="logo" alt="logo" style="width:70px;height:70px;">
        </div>
        <p class="InstituteName">{{$systemSetting['siteName']}}</p>
        <small>{{ $systemSetting['address'] }}</small>
    </div>

    <div>
        <h4 class="admission">Money Receipt (student copy)</h4>
    </div>

    <table class="basic_info">
        <tr>
            <td class="basic_info_text">
                <span >Sl No: #{{ str_pad( $payment->id, 5, '0', STR_PAD_LEFT) }}</span>
            </td>
            <td class="basic_info_text date">
                <span>Date: {{$payment->created_at->format("d-m-Y")}}</span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
                <span class="basic_info">Id:</span>
                <span class="value">{{$payment->invoice->user->username ?? "" }} </span>
            </td>
            <td >
                <span class="basic_info">Student name:</span>
                <span class="value">
                    {{$payment->invoice->user->details->first_name . " " .$payment->invoice->user->details->last_name }}
                </span>

            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
                <span class="basic_info">Class:</span>
                <span class="value"> {{$payment->invoice->user->group->name}} </span>
            </td>
            <td class="basic_info">
                <span >
                    {{$payment->invoice->feeType->name}}
                </span>
            </td>
            <td >
                <span class="basic_info">Amount:</span>
                <span class="value">Tk {{$payment->amount}}</span>
            </td>
        </tr>
    </table>
    <div class="pi">
        <div class="guardianSignature">
            <p class="guardian basic_info">
                Guardian signature
            </p>
            <p class="author"></p>
        </div>
    </div>

    <div class="signature">
        <p class="guardian basic_info">
            Recipient signature
        </p>
        <p class="author"></p>
    </div>
</div>
<div class="divider"></div>
<div class="office_section">
    <div class="header_container ">
        <div class="logo">
            <img src="{{ url($systemSetting['logo']) }}" class="logo" alt="logo" style="width:70px;height:70px;">
        </div>
        <p class="InstituteName">{{$systemSetting['siteName']}}</p>
        <small>{{ $systemSetting['address'] }}</small>
    </div>

    <div>
        <h4 class="admission">Money Receipt (office copy)</h4>
    </div>

    <table class="basic_info">
        <tr>
            <td class="basic_info_text">
                <span >Sl No: #{{ str_pad( $payment->id, 5, '0', STR_PAD_LEFT) }}</span>
            </td>
            <td class="basic_info_text date">
                <span>Date: {{$payment->created_at->format("d-m-Y")}}</span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
                <span class="basic_info">Id:</span>
                <span class="value">{{$payment->invoice->user->username ?? "" }} </span>
            </td>
            <td >
                <span class="basic_info">Student name:</span>
                <span class="value">
                    {{$payment->invoice->user->details->first_name . " " .$payment->invoice->user->details->last_name }}
                </span>
            </td>
        </tr>
    </table>

    <table class="pi">
        <tr >
            <td >
                <span class="basic_info">Class:</span>
                <span class="value"> {{$payment->invoice->user->group->name}} </span>

            </td>
            <td class="basic_info">
                <span >
                    {{$payment->invoice->feeType->name}}
                </span>
            </td>
            <td >
                <span class="basic_info">Amount:</span>
                <span class="value">Tk{{$payment->amount}}</span>
            </td>
        </tr>
    </table>
    <div class="pi">
        <div class="guardianSignature">
            <p class="guardian basic_info">
                Guardian signature
            </p>
            <p class="author"></p>
        </div>
    </div>

    <div class="signature">
        <p class="guardian basic_info">
            Recipient signature
        </p>
        <p class="author"></p>
    </div>
</div>


</body>
</html>
