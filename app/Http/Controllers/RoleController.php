<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use App\Models\User;

class RoleController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id): UserResource
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $user->syncRoles($data['role']);
        $user->save();
        
        return new UserResource($user);
    }
}
