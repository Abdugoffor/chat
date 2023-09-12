<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        // return auth()->user()->id;
        // $model = MessageResource::collection(Message::orderBy('id', 'DESC')->where('from_id', auth()->user()->id)
        //     ->orWhere('to_id', auth()->user()->id)->limit(6)->get());

        $model = MessageResource::collection(Message::where(function ($query) {
            $query->where('from_id', auth()->user()->id)
                ->orWhere('to_id', auth()->user()->id);
        })
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get());
        $users = User::where('id', '!=', auth()->user()->id)->get();
        // event(new MessageSent($model));
        return view('index', ['users' => $users]);
    }
    public function store(Request $request)
    {
        $model = new Message();
        $model->from_id = auth()->user()->id;
        $model->to_id = $request->to_id;
        $model->body = $request->message;
        $model->save();

        // Bu qatorni o'zgartirish zarur.
        $to = $request->to_id;

        $models = MessageResource::collection(Message::where(function ($query) use ($to) {
            $query->where('from_id', auth()->user()->id)
                ->Where('to_id', $to);
        })
            ->orWhere(function ($query) use ($to) {
                $query->where('from_id', $to)
                    ->Where('to_id', auth()->user()->id);
            })
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get());

        event(new MessageSent($models));
        return redirect()->back();
    }
}
