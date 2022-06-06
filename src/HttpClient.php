<?php

    class HttpClient{

        public static function get($url, $auth){
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public static function post($url, $data, $auth){
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_POST, 1);

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public static function put($url, $data, $auth){
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);

        }

        public static function patch($url, $data, $auth){
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public static function delete($url, $auth){
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);
        }

    }