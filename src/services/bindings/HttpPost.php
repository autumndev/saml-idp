<?php
/**
 * Created by PhpStorm.
 * User: dsmrt
 * Date: 1/11/18
 * Time: 9:44 PM
 */

namespace flipbox\saml\idp\services\bindings;


use flipbox\saml\core\exceptions\InvalidIssuer;
use flipbox\saml\core\models\ProviderInterface;
use flipbox\saml\core\services\bindings\AbstractHttpPost;
use flipbox\saml\idp\Saml;
use flipbox\saml\core\services\traits\Security;
use LightSaml\Model\Assertion\Issuer;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use LightSaml\Credential\X509Certificate;

class HttpPost extends AbstractHttpPost
{

    const TEMPLATE_PATH = 'saml-idp/_components/post-binding-submit.twig';

    public function getTemplatePath()
    {
        return static::TEMPLATE_PATH;
    }

    /**
     * @inheritdoc
     */
    public function getProviderByIssuer(Issuer $issuer): ProviderInterface
    {
        $provider = Saml::getInstance()->getProvider()->findByIssuer(
            $issuer
        );
        if(!$provider) {
            throw new InvalidIssuer(
                sprintf("Invalid issuer: %s", $issuer->getValue())
            );
        }
        return $provider;
    }
}