<?php

class User
{

    public static function auth()
    {
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            return     DB::table("users")->where("id", $id)->getOne();
        }
        return false;
    }

    public function login($requeset)
    {
        $error = [];

        if ($requeset) {
            $email = Helper::filter($requeset['email']);
            $password = $requeset['password'];
            if (empty($email)) {
                $error[] = 'Email field is require';
            }
            if (empty($password)) {
                $error[] = 'Password field is require';
            }


            if (strlen($password) < 6) {
                $error[] = "Password too short";
            }

            $user = DB::table("users")->where("email", $email)->getOne();

            if ($user) {
                $hashed_password = $user->password;
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $user->id;
                    return "success";
                } else {
                    $error[] = 'Wrong Password';
                }
            } else {
                $error[] = 'Email not found';
            }
            return $error;
        }
    }

    public function register($requeset)
    {
        $error = [];
        if (isset($requeset)) {
            if (empty($requeset['name'])) {
                $error[] = "Name field is required";
            }
            if (empty($requeset['email'])) {
                $error[] = "Email field is required";
            }
            if (filter_var($requeset['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email not valid";
            }
            if (empty($requeset['password'])) {
                $error[] = "Password field is required";
            }
            if (strlen($requeset['password']) < 6) {
                $error[] = "Password too short";
            }

            $user = DB::table("users")->where("email", $requeset["email"])->getOne();
            if ($user) {
                $error[] = "Email Already Exist!!";
            }

            if (count($error)) {
                return $error;
            } else {
                $user = DB::insert("users", [
                    "name" => Helper::filter($requeset['name']),
                    "email" => Helper::filter($requeset["email"]),
                    "password" => password_hash($requeset['password'], PASSWORD_BCRYPT)
                ]);

                $_SESSION["user_id"] = $user->id;
                return "success";
            }
        }
    }
}
