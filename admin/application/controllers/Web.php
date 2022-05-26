<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Web extends BaseController
{
    public function index()
    {
        $this->global['pageTitle'] = 'DGT College';
        $this->webloadViews("web/index", $this->global, '', NULL);
    }
    
}
?>