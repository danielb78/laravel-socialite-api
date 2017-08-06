<?php

namespace lsa\Http\Controllers\Auth;

use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use lsa\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        return json_encode($user);
    }
}