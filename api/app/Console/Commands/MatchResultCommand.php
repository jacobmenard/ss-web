<?php

namespace App\Console\Commands;

use App\Mail\EmailPusher;
use App\Models\UserEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MatchResultCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matchresult:final';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will be send as match result for final match result.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $userEvents = new UserEvent;
        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url, [
            'order_by' => 'start_desc',
            'page_size' => 5,
            'time_filter' => 'past'
        ]);

        $events = $response['events'];
        $eventIds = collect($events)->pluck('id');

        $userList = $userEvents->whereIn('event_id', $eventIds)->where('is_checkin', 1)->whereNull('event_status');

        // $userList = $userEvents->whereIn('event_id', $eventIds);

        $userToSend = $userList->with(['user'])->get();
        $userToSend = $userToSend->map(function($data) {
            $mapData['subject'] = 'Your Sips & Sparks Matches Are Here!';
            $mapData['type'] = 'matchup_result_final';
            $mapData['matchup_url'] = env('CLIENT_URL').'/public/match-result/'.$data['user_id'].'?eid='.$data['event_id'];
            $mapData['email'] = $data['user']['email'];
            $mapData['name'] = $data['user']['first_name'];
            $mapData['id'] = $data['id'];
            return $mapData;
        });


        foreach($userToSend as $item) {
            $userEvents->where('id', $item['id'])->update(['event_status' => 'done']);
            Mail::to($item['email'])->send(new EmailPusher($item));
        }
        
        return 0;

    }
}
