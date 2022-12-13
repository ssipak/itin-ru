<?php

namespace S25\ItinRu;

use S25\ItinRu\Contracts\PassportData;
use Symfony\Component\BrowserKit\HttpBrowser;

class Service implements Contracts\Service
{
    public const FORM_URL = 'https://oplatagosuslug.ru/inn/';

    private HttpBrowser $browser;

    public function __construct()
    {
        $this->browser = new HttpBrowser();
    }

    /**
     * @throws \JsonException
     */
    public function provideTin(PassportData $passportData): ?string
    {
        $crawler = $this->browser->request('GET', self::FORM_URL);

        if (!preg_match('/\bvar\s+_stoken\s*=\s*\'([^\']+)\'/u', $crawler->html(), $match)) {
            throw new \RuntimeException('SToken\'s not found');
        }

        $postData = [
            'data'    => http_build_query([
                'last_name'      => $passportData->getLastName(),
                'first_name'     => $passportData->getFirstName(),
                'patronymic'     => $passportData->getPatronymic(),
                'birthday'       => $passportData->getBirthday(),
                'document_type'  => '21',
                'document_value' => $passportData->getSeriesAndNumber(),
            ]),
            '_stoken' => $match[1],
        ];

        $this->browser->xmlHttpRequest('POST', '/ufns/searchinn/', $postData);

        $content = json_decode(
            $this->browser->getInternalResponse()->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        return $content['individualInn'] ?? null;
    }
}
