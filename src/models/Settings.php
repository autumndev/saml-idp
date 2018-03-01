<?php
/**
 * Created by PhpStorm.
 * User: dsmrt
 * Date: 1/9/18
 * Time: 9:37 AM
 */

namespace flipbox\saml\idp\models;


use craft\base\Model;
use craft\elements\User;
use craft\helpers\UrlHelper;
use flipbox\saml\core\models\SettingsInterface;
use flipbox\saml\sp\Saml;
use flipbox\saml\idp\services\Metadata;
use LightSaml\ClaimTypes;
use LightSaml\Model\Assertion\Assertion;
use LightSaml\Model\Assertion\Attribute;
use LightSaml\SamlConstants;
use yii\base\InvalidConfigException;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use LightSaml\Credential\X509Certificate;

class Settings extends Model implements SettingsInterface
{
    use \flipbox\saml\core\traits\Settings;

    /**
     * @var bool
     */
    public $encryptAssertions = false;
    /**
     * @var bool
     */
    public $signAuthnRequest = true;

    /**
     * @var bool
     */
    public $enableHttpRedirectBinding = true;
    /**
     * @var bool
     */
    public $enableHttpPostBinding = true;

    public $enableCpLogin = true;

    /**
     * @var array
     */
    public $groupAttributeNames = [
        'groups',
    ];

    /**
     * Key Value store that maps the Response name (the array key) with
     * the user property.
     *
     * Simple mapping works by matching the Response name in the array with the user's
     * property, and setting what is found in the Response's value to the user element.
     *
     * Take the following example:
     * Here is my responseAttributeMap from the config/saml-sp.php
     * ```php
     * ...
     * 'responseAttributeMap' => [
     *      ClaimTypes::EMAIL_ADDRESS => 'email',
     *      'firstName' => 'firstName',
     * ],
     * ...
     * ```
     *
     * Here is a snippet from the Saml XML Response message:
     * ```xml
     * <Attribute Name="http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress">
     *    <AttributeValue>damien@example.com</AttributeValue>
     * </Attribute>
     * <Attribute Name="firstName">
     *    <AttributeValue>Damien</AttributeValue>
     * </Attribute>
     * ```
     *
     * The above would result in the following mapping:
     * ```php
     * // @var $user \craft\elements\User
     * $user->firstName = 'Damien';
     * $user->email = 'damien@example.com';
     * ```
     *
     * With more complex user fields, you can set the array value to a callable. For
     * more on callables http://php.net/manual/en/language.types.callable.php.
     *
     * Here is my responseAttributeMap with a callable from the config/saml-sp.php
     * ```php
     * 'responseAttributeMap' => [
     *      ClaimTypes::EMAIL_ADDRESS => function(\LightSaml\Model\Assertion\Assertion $attribute, \craft\elements\User $user){
     *           $user->email = $attribute->getFirstAttributeValue();
     *      }
     * ],
     * ```
     * @var array
     */

    public $responseAttributeMap = [
        //craft user/response assertion attribute name mapping
        'email'     => 'email',
        'firstName' => 'firstName',
        'lastName'  => 'lastName',


    ];

}