<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email Anda - Quiz Arena')
                ->greeting('Halo, Pejuang Kuis! 🎮')
                ->line('Selamat datang di Quiz Arena! Kami sangat senang melihat Anda bergabung ke dalam arena.')
                ->line('Sebelum mulai menaklukkan tantangan dan mengumpulkan poin, silakan verifikasi alamat email Anda dengan mengklik tombol sakti di bawah ini.')
                ->action('Verifikasi Email Saya', $url)
                ->line('Jika Anda merasa tidak pernah mendaftar di Quiz Arena, abaikan saja email ini ya.')
                ->salutation('Salam Hangat, Tim Quiz Arena 🚀');
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Atur Ulang Kata Sandi - Quiz Arena')
                ->greeting('Halo, Pejuang Kuis! 🛡️')
                ->line('Anda menerima email ini karena kami mendapat permintaan darurat untuk mengatur ulang (reset) kata sandi akun Anda.')
                ->action('Atur Ulang Kata Sandi', $url)
                ->line('Tautan atur ulang kata sandi ini akan hangus dalam ' . config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) . ' menit.')
                ->line('Jika Anda tidak pernah merasa meminta perubahan kata sandi, abaikan email ini dan akun Anda akan tetap aman sentosa.')
                ->salutation('Salam Hangat, Tim Quiz Arena 🚀');
        });
    }
}
