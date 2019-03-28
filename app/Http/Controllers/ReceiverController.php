<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receiver;
use App\UshauriInbox;
use App\UshauriNEWInbox;
use App\MLABInbox;
use App\MLABNEWInbox;
use App\LIMAInbox;
use App\KAPSInbox;
use App\C4CInbox;
use App\C4CTESTInbox;
use App\T4AInbox;
use App\T4AUshauriInbox;

class ReceiverController extends Controller
{
    public function index(Request $request){

        $rec = new Receiver;

        $rec->to = $request->to;
        $rec->from = $request->from; 
        $rec->text = $request->text;
        $rec->date = $request->date;
        $rec->gtway_id = $request->id;
        $rec->LinkId = $request->linkId;

        $rec->save();

        if($request->to == '40147'){
            $inb = new MLABInbox;

            $inb->shortCode = $request->to;
            $inb->MSISDN = $request->from; 
            $inb->message = $request->text;
            $inb->msgDateCreated = $request->date;
            $inb->message_id = $request->id;
            $inb->LinkId = $request->linkId;

            $inb->save();

            $inb1 = new MLABNEWInbox;

            $inb1->shortCode = $request->to;
            $inb1->MSISDN = $request->from; 
            $inb1->message = $request->text;
            $inb1->msgDateCreated = $request->date;
            $inb1->message_id = $request->id;
            $inb1->LinkId = $request->linkId;

            $inb1->save();
        }

        if($request->to == '40148'){
            $inb = new T4AInbox;

            $inb->destination = $request->to;
            $inb->source = $request->from; 
            $inb->msg = $request->text;
            $inb->date_fetched = $request->date;
            $inb->reference = $request->id;
            $inb->LinkId = $request->linkId;

            $inb->save();

            $LastInsertId=$inb->id();
            $task = 4;
            return $this->task($task,$LastInsertId);

        }

        if($request->to == '40146'){
            $inb = new UshauriInbox;

            $inb->destination = $request->to;
            $inb->source = $request->from; 
            $inb->msg = $request->text;
            $inb->receivedtime = $request->date;
            $inb->reference = $request->id;
            $inb->LinkId = $request->linkId;

            $inb->save();

            $new_LastInsertId=$inb->id();

            $task = 2;
            return $this->task($task,$new_LastInsertId);

            $inb1 = new UshauriNEWInbox;

            $inb1->destination = $request->to;
            $inb1->source = $request->from; 
            $inb1->msg = $request->text;
            $inb1->receivedtime = $request->date;
            $inb1->reference = $request->id;
            $inb1->LinkId = $request->linkId;

            $inb1->save();
            $ushauri_newLastInsertId=$inb1->id();		

            $task = 2;
            return $this->task($task,$ushauri_newLastInsertId);

        }

        if($request->to == '40145'){
            $inb = new C4CInbox;

            $inb->shortCode = $request->to;
            $inb->mobile_no = $request->from; 
            $inb->msg = $request->text;
            $inb->date_fetched = $request->date;
            $inb->msgID = $request->id;
            $inb->LinkId = $request->linkId;

            $inb->save();

            $task = 1;
            $LastInsertId="";

            return $this->task($task,$LastInsertId);
        }

        if($request->to == '40149'){
            $inb = new C4CTESTInbox;

            $inb->shortCode = $request->to;
            $inb->mobile_no = $request->from; 
            $inb->msg = $request->text;
            $inb->date_fetched = $request->date;
            $inb->msgID = $request->id;
            $inb->LinkId = $request->linkId;

            $inb->save();

            $inb1 = new LIMAInbox;

            $inb1->destination = $request->to;
            $inb1->source = $request->from; 
            $inb1->content = $request->text;
            $inb1->receivedtime = $request->date;
            $inb1->reference = $request->id;
            $inb1->LinkId = $request->linkId;

            $inb1->save();

            $inb2 = new KAPSInbox;

            $inb2->destination = $request->to;
            $inb2->source = $request->from; 
            $inb2->response = $request->text;
            $inb2->AT_date = $request->date;
            $inb2->AT_id = $request->id;
            $inb2->linkid = $request->linkId;

            $inb2->save();
            $LastInsertId=$inb2->id();
            $task = 5;
            return $this->task($task,$LastInsertId);

            $inb3 = new T4AUshauriInbox;

            $inb3->destination = $request->to;
            $inb3->source = $request->from; 
            $inb3->msg = $request->text;
            $inb3->receivedtime = $request->date;
            $inb3->reference = $request->id;
            $inb3->LinkId = $request->linkId;

            $inb3->save();
        }

    }

    function task($task,$LastInsertId) {
        switch ($task) {
            case 1:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://c4c.mhealthkenya.co.ke/core");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://c4c.mhealthkenya.co.ke/core");
                
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);


                echo 'Done task 1';
            break;

            case 2:
                //ushauri
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://ushauri.mhealthkenya.co.ke/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                //ushauri new
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://ushaurinew.mhealthkenya.co.ke/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);



            break;
            case 3:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "http://41.220.229.130/c4c-test-BE");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                echo 'Done task 3';

            break;
            case 4:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://t4a.mhealthkenya.co.ke/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                echo 'Done task 4';

            break;
            case 5:

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "http://mobivet.mhealthkenya.org/process_inbox");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                // C4C Test URL

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://c4c-test.mhealthkenya.co.ke/core");
                
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);


                //Kaps URL





                $ch = curl_init();

                // curl_setopt($ch, CURLOPT_URL, "http://c4c-test.localhost/index.php/core");
                //$LastInsertId
                curl_setopt($ch, CURLOPT_URL, "109.74.200.136/KAPS/index.php/survey/responses/$LastInsertId");
                
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);

                echo 'Done task 5';

            break;

            default:
            break;
        }
}

}
