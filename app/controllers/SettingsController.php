<?php
class SettingsController extends BaseController {
 
    protected function _make_response( $response_str, $type = 'application/json' ) {
        $response = Response::make( $response_str );
        $response->header( 'Content-Type', $type );
        return $response;
    }
 
    /**
     * show a view with form to create settings
     */
    public function create() {
        return View::make( 'settings' );
    }
 
    /**
     * handle data posted by ajax request
     */
    public function store() {
 
        $setting_name = Input::get( 'setting_name' );
        $setting_value = Input::get( 'setting_value' );
 
        //.....
        //validate data
        //and then store it in DB
        //.....
 
        $response = array(
            'status' => $setting_name,
            'msg' => $setting_value,
        );
 
        return $this->_make_response( json_encode( $response ) );
    }
 
//end of class
}