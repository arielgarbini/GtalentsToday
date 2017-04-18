<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>gTalents Emails</title>
    <meta name="author" content="@01Comandos">
    <!-- FIN DE METADATOS -->

    <!-- CSS -->
    <style type="text/css">
        table[class="responsive-table"]{
            background: #fff;
            margin: 60px 0;
        }

        img[class="responsive-logo"]{
            margin: 10px 0 0 20px;
        }

        body{
            font-family: arial, helvetica, Open Sans, Helvetica LT Std,sans-serif;
            margin: 0;
        }

        a{
            text-decoration: none;
        }

        @media screen and (max-width: 600px){
            img[class="responsive-logo"]{
                width: 23% !important;
            }

            img[class="responsive-img"]{
                width: 100% !important;
            }

            table[class="responsive-table"]{
                width: 100% !important;
            }

            p[class="parrafo"]{
                font-size: 12px !important;
            }

            a[class="cta"]{
                width: 50% !important;
            }

            td[class="td-responsive"]{
                padding: 0 20px !important;
            }
        }

    </style>
</head>
<body>
<!--CONTENEDOR PADRE-->
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="background: #EEF2F3">
    <tr>
        <td align="center">
            <!--TABLA DE 600PX-->
            <table width="600px" cellspacing="0" cellpadding="0" border="0" class="responsive-table" style="border-radius: 6px;">
                <!--LOGOTIPO-->
                <tr>
                    <td style="padding: 28px 0 0 0; text-align: center;">
                        <a href="http://www.globaltalentshift.com/" target="_blank">
                            <img src="{{URL::to('/assets/img/logotipo.png')}}" alt="gTalents logotipo" class="responsive-logo" width="120px">
                        </a>
                    </td>
                </tr>

                <!--TITULO-->
                <tr>
                    <td align="center" class="td-responsive" style="padding: 0 35px;">
                        <h2 style="font-family:Lato, helvetica,arial; font-size:20px; color : #3A6097; margin: 25px 0 0 0">
                            @lang('app.You_have_been_registered_contributor') {{ settings('app_name') }}
                        </h2>
                    </td>
                </tr>

                <!--PARRAFO-->
                <tr>
                    <td class="td-responsive" style="padding: 0 80px;">
                        <p class="parrafo" style="font-size:16px;  line-height:20px; color:#22203B;">
                        <p>@lang('app.confirm_email_on_link_below')</p>

                        <a href="{{ route('register.confirm-data.collaborator', $token) }}">@lang('app.confirm_email')</a> <br/><br/>

                        <p>@lang('app.if_you_cant_click')</p>

                        <p>{{ route('register.confirm-data.collaborator', $token) }}</p>

                        @lang('app.many_thanks'), <br/>
                        {{ settings('app_name') }}

                        </p>
                    </td>
                </tr>

                <!--CALL TO ACTION-->
                <tr>
                    <td align="center" style="border-bottom: 1px solid #F2F2F2; padding: 15px 0px 35px 0px;">
                        <a href="{{ route('register.confirm-data.collaborator', $token) }}" target="_blank" style="color:#ffffff;background:#73BF9B;padding:10px 12px;text-align:center;border-radius:5px;display:block;text-decoration:none;width:30%; font-size:14px;" class="cta">
                            @lang('app.confirm_invitation')
                        </a>
                    </td>
                </tr>

                <!--REDES SOCIALES-->
                <!--
                <tr>
                    <td align="center">
                        <div class="container-social" style="padding: 25px 0 15px 0">
                            <a href="#!" target="_blank">
                                <img src="img/linkedin.png" alt="" style="width: 22px">
                            </a>

                            <a href="#!" target="_blank">
                                <img src="img/facebook.png" alt="" style="width: 22px">
                            </a>
                            <a href="#!" target="_blank">
                                <img src="img/twitter.png" alt="" style="width: 22px">
                            </a>
                        </div>
                    </td>
                </tr>-->

                <!--WEBSITE-->
                <tr>
                    <td align="center">
                        <a href="{{URL::to('/')}}" target="_blank" style="color:#73BF9B;   font-weight:bold; text-align:center; text-decoration:none;font-size:13px;" class="website">
                            www.globaltalentshift.com
                        </a>
                    </td>
                </tr>

                <!--FIRMA-->
                <tr>
                    <td align="center" style="padding: 0 20px 15px 20px">
                        <p class="parrafo" style="font-size:11px; line-height:20px; color:#808080; margin: 0">
                            © {{ settings('app_name') }}
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>