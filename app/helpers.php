<?php

/* Success response without data returning */
function success($message = null)
{
    return response()->json(['status' => 'success', 'message' => $message], 200);
}

/* Success response without pagination meta **/
function successDataWithoutPaginationMeta($data, $message = null)
{
    $data = [
        'status' => 'success',
        'message' => $message,
        'data' => $data->getCollection(),
    ];

    return response()->json($data, 200);
}

/* Success with data to return **/
function successData($data, $message = null)
{
    $data = [
        'status' => 'success',
        'message' => $message,
        'data' => $data,
    ];

    return response()->json($data, 200);
}

/* Error  */
function error($message = null)
{
    return response()->json(['status' => 'error', 'message' => $message], 500);
}

/* Bad Request data  */
function badRequest($message = null)
{
    return response()->json(['status' => 'error', 'message' => $message], 400);
}

/* error with data */
function errorData($data, $message = null)
{
    $data = [
        'status' => 'success',
        'message' => $message,
        'data' => $data,
    ];

    return response()->json($data, 500);
}

/* validation errors */
function validationErrors($errors, $message = null)
{
    $data = [
        'status' => 'validations',
        'message' => (empty($message)) ? __('response.invalid_data') : $message,
        'errors' => $errors,
    ];

    return response()->json($data, 422);
}
