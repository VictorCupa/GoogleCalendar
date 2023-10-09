<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;


class GoogleCalendarEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
    $event = new Event;

$event->name = 'A new event';
$event->description = 'Event description';
$event->startDateTime = Carbon::now();
$event->endDateTime = Carbon::now()->addHour();
$event->addAttendee([
    'email' => 'john@example.com',
    'name' => 'John Doe',
    'comment' => 'Lorum ipsum',
]);
$event->addAttendee(['email' => 'anotherEmail@gmail.com']);
$event->addMeetLink(); // optionally add a google meet link to the event

$event->save();

// get all future events on a calendar
$events = Event::get();

// update existing event
$firstEvent = $events->first();
$firstEvent->name = 'updated name';
$firstEvent->save();

$firstEvent->update(['name' => 'updated again']);

// create a new event
Event::create([
   'name' => 'A new event',
   'startDateTime' => Carbon::now(),
   'endDateTime' => Carbon::now()->addHour(),
]);

// delete an event
$event->delete();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
