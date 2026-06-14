<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<title>{{ $subject ?? config('app.name') }}</title>

</head>

<body style="
margin:0;
padding:0;
background:#f3f6fb;
font-family:Arial,Helvetica,sans-serif;
">

<table
    width="100%"
    cellpadding="0"
    cellspacing="0"
    border="0"
    style="
    background:#f3f6fb;
    padding:40px 20px;
">

    <tr>

        <td align="center">

            <table
                width="650"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                background:#ffffff;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 10px 30px rgba(0,0,0,.08);
            ">

                <!-- Header -->

                <tr>

                    <td
                        style="
                        background:linear-gradient(135deg,#6259ca,#7c71ff);
                        padding:40px 30px;
                        text-align:center;
                    ">

                        <div
                            style="
                            width:70px;
                            height:70px;
                            line-height:70px;
                            margin:0 auto 20px;
                            background:rgba(255,255,255,.15);
                            border-radius:18px;
                            font-size:34px;
                            text-align:center;
                        ">
                            🎓
                        </div>

                        <h1
                            style="
                            margin:0;
                            color:#ffffff;
                            font-size:30px;
                            font-weight:700;
                        ">
                            eSchoolKart
                        </h1>

                        <p
                            style="
                            margin-top:10px;
                            margin-bottom:0;
                            color:rgba(255,255,255,.85);
                            font-size:14px;
                        ">
                            School Uniform ERP Platform
                        </p>

                    </td>

                </tr>

                <!-- Content -->

                <tr>

                    <td
                        style="
                        padding:45px;
                        color:#374151;
                        font-size:15px;
                        line-height:1.9;
                    ">

                        {!! $content !!}

                    </td>

                </tr>

                <!-- Support Box -->

                <tr>

                    <td
                        style="
                        padding:0 45px 35px;
                    ">

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                            background:#f8fafc;
                            border:1px solid #e5e7eb;
                            border-radius:12px;
                        ">

                            <tr>

                                <td
                                    style="
                                    padding:20px;
                                    color:#64748b;
                                    font-size:13px;
                                    line-height:1.7;
                                ">

                                    <strong
                                        style="
                                        color:#111827;
                                    ">
                                        Need Help?
                                    </strong>

                                    <br>

                                    If you have any questions regarding your account,
                                    please contact the eSchoolKart support team.

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

                <!-- Divider -->

                <tr>

                    <td
                        style="
                        padding:0 45px;
                    ">

                        <hr
                            style="
                            border:none;
                            border-top:1px solid #e5e7eb;
                        ">

                    </td>

                </tr>

                <!-- Footer -->

                <tr>

                    <td
                        style="
                        padding:30px;
                        text-align:center;
                        background:#fafbff;
                    ">

                        <p
                            style="
                            margin:0;
                            color:#64748b;
                            font-size:13px;
                        ">
                            © {{ date('Y') }} eSchoolKart.
                            All Rights Reserved.
                        </p>

                        <p
                            style="
                            margin-top:8px;
                            margin-bottom:0;
                            color:#94a3b8;
                            font-size:12px;
                        ">
                            School Uniform Management Platform
                        </p>

                    </td>

                </tr>

            </table>

        </td>

    </tr>

</table>

</body>

</html>
