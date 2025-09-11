<?php

function apiResponse($data, $status = 200)
{
    return [
        'status' => $status,
        'data'   => $data,
    ];
}
