<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Event;
use App\User;
 
use Calendar;
 
class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
      $events = [];
      $user = auth()->user();

      $data = auth()->user()->events()->get();
      
        // $data = Event::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->event_name,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => '/events/' . $value->id .'/' . $value->start_date . '/' . $value->event_name,
	                ]
                );
            }
        }

        $calendar = Calendar::addEvents($events);
        return view('events', compact('calendar'));
    }
 

    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }
 
        // $event = new Event;
        // $event->event_name = $request['event_name'];
        // $event->start_date = $request['start_date'];
        // $event->end_date = $request['end_date'];
        // $event->save();

        auth()->user()->events()->create([
            'event_name' => $request['event_name'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],

        ]);
 
        \Session::flash('success','Event added successfully.');
        return Redirect::to('/events');
    }


    public function destroy($id) {
        $event = Event::findOrFail($id);

        $event->delete();

        \Session::flash('success','Event deleted successfully.');
        return redirect('/events');
    }



    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
            \Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }

        $where = array('id' => $request->id);

        $updateArr = [

            'event_name' => $request->event_name,
            'start_date' => $request->start_date, 
            'end_date' => $request->end_date,
        ];

        $event  = Event::where($where)->update($updateArr);

        \Session::flash('success','Event updated successfully.');
        return redirect('/events');
    }
 
}
 
