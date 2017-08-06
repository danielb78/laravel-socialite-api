<?php

namespace lsa\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use lsa\Http\Controllers\Controller;
use lsa\Lib\Reply;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Reply
     */
    public function redirectToProvider()
    {
        return $this->success([
            'redirect_url' => (Socialite::driver('google')->stateless()->redirect())->getTargetUrl(),
        ]);
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Reply
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        return $this->success([
            'id'            => $user->getId(),
            'nick_name'     => $user->getNickname(),
            'name'          => $user->getName(),
            'email'         => $user->getEmail(),
            'avatar'        => $user->getAvatar(),
            'token'         => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in'    => $user->expiresIn,
        ]);
    }
}