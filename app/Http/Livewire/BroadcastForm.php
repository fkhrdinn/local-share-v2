<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Broadcast;
use App\Jobs\SendBroadcast;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BroadcastForm extends Component
{
    public $subject;
    public $message;
    public $user;
    public $searchEmail='';
    public $checkedEmail = [];
    public $checkedAllEmail = '';
    public $checkedState = [];
    public $scheduleDate;

    public function rules()
    {
        $rules = [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];

        return $rules;
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function resetEmail()
    {
        $this->reset(['searchEmail', 'checkedEmail', 'checkedAllEmail']);
    }

    public function resetState()
    {
        $this->reset(['checkedState']);
    }

    public function create()
    {
        $this->validate();

        Broadcast::create(
            [
                'subject' => $this->subject,
                'message' => $this->message,
                'user_id' => $this->user->id
            ]
        );

        if($this->checkedAllEmail != 'Select All')
        {
            if(!empty($this->checkedState))
            {
                $stateEmail = [];

                foreach($this->checkedState as $state)
                {
                    $stateEmail[] = Customer::query()
                        ->where('state', $state)
                        ->distinct()
                        ->get('email')
                        ->toArray();
                }
                $date = Carbon::parse($this->scheduleDate);

                $finalEmail = [];

                foreach($stateEmail as $email)
                {
                    $finalEmail = array_merge($finalEmail, $email);
                }
                $finalEmail = array_unique($finalEmail, SORT_REGULAR);

                $arr = [
                    'emails' => $finalEmail,
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'date' => $date
                ];

                foreach ($finalEmail as $email) {
                    SendBroadcast::dispatch($email, $arr);
                }
            }
            
            if(!empty($this->checkedEmail)){
                $date = Carbon::parse($this->scheduleDate);
                $arr = [
                    'emails' => $this->checkedEmail,
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'date' => $date
                ];

                foreach ($this->checkedEmail as $email) {
                    SendBroadcast::dispatch($email, $arr);
                }
            }

        }else{
            $emails = Customer::query()
                ->distinct()
                ->get('email')
                ->toArray();

                $date = Carbon::parse($this->scheduleDate);

            $arr = [
                'emails' => $emails,
                'subject' => $this->subject,
                'message' => $this->message,
                'date' => $date
            ];

            foreach ($emails as $email) {
                SendBroadcast::dispatch($email, $arr);
            }
        }
        toast('Broadcast has been created successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/broadcasts');
    }

    public function render()
    {
        $results = [];
        $allEmail= [];
        $allState= [];
        //Search Email
        if (strlen($this->searchEmail) >= 3) {
            $results = Customer::query()
                ->where('email', 'LIKE', $this->searchEmail.'%')
                ->distinct()
                ->get();
        }

        if($this->checkedAllEmail == 'Select All'){
            $allEmail = Customer::query()
                ->distinct()
                ->get('email');
        }

        $allState = Customer::query()
            ->distinct()
            ->get('state');
        
        return view('livewire.broadcast-form', [
            'results' => $results,
            'allEmailCount' => $allEmail,
            'states' => $allState
        ]);
    }
}
