<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventbriteController extends Controller
{
    //

    public function getEventList(Request $request) {
        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url, [
            'order_by' => 'start_asc',
            'page_size' => 10,
            'time_filter' => 'current_future'
        ]);

        $data['data']['events'] = $response['events'];
        $data['data']['pagination'] = $response['pagination'];
        $data['message'] = '';
        $data['status'] = 'success';
        
        return $data;
    }
}
