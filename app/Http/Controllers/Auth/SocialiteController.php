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
        return [
            'redirect_url' => (Socialite::driver('google')->stateless()->redirect())->getTargetUrl(),
        ];
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        return [
            'id'            => $user->getId(),
            'nick_name'     => $user->getNickname(),
            'name'          => $user->getName(),
            'email'         => $user->getEmail(),
            'avatar'        => $user->getAvatar(),
            'token'         => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in'    => $user->expiresIn,
        ];
    }
}