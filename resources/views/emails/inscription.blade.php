<!doctype html>
<html lang="{{ app()->getLocale() }}" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-pc-theme="light">
<head>
    <meta charset="UTF-8">
    <title>{{ __('traduction.message_inscription.title') }}</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4; text-align:{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}};">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px 0;">
<tr>
    <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">

            <!-- Entête -->
            <tr>
                <td align="center" style="background-color:#748ba3; padding:20px;">
                    <img src="https://gestetab.djugu.bj/assets/images/logos.png" alt="Logo" style="max-width:150px; display:block;">
                    <h5>GESTAETAB</h5>
                </td>
            </tr>

            <!-- Corps -->
            <tr>
                <td style="padding:30px; color:#333;">
                    <h2>{{ __('traduction.message_inscription.greeting', ['name' => $user->name ?? '']) }} {{ __('traduction.message_inscription.greeting1') }}</h2>

                    <p style="font-size:16px; color:#555; line-height:1.5;">
                        {{ __('traduction.message_inscription.message') }}
                    </p>

                    <p style="font-size:16px; color:#555; line-height:1.5;">
                        {{ __('traduction.message_inscription.confirmer') }}
                    </p>
                        <a href="{{ route('confirmerCompte') }}"
                                style="display:inline-block;padding:10px 20px;background:#007bff;color:white;border-radius:5px;text-decoration:none;">
                                {{ __('traduction.message_inscription.button') }}
                        </a>
                    </p>
                    <p style="font-size:16px; color:#555; line-height:1.5;">
                        {{ __('traduction.message_inscription.copiez_code') }}
                    </p>
                    <p>{{ $confirmationCode }}</p>
                    <h5>
                        {{ __('traduction.message_inscription.notice') }}
                    </h5>
                    <p style="font-size:16px; color:#555; line-height:1.5;">
                        {{ __('traduction.message_inscription.Appel') }} <br>
                         {{ __('traduction.message_inscription.Whatsapp') }}<br>
                        {{ __('traduction.message_inscription.mail') }}<br>
                    </p>
                </td>
            </tr>

            <!-- Pied de page -->
            <tr>
                <td style="background-color:#f7f7f7; text-align:center; padding:15px; font-size:12px; color:#999;">
                {{ __('traduction.message_inscription.gestetab') }} {{ __('traduction.message_inscription.rights') }}  &copy; Copyright GESTAETAB 2020-{{ date('Y') }}
                </td>
            </tr>

        </table>
    </td>
</tr>
</table>

</body>
</html>
