<?php

namespace App\Models;

use Exception;

class Containers {
    public static function obtainContainers(): array {
        try }
            //TODO: mejorar performance y formacion de array
            $output = shell_exec('docker ps -a --format "{{.Names}}"');
            if(!$output) {
                return [];
            }
            $containers_names = explode(PHP_EOL, trim($output));
            $status_containers = [];
            for($i = 0; $i < count($containers_names); $i++) {
                $container_name =  $containers_names[$i];
                $output_inspect = shell_exec('docker inspect ' . $container_name);
                $decode_array = json_decode($output_inspect, true);
                $status = $decode_array[0]["State"]["Status"];
                $network = array_key_first(get_object_vars(json_decode(shell_exec('docker inspect ' . $container_name . ' -f "{{json .NetworkSettings.Networks }}"'))));
                $status_containers[$i] = [
                "name" => $container_name,
                "running" => $status == "running",
                "state" => $status,
                "network" => $network
                ];
            }
    
            return $status_containers;
        } catch(\Exception $error) {
            throw new Exception($error);
        }
    }

    public static function updateContainer(string $action, string $name): bool {
        try {
            return str_contains(shell_exec('docker ' . $action . ' ' . $name), $name);
        } catch(\Exception $error) {
            throw new Exception($error);
        }
    }
}