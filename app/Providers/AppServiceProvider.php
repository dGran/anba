<?php

namespace App\Providers;

use App\Models\Season;
use App\Models\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $usersOnline = Session::whereNotNull('user_id')->distinct('user_id')->count('user_id');
        view()->share('usersOnline', $usersOnline);
        $visitorsOnline = Session::whereNull('user_id')->distinct('ip_address')->count('ip_address');
        view()->share('visitorsOnline', $visitorsOnline);
        $currentSeason = Season::where('current', 1)->first();
        view()->share('currentSeason', $currentSeason);

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificación de cuenta')
                ->line('Por favor, haga clic en el botón de abajo para verificar su dirección de correo electrónico y activar su cuenta de usuario.')
                ->action('Confirme su dirección de correo electrónico', $url)
                ->line('Si no creó una cuenta, puede omitir este mensaje.');
        });

        // ResetPassword::toMailUsing(function ($notifiable, $url) {
        //     $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        //     return (new MailMessage)
        //         ->subject('Restablecer contraseña')
        //         ->line('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.')
        //         ->action('Restablecer contraseña', $url)
        //         ->line('Este enlace de restablecimiento de contraseña caducará en ' . $count . ' minutos.')
        //         ->line('Si no solicitó un restablecimiento de contraseña, puede omitir este mensaje.');
        // });
    }
}
