<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\SimpleUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return SimpleUserResource::collection($users);
    }


    /**
     * Store a newly created user.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \App\Http\Resources\UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        $newUser = User::create($data);
        return new UserResource($newUser);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \App\Http\Resources\UserResource
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('view', $user);
        return new UserResource($user);
    }

    /**
     * Display the user's information.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function showMe(Request $request)
    {
        $this->authorize('viewMe', User::class);
        return new UserResource(auth()->user());
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\UserResource
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $data = $request->validated();
        if($user->update($data)){
            return new UserResource($user);
        }
        abort(500, 'Could not update user.');
    }


    /**
     * Update the requester's user in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\UserResource
     */
    public function updateMe(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $this->authorize('update', $user);

        $data = $request->validated();
        if($user->update($data)){
            return new UserResource($user);
        }
        abort(500, 'Could not update user.');
    }

    /**
     * Update the specified user's role in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\UserResource
     */
    public function updateRole(UpdateRoleRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('updateRole', $user);
        $data = $request->validated();
        $user->syncRoles($data['role']);
        $user->save();
        
        return new UserResource($user);
    }
    
    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json([
            'message' => 'Successfully deleted user!',
        ], 200);
    }

    /**
     * Remove the requester's user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyMe(Request $request)
    {
        $user = auth()->user();
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json([
            'message' => 'Successfully deleted user!',
        ], 200);
    }


    /**
     * Ban the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ban(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('ban', $user);
        $user->update(['banned'=>true]);
        return response()->json([
            'message' => 'Successfully banned user!',
        ], 200);
    }

    /**
     * Unban the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unban(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('unban', $user);
        $user->update(['banned'=>false]);
        return response()->json([
            'message' => 'Successfully unbanned user!',
        ], 200);
    }


    /**
     * Grant role to the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function grantRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('grantRole', User::class);
        // TODO implement grantRole
        return response()->json([
            'message' => 'Successfully banned user!',
        ], 200);
    }
}
