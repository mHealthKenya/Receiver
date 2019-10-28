<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receiver;
use App\Report;
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
use Log;

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
            #$inb = new MLABInbox;

            #$inb->shortCode = $request->to;
            #$inb->MSISDN = $request->from; 
            #$inb->message = $request->text;
            #$inb->msgDateCreated = $request->date;
            #$inb->message_id = $request->id;
            #$inb->LinkId = $request->linkId;

            #$inb->save();

            $inb1 = new MLABNEWInbox;

            $inb1->shortCode = $request->to;
            $inb1->MSISDN = $request->from; 
            $inb1->message = $request->text;
            $inb1->msgDateCreated = $request->date;
            $inb1->message_id = $request->id;
            $inb1->LinkId = $request->linkId;

            $inb1->save();
            $lastID = $inb1->id;
            $task = 3;

            $this->task($task, $lastID);
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
            $lastID = $inb->id;
            $task = 4;

            $this->task($task, $lastID);

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

            $lastID = $inb->id;
            $task = 2;

            $this->task($task, $lastID);

            $inb1 = new UshauriNEWInbox;

            $inb1->destination = $request->to;
            $inb1->source = $request->from; 
            $inb1->msg = $request->text;
            $inb1->receivedtime = $request->date;
            $inb1->reference = $request->id;
            $inb1->LinkId = $request->linkId;

            $inb1->save();

            $lastID1 = $inb1->id;
            $task1 = 2;

            $this->task($task1, $lastID1);

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
            $lastID = $inb->id;
            $task = 1;

            $this->task($task, $lastID);
        }

        if($request->to == '40149'){

            $mpunda = new Report;

            $mpunda->shortCode = $request->to;
            $mpunda->source = $request->from; 
            $mpunda->message = $request->text;
            $mpunda->received = $request->date;
            $mpunda->reference = $request->id;
            $mpunda->linkId = $request->linkId;
    
            $mpunda->save();

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
            $lastID = $inb2->id;
            $task = 5;

            //Comment the code below if SMS are being looped.
            
            $this->task($task, $lastID);

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
        
        Log::info("ID: ". $LastInsertId.", TASK: ".$task);
        switch ($task) {
            case 1:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://c4c.localhost/core");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);

                curl_close($ch);
                echo 'Done task 1';
            break;

            case 2:
                
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://ushauri.localhost/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                curl_exec($ch);

                curl_close($ch);

                //ushauri new
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://ushaurinew.localhost/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);

                curl_close($ch);
            break;

            case 3:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://mlab.localhost/process/inbox/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);

                curl_close($ch);

                echo 'Done task 3';

            break;

            break;
            case 4:
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://t4a.localhost/chore/receiver/$LastInsertId");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);

                curl_close($ch);

                echo 'Done task 4';

            break;
            case 5:

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "http://lima.localhost/process_inbox");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);

                curl_close($ch);

                // C4C Test URL

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://c4c-test.localhost/core");
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_exec($ch);

                curl_close($ch);


                //Kaps URL





                $ch = curl_init();

                // curl_setopt($ch, CURLOPT_URL, "http://c4c-test.localhost/index.php/core");
                //$LastInsertId
                curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/KAPS/index.php/survey/");
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
