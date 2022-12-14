<?php

namespace Mlk\User\Services;

use Mlk\User\Models\User;

class UserService
{
    public function store($request)
    {
        return User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

    public function update($request, $id)
    {
        return User::query()->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }


    # ROLES
    public function addRole($role, $user)
    {
        return $user->assignRole($role);
    }

    public function deleteRole($user, $role)
    {
        return $user->removeRole($role);
    }


    # Update Profile - UPDATE
    public function updateProfile($request, $id, $imageName, $imagePath)
    {
        return User::query()->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'telegram' => $request->telegram,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'bio' => $request->bio,
            'imageName' => $imageName,
            'imagePath' => $imagePath,
        ]);
    }
}
