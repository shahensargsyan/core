<?php namespace App\Other;

use Request;
use App\Booking;
use App\Service;
use App\Employee;
use App\Customer;
use App\CustomInformation;
use Carbon\Carbon;
use DateTime;

class Misc {
    
    public function test()
    {
        return '123456';
    }
    
    public function customInformation($key)
    {
        $custom_information = CustomInformation::first();
        
        return $custom_information && $custom_information->$key ? $custom_information->$key : '';
    }
    
    function validateDate($date, $format = 'd-m-Y H:i')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function checkAvailabilityAndBook($employee_id, $booking_start, $booking_end = null, $service_id = null, $user_id = null, $customer_id = null, $additional_comment, $id = null)
    {
        $employee = Employee::where('id', $employee_id)->active()->first();
        if(!$employee)
        {
            return [false, 'Employee Not Found', null];
        }
        
        if($service_id)
        {
            $service = Service::where('id', $service_id)->active()->first();
            if(!$service || !$service->duration)
            {
                return [false, 'Service Not Available', null];
            }
            
            if(!$employee->hasService($service_id))
            {
                return [false, 'Wrong Employee-Service combination', null];
            }
        }

        if($customer_id)
        {
            $customer = Customer::where('id', $customer_id)->first();
            if(!$customer)
            {
                return [false, 'Invalid customer id', null];
            }
        }
        
        $booking_start = Carbon::parse($booking_start);
        
        $weekDay = intval($booking_start->dayOfWeek);
        if(!$weekDay) //0-Sunday In our database it's 7
        {
            $weekDay = 7;
        }
       
        $availability = $employee->availabilities()->where('day', $weekDay)->active()->first();
        if(!$availability)
        {
            return [false, 'Employee Not Available', null];
        }

        if($booking_start->isToday())
        {
            $availability->start = Carbon::now()->addMinutes(60)->format('H:i:s');
        }

        if($availability->start > $availability->end)
        {
            return ['success' => false, 'Invalid DateTime', null];
        }
       
        if(!$booking_end && $service_id && $service)
        {
            $booking_end = Carbon::parse($booking_start)->addMinutes($service->duration);
        }
        
        $booking_end = Carbon::parse($booking_end);

        //dump('booking start - ' . $booking_start->format('H:i:s') , 'availability start - ' . $availability->start , 'booking end - ' . $booking_end->format('H:i:s') , 'availability end - ' . $availability->end);
        if($booking_start->format('H:i:s') < $availability->start || $booking_end->format('H:i:s') > $availability->end)
        {
            return [false, 'Invalid DateTime.', null];
        }
        
        $booking_start = $booking_start->format('Y-m-d H:i:s');
        $booking_end = $booking_end->format('Y-m-d H:i:s');
        
        $bookings = Booking::where('employee_id', $employee_id)
                                        ->NotDeletedAndOpened()
                                        ->where(function($query) use ($booking_start, $booking_end){
                                            $query->where(function($q1) use($booking_start, $booking_end) { //----------reserve_started_at-----booking_start---booking_end-------reserve_finished_at----------
                                                $q1->where('reserve_started_at', '<=', $booking_start);
                                                $q1->where('reserve_finished_at', '>=', $booking_end);
                                            });
                                            $query->orWhere(function($q2) use($booking_start, $booking_end) { //--------booking_start------reserve_started_at----booking_end-------reserve_finished_at----------
                                                $q2->where('reserve_started_at', '>=', $booking_start);
                                                $q2->where('reserve_started_at', '<', $booking_end);
                                                $q2->where('reserve_finished_at', '>=', $booking_end);
                                            });
                                            $query->orWhere(function($q3) use($booking_start, $booking_end) { //------reserve_started_at-------booking_start-------reserve_finished_at------booking_end---------
                                                $q3->where('reserve_started_at', '<=', $booking_start);
                                                $q3->where('reserve_finished_at', '>', $booking_start);
                                                $q3->where('reserve_finished_at', '<=', $booking_end);
                                            });
                                            $query->orWhere(function($q4) use($booking_start, $booking_end) { //------booking_start-------reserve_started_at-------reserve_finished_at------booking_end---------
                                                $q4->where('reserve_started_at', '>=', $booking_start);
                                                $q4->where('reserve_finished_at', '<=', $booking_end);
                                            });
                                        })->get();

        if($bookings->count())
        {
            return [false, 'Another Booking Found',  null];
        }
        
        $values = [];
        $values['employee_id'] = $employee_id;
        $values['service_id'] = $service_id;
        $values['reserve_started_at'] = $booking_start;
        $values['reserve_finished_at'] = $booking_end;
        
        
        if($user_id)
        {
            $values['user_id'] = $user_id;
        }
        
        if($customer_id)
        {
            $values['customer_id'] = $customer_id;
        }
        
        if($additional_comment)
        {
            $values['additional_comment'] = $additional_comment;
        }
        
        if(!$id){
            $book =  Booking::create($values);
        }else{
            $booking = Booking::findOrFail($id);
            $book = $booking->update($values);
        }
        
        
        return [true, '', $book];
    }
    public function checkAvailabilityAndAddAbsent($employee_id, $booking_start, $booking_end, $additional_comment, $id = null)
    {
        $employee = Employee::where('id', $employee_id)->active()->first();
        if(!$employee)
        {
            return [false, 'Employee Not Found', null];
        }
        
        $booking_start = Carbon::parse($booking_start);
        
        $weekDay = intval($booking_start->dayOfWeek);
        if(!$weekDay) //0-Sunday In our database it's 7
        {
            $weekDay = 7;
        }
       
        $booking_end = Carbon::parse($booking_end);

        $booking_start = $booking_start->format('Y-m-d H:i:s');
        $booking_end = $booking_end->format('Y-m-d H:i:s');
        
        $bookings = Booking::where('employee_id', $employee_id)
                                        ->NotDeletedAndOpened()
                                        ->where(function($query) use ($booking_start, $booking_end, $id){
                                            $query->where(function($q1) use($booking_start, $booking_end, $id) { //----------reserve_started_at-----booking_start---booking_end-------reserve_finished_at----------
                                                $q1->where('reserve_started_at', '<=', $booking_start);
                                                $q1->where('reserve_finished_at', '>=', $booking_end);
                                                if($id){
                                                    $q1->where('id', '!=', $id);
                                                }
                                            });
                                            $query->orWhere(function($q2) use($booking_start, $booking_end, $id) { //--------booking_start------reserve_started_at----booking_end-------reserve_finished_at----------
                                                $q2->where('reserve_started_at', '>=', $booking_start);
                                                $q2->where('reserve_started_at', '<', $booking_end);
                                                $q2->where('reserve_finished_at', '>=', $booking_end);
                                                if($id){
                                                    $q2->where('id', '!=', $id);
                                                }
                                            });
                                            $query->orWhere(function($q3) use($booking_start, $booking_end, $id) { //------reserve_started_at-------booking_start-------reserve_finished_at------booking_end---------
                                                $q3->where('reserve_started_at', '<=', $booking_start);
                                                $q3->where('reserve_finished_at', '>', $booking_start);
                                                $q3->where('reserve_finished_at', '<=', $booking_end);
                                                if($id){
                                                    $q3->where('id', '!=', $id);
                                                }
                                            });
                                            $query->orWhere(function($q4) use($booking_start, $booking_end, $id) { //------booking_start-------reserve_started_at-------reserve_finished_at------booking_end---------
                                                $q4->where('reserve_started_at', '>=', $booking_start);
                                                $q4->where('reserve_finished_at', '<=', $booking_end);
                                                if($id){
                                                    $q4->where('id', '!=', $id);
                                                }
                                            });
                                        })->get();

        if($bookings->count())
        {
            return [false, 'Another Booking Found',  null];
        }
        
        $values = [];
        $values['status'] = 'Opened';
        $values['employee_id'] = $employee_id;
        $values['service_id'] = null;
        $values['reserve_started_at'] = $booking_start;
        $values['reserve_finished_at'] = $booking_end;
        
        if($additional_comment)
        {
            $values['additional_comment'] = $additional_comment;
        }
        
        if(!$id){
            $book =  Booking::create($values);
        }else{
            $booking = Booking::findOrFail($id);
            $book = $booking->update($values);
        }
        
        
        return [true, '', $book];
    }
    
    public function getEmployeeAvailabilitiesByServiceAndDate($service,$employee,$dt){

        $serviceData = array(
                'id' => $service->id,
                'name' => $service->name ? $service->name : '',
                'description' => $service->description ? $service->description : '',
                'duration' => $service->duration ? $service->duration : '',
                'price' => $service->price ? $service->price : '',
                'image' => $service->image ? $service->image : '',
        );
        $dt = Carbon::parse($dt);
        $date = $dt->toDateString();
        
        $weekDay = intval($dt->dayOfWeek);
        if(!$weekDay) //0-Sunday In our database it's 7
        {
            $weekDay = 7;
        }
        
        $availability = $employee->availabilities()->where('day', $weekDay)->active()->first();
        if(!$availability)
        {
            return response()->json([
                                        'success' => true,
                                        'availability' => []
                                    ]);
        }
        
        $employee_availability = [];

        if(Carbon::parse($dt)->isToday())
        {
            if(Carbon::now() >= Carbon::parse($date)->format('d-m-Y') . ' ' . $availability->start 
                && Carbon::now() <= Carbon::parse($date)->format('d-m-Y') . ' ' . $availability->end)
            {
                $availability->start = Carbon::now()->addMinutes(60)->format('H:i:s');
            }
        }
        
        if($availability->start > $availability->end)
        {
            return response()->json([
                                        'success' => true,
                                        'availability' => []
                                    ]);
        }
        
        $employee_availability[] = [
            'start' => $availability->start,
            'end' => $availability->end,
        ];

        $emoployee_bookings = [];
        $bookings = Booking::where('employee_id', $employee->id)
                                ->where('reserve_started_at', '>=', $date . ' ' . $availability->start)
                                ->where('reserve_finished_at', '<=', $date . ' ' . $availability->end)
                                ->notDeletedAndOpened()
                                ->orderBy('reserve_started_at')->get();

        foreach($bookings as $booking)
        {
            $booking_started_at_time = $booking->reserve_started_at->toTimeString();
            $booking_finished_at_time = $booking->reserve_finished_at->toTimeString();
            
            $emoployee_bookings[] = [
                'start' => $booking_started_at_time,
                'end' => $booking_finished_at_time,
            ];
            
            $result = $this->__calculateFreeHours($employee_availability, $booking_started_at_time, $booking_finished_at_time);
            if(!empty($employee_availability))
            {
                $employee_availability = $result;
            }
        }

        $availabilities = [];
        foreach($employee_availability as $value)
        {
            $time_start = Carbon::parse($date . ' ' . $value['start']);
            $time_end = Carbon::parse($date . ' ' . $value['end']);
            $diff_in_minutes = $time_end->diffInMInutes($time_start);
            
            if($diff_in_minutes >= $service->duration)
            {
                for($i=0; $i< floor($diff_in_minutes/$service->duration); $i++)
                {
                    $availabilities[] = Carbon::parse($date . ' ' . $value['start'])->addMinutes($i * $service->duration)->format('h:i a');
                }
            }
        }
        
        return response()->json([
                                    'success' => true,
                                    'date' => Carbon::parse($date)->format('d-m-Y'),
                                    'availability' => $availabilities,
                                    'id' => $employee->id,
                                    'first_name' => $employee->user ? $employee->user->first_name : '',
                                    'last_name' => $employee->user ? $employee->user->last_name : '',
                                    'image' => $employee->image ? '/employees/' . $employee->image : '',
                                    'profession' => $employee->profession_id && $employee->profession ? trim($employee->profession->name) : '',
                                    'service' => $serviceData,
                                    
                                    //'now' => Carbon::now()->format('d-m-Y H:i:s'),
                                    //'av_start' => Carbon::parse($date)->format('d-m-Y') . ' ' . $availability->start,
                                    //'av_end' => Carbon::parse($date)->format('d-m-Y') . ' ' . $availability->end,
                                    /*
                                    'date' => $date,
                                    'employee_id' => $employee->id,
                                    'service_duration' => $service->duration,
                                    'working_hours' => [    
                                                            'start' => $availability->start,
                                                            'end' => $availability->end,
                                                        ],
                                    'bookings' => $emoployee_bookings,
                                    */
                                ]);
    }
    
    private function __calculateFreeHours($employee_availability, $booking_started_at_time, $booking_finished_at_time) :Array
    {
        $temp_availability = [];
        
        if(!is_array($employee_availability) || empty($employee_availability))
        {
            return [];
        }
        
        foreach($employee_availability as $value)
        {
            if($booking_started_at_time >= $value['start'] && $booking_finished_at_time <= $value['end'])
            {
                array_push(
                    $temp_availability, 
                    [
                        'start' => $value['start'],
                        'end' => $booking_started_at_time
                    ]
                );
                
                if($booking_finished_at_time < $value['end'])
                {
                    array_push(
                        $temp_availability, 
                        [
                            'start' => $booking_finished_at_time,
                            'end' => $value['end']
                        ]
                    );
                }
            }
            else {
                array_push($temp_availability, $value);
            }
        }
        
        return $temp_availability;
    }
}
