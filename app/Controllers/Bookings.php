<?php namespace App\Controllers;

use App\Services\ApiClient;

class Bookings extends BaseController
{
    private ApiClient $api;
    public function __construct() { $this->api = new ApiClient(); }

    public function createForm(string $flightId)
    {
        $flight = $this->api->get('/flights/'.$flightId);
        return view('layout', [
            'title'   => 'New Booking',
            'content' => view('booking_form', [
                'flightId' => $flightId,
                'flight'   => is_array($flight['body']) ? $flight['body'] : null
            ])
        ]);
    }

    public function create()
    {
        $paxArr = $this->request->getPost('passengers') ?? [];
        $passengers = [];
        foreach ($paxArr as $p) {
            if (empty($p['fullName']) || empty($p['paxType'])) continue;
            $passengers[] = [
                "fullName" => $p['fullName'],
                "paxType"  => $p['paxType'],
                "birthDate"=> $p['birthDate'] ?: null,
                "docNo"    => $p['docNo'] ?: null,
            ];
        }
        if (empty($passengers)) {
            return redirect()->back()->with('error', 'Passenger invalid / empty');
        }

        $payload = [
            "flightId"     => $this->request->getPost('flightId'),
            "contactName"  => $this->request->getPost('contactName'),
            "contactEmail" => $this->request->getPost('contactEmail'),
            "contactPhone" => $this->request->getPost('contactPhone'),
            "passengers"   => $passengers
        ];

        $res = $this->api->post('/bookings', $payload);
        if ($res['code'] !== 201) {
            return view('layout', [
                'title'   => 'New Booking - Error',
                'content' => view('booking_form', [
                    'flightId' => $payload['flightId'],
                    'error'    => is_array($res['body']) ? json_encode($res['body']) : $res['body']
                ])
            ]);
        }

        return view('layout', [
            'title'   => 'Booking Confirmed',
            'content' => view('booking_confirm', ['booking' => $res['body']])
        ]);
    }

    public function detail(string $pnr) { 
        return view('layout', [ 
            'title' => 'Booking Detail', 
            'content' => view('booking_detail', ['pnr' => $pnr]) 
        ]); 
    }

    public function update(string $pnr)
    {
        $payload = array_filter([
            'contactName'  => $this->request->getPost('contactName') ?: null,
            'contactEmail' => $this->request->getPost('contactEmail') ?: null,
            'contactPhone' => $this->request->getPost('contactPhone') ?: null,
        ], fn($v) => $v !== null);

        $res = $this->api->patch("/bookings/{$pnr}", $payload);
        if ($res['code'] !== 200) {
            return redirect()->back()->with('error', 'Update failed: '. (is_array($res['body'])? json_encode($res['body']) : $res['body']));
        }
        return redirect()->to('/bookings/'.$pnr)->with('success', 'Updated');
    }

    public function cancel(string $pnr)
    {
        $res = $this->api->post("/bookings/{$pnr}/cancel");
        if ($res['code'] !== 204) {
            return redirect()->back()->with('error', 'Cancel failed: '. (is_array($res['body'])? json_encode($res['body']) : $res['body']));
        }
        return redirect()->to('/')->with('success', "Booking $pnr cancelled");
    }
}
