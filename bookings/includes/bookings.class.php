<?php
/**
 * Containes various functions to interact with the Bookings server.
 *
 */
class bookings {
	/**
	 * API function.
	 * Used to retrieve data formatted in 'serialized form.
	 * @param string $action API endpoint, e.g. 'book1', 'search', etc
	 * @param array $params Array of parameters to use in the API call
	 */
	static function api($action,$params) {
		global $bookings;
		$postVars=array();
		$postVars=$params;
		$postVars['_responsetype']='serialized';
		bookings_output($action,$postVars);
		$output=$bookings['output']['body'];
		$data=@unserialize($output);
		if ($data===false) {
			$data['html']=$output;
		}
		if (isset($_REQUEST['test'])) { ob_end_clean();print_r($data);die(); }
		return $data;
	}
}
