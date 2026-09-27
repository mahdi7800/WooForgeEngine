<?php

class Sms
{
    private string $username = '';
    private string $password = '';

    protected string $from = '';
    protected string $to = '';
    protected int $code = 0;
    protected string $panel = '';
    protected string $api_key = '';
    protected string $message = '';
    protected int $verfiy_code = 0;

    public function sets_sms(
        string $from,
        string $to,
        int $code = 1222,
        string $panel = 'melipayamak',
        string $api_key = '',
        string $message = '',
        int $verfiy_code = 0
    ): void {

        $this->from = $from;
        $this->to = $to;
        $this->code = $code;
        $this->panel = $panel;
        $this->api_key = $api_key;
        $this->verfiy_code = $verfiy_code;

        if ($message !== '') {
            $this->message = $message;
        } else {
            $this->message = 'Your verification code is: ' . $verfiy_code;
        }
    }

    public function choice_panel(): bool
    {
        if ($this->panel === 'melipayamak') {
            return $this->melipayamak();
        }

        if ($this->panel === 'sms_ir') {
            return $this->sms_ir();
        }

        return false;
    }

    private function melipayamak(): bool
    {
        $settings = get_option('_shw_sms_settings_set', []);

        $username = $settings['username'] ?? '';
        $password = $settings['password'] ?? '';

        $data = [
            'username' => $username,
            'password' => $password,
            'to'       => $this->to,
            'from'     => $this->from,
            'code'     => $this->code
        ];

        $post_data = http_build_query($data);

        $handle = curl_init(
            'https://rest.payamak-panel.com/api/SendSMS/SendOtp'
        );

        curl_setopt_array($handle, [
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post_data
        ]);

        $response = curl_exec($handle);

        if ($response === false) {
            curl_close($handle);
            return false;
        }

        curl_close($handle);

        return true;
    }

    private function sms_ir(): bool
    {
        $data = [
            'lineNumber'   => $this->from,
            'messageText'  => $this->message,
            'mobiles'      => [$this->to],
            'sendDateTime' => null
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.sms.ir/v1/send/bulk',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',

            CURLOPT_POSTFIELDS => json_encode($data),

            CURLOPT_HTTPHEADER => [
                'X-API-KEY: ' . $this->api_key,
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            curl_close($curl);
            return false;
        }

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $http_code >= 200 && $http_code < 300;
    }
}