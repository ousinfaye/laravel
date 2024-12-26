<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with(['user', 'equipe'])->paginate(10);
        return view('notification.index', ['notifications' => $notifications]);
    }


    public function create()
    {
        $equipes = Equipe::all();
        $users = User::all();

        return view('notification.create', compact('equipes', 'users'));
    }

    public function store(Request $request)
    {
        $notif = new Notification();
        $notif->title = $request->title;
        $notif->message = $request->message;
        if ($request->equip_id == null && $request->user_id == null) {
            return redirect()->route('createNotification')->with('error', 'Veuillez choisir une équipe ou un utilisateur');
        }else{
            if ($request->equip_id != null) {
                $notif->equip_id = $request->equip_id;
            }else {
                if ($request->user_id != null) {
                    $notif->user_id = $request->user_id;
                }
            }
        }
        $notif->auteur_id = Auth::user()->id;
        $notif->save();
        return redirect()->route('listNotification')->with('success', 'Notification envoyer creer et ennvoyer avec succes');
    }

    public function myNotif()
    {
        $users = User::all();
        $userId = Auth::id();

        $userTeams = Auth::user()->equipes->pluck('id');

        $notifs = Notification::where('user_id', $userId)
            ->orWhereIn('equip_id', $userTeams)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notification.myNotif', ['notifs' => $notifs, 'users' => $users]);
    }


}
