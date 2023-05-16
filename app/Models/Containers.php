<?php

namespace App\Models;

use Exception;

class Containers {
    public static function obtainContainers(): array {
        try {
            $output = shell_exec('docker ps -a --format "{{.Names}}"');
            if(!$output) {
                return [];
            }
            $containers_names = explode(PHP_EOL, trim($output));
            $status_containers = [];
            $i = 0;
            do {
                $container_name =  $containers_names[$i];
                $decode_array = json_decode(shell_exec('docker inspect ' . $container_name), true);
                $status = $decode_array[0]["State"]["Status"];
                $network = array_key_first($decode_array[0]["NetworkSettings"]["Networks"]);
                $status_containers[$i] = [
                    "name" => $container_name,
                    "running" => $status == "running",
                    "state" => $status,
                    "network" => $network
                ];
                $i++;
            } while ($i < count($containers_names));

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