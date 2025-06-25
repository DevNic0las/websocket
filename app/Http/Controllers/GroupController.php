<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index()
    {
        $allGroups = Group::with('users')->withCount('users')->get();
        return Inertia::render("Groups", ['groups' => $allGroups]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'group_name' => "required|string|max:255",
            'tags' => "required|string|",
            'description' => "required|string|max:255",
            'amount_people' => "required|integer|min:1",
        ]);
        $data['user_id'] = Auth::id();
        $GroupCreated = Group::create($data);
        $request->user()->groups()->attach($GroupCreated->id);
        return 1;
    }

    public function attachUserinGroup(Request $request, String $uuid)
    {
        $user = $request->user();
        if (!$uuid) {
            abort(404);
        }
        $group = Group::where("uuid", $uuid)->first();
        $groupId = $group->id;
        if($user->groups()->where('group_id', $groupId)->exists()){
            return;
        }
        $user->groups()->attach($groupId);
    }
    public function showYourGroup(Request $request){
        $user = $request->user();
        $groups = $user->groups()->with('users')->get();
        return Inertia::render("YourGroup", ['groups'=>$groups]);
    }

    public function chatGroup(Request $request,String $uuid){
         $user = $request->user();
        $query = Group::where("uuid", $uuid)->first();
        $groups = $user->groups()->where('group_id', $query->id)->first();
        return Inertia::render('ChatAll',['groups'=>$groups]);
    }

}
