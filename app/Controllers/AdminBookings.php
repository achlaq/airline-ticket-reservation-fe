<?php namespace App\Controllers;

use App\Services\ApiClient;

class AdminBookings extends BaseController
{
    private ApiClient $api;
    public function __construct(){ $this->api = new ApiClient(); }

    public function index()
    {
        return view('layout', [
            'title' => 'Manage Bookings',
            'content' => view('admin/bookings_index')
        ]);
    }

    public function search()
    {
        $q = [
            'pnr'    => $this->request->getGet('pnr') ?? null,
            'status' => $this->request->getGet('status') ?? null,
            'from'   => $this->request->getGet('from') ?? null,
            'to'     => $this->request->getGet('to') ?? null,
        ];
        $res = $this->api->get('/bookings/search', $q);
        return view('admin/partials/bookings_table', [
            'data' => $res['body'] ?? ['content'=>[], 'totalPages'=>0, 'number'=>0, 'size'=>$q['size']],
            'q'    => $q
        ]);
    }

    public function cancel(string $pnr)
    {
        $res = $this->api->post("/bookings/{$pnr}/cancel");
        return redirect()->back()->with($res['code']===204?'success':'error',
            $res['code']===204 ? "PNR $pnr cancelled" : "Cancel failed: ".json_encode($res['body']));
    }

    public function update(string $pnr)
    {
        $payload = array_filter([
            'contactName'  => $this->request->getPost('contactName') ?: null,
            'contactEmail' => $this->request->getPost('contactEmail') ?: null,
            'contactPhone' => $this->request->getPost('contactPhone') ?: null,
        ], fn($v)=>$v!==null);

        $res = $this->api->patch("/bookings/{$pnr}", $payload);
        return redirect()->back()->with($res['code']===200?'success':'error',
            $res['code']===200 ? "PNR $pnr updated" : "Update failed: ".json_encode($res['body']));
    }
}
