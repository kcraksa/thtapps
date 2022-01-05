<?php  

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
	public function sendResponse($result, $message)
	{
		$response = [
			'success' => true,
			'total' => count($result),
			'data' => $result,
			'message' => $message
		];

		return response()->json($response, 200);
	}

	public function sendError($error, $errorMessages = [], $code = 404)
	{
		$response = [
			'success' => false,
			'total' => 0,
			'message' => $error
		];

		if (!empty($errorMessages)) {
			$response['data'] = $errorMessages;
		}

		return response()->json($response, $code);
	}
}

?>