<?php namespace App\Controllers;

use App\Services\ApiClient;

class Flights extends BaseController
{
    private ApiClient $api;
    public function __construct() { $this->api = new ApiClient(); }

    public function index()
    {
        return view('layout', [
            'title' => 'Search Flight',
            'content' => view('flights_search')
        ]);
    }

    public function search()
    {
        $origin = strtoupper($this->request->getGet('origin') ?? '');
        $dest   = strtoupper($this->request->getGet('dest') ?? '');
        $date   = $this->request->getGet('date') ?? '';

        $res = $this->api->get('/flights/search', compact('origin','dest','date'));
        if ($res['code'] !== 200) {
            return view('partials/search_results', ['error' => $res['body'] ?: 'Search failed', 'flights' => []]);
        }
        return view('partials/search_results', ['flights' => $res['body']]);
    }
}
