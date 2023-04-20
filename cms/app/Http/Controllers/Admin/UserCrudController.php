<?php

namespace App\Http\Controllers\Admin;

use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as BackpackUserCrudController;
use Backpack\CRUD\app\Exceptions\AccessDeniedException;

class UserCrudController extends BackpackUserCrudController
{
    // Backpack/PermissionManage rolls out it's own.

    // Modify the destroy operation to prevent deleting the owner user.
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        $user = $this->crud->getEntry($id);

        if($user->owner) {
            throw new AccessDeniedException('You cannot delete the owner user.');
        }

        return $this->crud->delete($id);
    }
}
