<?php
        if($packageUserRole = \Spatie\Permission\Models\Role::where(['guard_name' => 'web', 'name' => 'Package User'])->first()) {
            if(in_array($packageUserRole->id, $validatedData['roles'])) {
                if(!$chUser->packages_token) {
                    $chUser->update([
                        'packages_token' => $chUser->createToken('packages')->plainTextToken
                    ]);
                }
            } else {
                if($chUser->packages_token) {
                    $chUser->tokens()->where('name', 'packages')->delete();
                    $chUser->update([
                        'packages_token' => null
                    ]);
                }
            }
        }
