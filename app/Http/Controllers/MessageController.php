<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Services\AttachmentService;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    protected $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }


    public function store(Request $request, Ticket $ticket, AttachmentService $attachmentService)
    {
        $this->authorize('view', $ticket);

        $request->validate([
            'content' => 'required_without:attachments|string|nullable',
            'attachments.*' => 'file|max:10240',
        ]);

        $message = new Message([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        $ticket->messages()->save($message);

        // Gestion des pièces jointes
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachmentService->upload($file, $message, auth()->id());
            }
        }

        $ticket->update(['status' => 'answered']);

        // Charger les relations nécessaires pour la réponse
        $message->load(['user.membre', 'attachments']);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function sendSms(Request $request)
    {
        Log::info($request->all());
        DB::beginTransaction();
        try {

            $phoneNumber = '+225'. $request->phone;
            $urlLinke = $request->urlLink;
            Log::info($urlLinke);
            $response = $this->SMSService->sendSmsByInfobipAPI($phoneNumber, $urlLinke);
            
            // // Vérifier si une erreur s'est produite
            if (isset($response['error'])) {
                return response()->json(['error' => $response['error']], 500); // Retourne une erreur
            }else{
                return response()->json([
                    'success' => true,
                    'message' => 'le lien à bien été envoyé avec succès.',
                    'status' => 200,
                ]);
            }
           DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}