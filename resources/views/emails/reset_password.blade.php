<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('traduction.reset_password.title') }}</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4; text-align:{{ $locale === 'ar' ? 'right' : 'left' }};">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px 0;">
<tr>
    <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">

            <!-- Entête -->
            <tr>
                <td align="center" style="background-color:#007BFF; padding:20px;">
                    <img src="https://gestetab.djugu.bj/assets/images/logos.png" alt="Logo" style="max-width:150px; display:block;">
                </td>
            </tr>

            <!-- Corps -->
            <tr>
                <td style="padding:30px; color:#333;">
                    <h2>{{ __('traduction.reset_password.greeting', ['name' => $user->name ?? '']) }}</h2>
                    <p style="font-size:16px; color:#555; line-height:1.5;">
                        {{ __('traduction.reset_password.message') }}
                    </p>
                    <a href="{{ $url }}"
                       style="display:inline-block; margin:20px 0; padding:12px 25px; background-color:#007BFF; color:#ffffff; text-decoration:none; font-weight:bold; border-radius:5px;">
                       {{ __('traduction.reset_password.button') }}
                    </a>
                    <p style="font-size:14px; color:#999; line-height:1.5;">
                        {{ __('traduction.reset_password.notice') }}
                    </p>
                </td>
            </tr>

            <!-- Pied de page -->
            <tr>
                <td style="background-color:#f7f7f7; text-align:center; padding:15px; font-size:12px; color:#999;">
                {{ __('traduction.reset_password.gestetab') }} {{ __('traduction.reset_password.rights') }}  &copy; Copyright GESTAETAB 2020-{{ date('Y') }}
                </td>
            </tr>

        </table>
    </td>
</tr>
</table>

</body>
</html>
