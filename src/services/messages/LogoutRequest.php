<?php
/**
 * Created by PhpStorm.
 * User: dsmrt
 * Date: 1/11/18
 * Time: 8:30 PM
 */

namespace flipbox\saml\idp\services\messages;


use craft\base\Component;
use LightSaml\Model\Protocol\LogoutRequest as LogoutRequestModel;

class LogoutRequest extends Component
{
    public function create()
    {
        $logout = new LogoutRequestModel();
//        $logout->
    }

}