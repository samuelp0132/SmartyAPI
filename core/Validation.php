<?php 

	include_once __DIR__ . "/constants.php";

		class Validation{
		/* function to validate empty value
	 		* @param	string $fielName, string value, dataType, bool Required
	 		* @return	bool
	 	*/

		public static function validateParameter($fieldName,$value,$dataType,$required){

			if($required == TRUE && empty($value) == TRUE){

				self::throwError(VALIDATE_PARAMETER_REQUIRED,"Parameter {$fieldName} is required");
			}

		}

		/* function to throw an error
	 		* @param	int code, string message
	 		* @return	bool
	 	*/


		public static function throwError($code,$message){
			header("content-type: application/json");
			$error = json_encode(['Error' => ['status'=>$code, 'message'=>$message]]);

			echo $error; exit;
		}

		}

?>