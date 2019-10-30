<?php

namespace App\View\Composers;

use Illuminate\View\View;

class RecaptchaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('recaptcha_site_key', config('services.recaptcha.site_key'));
    }
}