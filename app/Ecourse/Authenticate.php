<?php

namespace App\Ecourse;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\RequestOptions;

class Authenticate extends Core
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * Create a new authenticate instance.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;

        $this->password = $password;
    }

    /**
     * Check user login success or not.
     *
     * @return bool
     */
    public function check()
    {
        if (false === ($url = $this->sendRequest()))
        {
            return false;
        }
        else if (false === ($session = $this->parseSession($url)))
        {
            return false;
        }

        $this->storeSession($session);

        return true;
    }

    /**
     * Send login request to ecourse server.
     *
     * @return bool|string
     */
    public function sendRequest()
    {
        $request = new Client();

        $response = $request->post(Core::LOGIN_ACTION_PAGE, [
            'form_params' => [
                'id' => $this->username,
                'pass' => $this->password,
                'ver' => 'C'
            ],
            'allow_redirects' => false,
            'verify' => storage_path('app/cert.pem')
        ]);

        if ((302 !== $response->getStatusCode()) || ( ! count($location = $response->getHeader('location'))))
        {
            return false;
        }

        return $location[0];
    }

    /**
     * Get the session data from location url.
     *
     * @param string $url
     * @return bool|string
     */
    public function parseSession($url)
    {
        if (false === ($session = stristr($url, 'PHPSESSID')))
        {
            return false;
        }

        return substr($session, 10);
    }

    /**
     * Store session data.
     *
     * @param string $session
     */
    public function storeSession($session)
    {
        session()->put('PHPSESSID', $session);

        $this->storeCookie($session);
    }

    /**
     * Create cookie and store it.
     *
     * @param string $session
     */
    public function storeCookie($session)
    {
        $cookie = SetCookie::fromString("PHPSESSID={$session}; path=/");
        $cookie->setDomain('ecourse.ccu.edu.tw');
        $cookie->setDiscard(true);

        session()->put('COOKIE', new CookieJar(false, [$cookie]));
    }
}