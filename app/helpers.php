<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;

if (!function_exists('check_password')) {
  /**
   * Check if request password matches user's hashed password
   * 
   * @param string $requestPassword Plain text password from request
   * @param string $userPassword Hashed password from database
   * @return bool
   */
  function check_password(string $requestPassword, string $userPassword): bool
  {
    return Hash::check($requestPassword, $userPassword);
  }
}

if (!function_exists('verify_credentials')) {
  /**
   * Find user by email and verify password
   * 
   * @param string $email User email
   * @param string $password Plain text password
   * @return User|null Returns user if credentials are valid, null otherwise
   */
  function verify_credentials(string $email, string $password): ?User
  {
    $user = User::where('email', $email)->first();

    if (!$user || !check_password($password, $user->password)) {
      return null;
    }

    return $user;
  }
}
