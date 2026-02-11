<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class LegacyUserProvider extends EloquentUserProvider
{
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        if (is_null($plain = $credentials['password'])) {
            return false;
        }

        // Check if it matches standard Laravel Bcrypt
        if ($this->hasher->check($plain, $user->getAuthPassword())) {
            return true;
        }

        // Check if it matches legacy SHA512
        $legacyKey = '53babadf3b95073c43728e3ffd5043a6';
        $legacyHash = hash("sha512", $plain . $legacyKey);

        if ($legacyHash === $user->getAuthPassword()) {
            // Optional: Re-hash to Bcrypt on next login
            // $user->password = bcrypt($plain);
            // $user->save();
            return true;
        }

        return false;
    }
}
