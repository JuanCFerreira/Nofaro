<?php

namespace App\Http\Controllers;

use App\Models\Nofaro;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getHashes(int $maxAttempts = 0)
    {

        if ($maxAttempts != 0) {
            return Nofaro::select('block', 'input', 'key')->where('attempts', '<', $maxAttempts)->paginate(7);
        } else {
            return Nofaro::select('block', 'input', 'key')->paginate(7);
        }

    }

    public function generateHash(string $value)
    {

        $verifier = 1;
        $attempts = 0;

        while (true) {
            $key = $this->generateKey();
            $valueEncrypted = md5($value . $key);
            $verifier = substr_compare($valueEncrypted, "0000", 0, 4);
            date_default_timezone_set('America/Sao_Paulo');

            if ($verifier == 0) {
                return [
                    'hash' => $valueEncrypted,
                    'key' => $key,
                    'attempts' => $attempts,
                ];
            } else {
                $attempts++;
            }
        }

    }

    private function generateKey()
    {

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
    }

}
