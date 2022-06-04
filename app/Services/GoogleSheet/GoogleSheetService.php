<?php

namespace App\Services\GoogleSheet;

use App\Dto\GoogleSheet\GoogleSheetDto;
use Google\Client;
use Google\Exception;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Illuminate\Support\Facades\Log;

class GoogleSheetService
{
    protected Client $client;
    protected Sheets $service;
    protected string $documentId;
    protected string $range;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->client = $this->getClient();
        $this->service = new Sheets($this->client);
        $this->documentId = config('google_sheet.google_sheet_id');
        $this->range = config('google_sheet.google_sheet_range');
    }

    /**
     * @throws Exception
     */
    public function getClient(): Client
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setRedirectUri('http://localhost:8000');
        $client->setScopes(Sheets::SPREADSHEETS);
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setAccessType('offline');

        return $client;
    }

    /**
     * @return array<GoogleSheetDto>
     */
    public function parseData(array $values = []): array
    {
        $response = [];
        $count = count($values);

        for ($i = 2; $i < $count; $i++) {
            $response[] = GoogleSheetDto::buildByArgs($values[$i]);
        }

        return $response;
    }

    public function readSheet(): ?ValueRange
    {
        try {
            return $this->service->spreadsheets_values->get($this->documentId, $this->range);
        } catch (\Exception $exception) {
            Log::channel('googleSheet')
                ->error(
                    'Cant read information from Google Sheet for ' . $this->documentId,
                    [
                        'exception_message' => $exception->getMessage()
                    ]
                );

            return null;
        }
    }
}