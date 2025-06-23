<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index()
    {
        $allGroups = Group::with('users')->get();
        return Inertia::render("Groups", ['groups'=> $allGroups]);
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
        Group::create($data);
        return 1;
    }

    public function attachUserinGroup(Request $request, String $uuid){
    $user = $request->user();
    $group = Group::where("uuid", $uuid)->get();
    $groupId = $group->id; 
    $user->groups()->attach($groupId->id);
    }
}
