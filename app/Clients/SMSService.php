<?php

namespace App\Clients;

use App\Models\Base\Settings\ClientHistory;
use GuzzleHttp\Client;

class SMSService
{
    /**
     * @var string
     */
    const URL = 'http://91.204.239.44/broker-api/send';

    /**
     * @var array
     */
    const AUTH = ['login', 'password'];

    private ClientHistory $history;
    private Client $client;

    public function __construct()
    {
        $this->history = new ClientHistory();
        $this->client = new Client();
    }

    public function sendPhoneMessage($phone, $code)
    {
        $message = 'Код подтверждения: ' . $code;
        return $this->request($phone, $message);
    }

    /**
     * @param string $phone
     * @param string $text
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request(string $phone, string $text): bool
    {
        if (env('APP_DEBUG')) // TODO, at production, remove this
            return true;
        $phone = clearPhone($phone);
        if (strlen($phone) == 9) {
            $phone = '998' . $phone;
        }

        $data = static::getData($phone, $text);
        $response = $this->client->request("POST", self::URL, [
            'auth' => self::AUTH,
            'json' => $data
        ]);

        $stream = $response->getBody();
        $this->history->make($data, $stream->getContents(), self::class);
        $stream->rewind();
        if ($response->getStatusCode() == 200)
            return true;//$request->getBody()->getContents();
        return false;
    }

    /**
     * @param string $phone
     * @param string $text
     * @return array|\array[][]
     */
    private static function getData(string $phone, string $text): array
    {
        return [
            'messages' => [
                [
                    "recipient" => $phone,
                    "message-id" => "ushop" . time(),
                    'sms' => [
                        "originator" => 4800,
                        'content' => [
                            'text' => $text
                        ],
                    ],
                ],
            ]
        ];
    }
}
