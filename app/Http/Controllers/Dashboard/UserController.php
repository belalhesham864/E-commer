<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Services\Dashboard\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}
    public function getAll()
    {
        $users=$this->userService->getAll();
        return $users;
    }
    public function index()
    {
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data=$request->validated();
        $user=$this->userService->store($data);
        if(!$user){
     return response()->json(['status'=>false,'msg'=>'error please try again latter'],404);
     }
     return response()->json(['status'=>true,'msg'=>'User Created Successfuly'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=$this->userService->delete($id);
        if($user){
                  return response()->json([
            'status'=>'success',
            'msg'=>'User Deleted Successfuly'
        ]);
        }
    }

      public function changeStatus($id){
        $status=$this->userService->changeStatus($id);
        if($status){
        return response()->json([
            'status'=>'success',
            'msg'=>'Status Changed Successfuly'
        ]);

        }
    }
}
