<?php

namespace App\Http\Controllers;

use App\Models\CardTapped;
use App\Models\Client;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $liter = request()->get('liter');
        $card = request()->get('card');
        $cardTapped = CardTapped::query()->first();
        if ($liter && isset($cardTapped->card_number)){
            $client = Client::where('card_uid',$card)->first();
            $amount = $liter * 1000;
             if ($amount <= $client->balance){
                 $client->update([
                     'balance' => $client->balance - $amount
                 ]);
                 $cardTapped = CardTapped::query()->first();
                 $cardTapped->delete();
                 echo $liter * 5;
             } else {
                 $cardTapped = CardTapped::query()->first();
                 $cardTapped->delete();
                 echo "Insufficient funds";
             }

        } else {
            echo "Tape you card";
        }

    }
    public function fetchCard()
    {
        $card = CardTapped::query()->first();
        if (isset($card->card_number)) {
            echo $card->card_number;
        } else {
            echo 0;
        }
    }
    public function getCard()
    {
        $card = request()->get('card');
        $client = Client::where('card_uid',$card)->first();
        if(isset($client->card_uid)){
            CardTapped::create(['card_number' => $card]);
        } else {
            echo "Card not found";
        }
    }
}
