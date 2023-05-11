<?php

namespace App\Http\Controllers;

use App\Models\Containers;
use App\helpers\UpdateContainersMessages;
use Exception;
use Illuminate\Http\Request;

class DockerContainersController extends Controller
{
    /**
     * Return the view of containers
     *
     * @return view
     */
    public function show() {
        return view('containers');
    }

    /**
     * Return an array of docker process and their states
     *
     * @return array
     */
    public function list() {
        try {
            $containers = Containers::obtainContainers();
        } catch (\Exception $error) {
            throw new Exception($error);
        }

        return $containers;
    }

    /**
     * Change the status of a container
     *
     * @param string $name
     * @return string
     */
    public function changeStatusContainer(Request $request): string {
        try {
            $action = $request->input('action');
            $result = Containers::updateContainer($action, $request->input('name'));
            if($result) {
                if($action == 'rm'){
                    $action = 'remove';
                }
                return UpdateContainersMessages::getMessage($action);
            } else {
                return UpdateContainersMessages::getMessage("error");
            }
        } catch (\Exception $error) {
            throw new Exception($error);
        }
    }
}
