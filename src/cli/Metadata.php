<?php
/**
 * Created by PhpStorm.
 * User: dsmrt
 * Date: 1/12/18
 * Time: 11:59 PM
 */

namespace flipbox\saml\idp\cli;


use craft\helpers\Console;
use flipbox\keychain\keypair\traits\OpenSSL;
use flipbox\keychain\keypair\traits\OpenSSLCliUtil;
use flipbox\keychain\records\KeyChainRecord;
use flipbox\saml\core\cli\AbstractMetadata;
use flipbox\saml\core\records\ProviderInterface;
use flipbox\saml\idp\models\Provider;
use flipbox\saml\idp\records\ProviderRecord;
use flipbox\saml\idp\Saml;
use yii\console\Controller;
use yii\console\ExitCode;

class Metadata extends AbstractMetadata
{
    use OpenSSL, OpenSSLCliUtil;

    /**
     * @var bool $force
     * Force save the metadata. If one already exists, it'll be overwritten.
     */
    public $force;

    /**
     * @var int
     * Set the key pair id that you want to use to associate to this record
     */
    public $keyPairId;

    /**
     * @var bool
     * Create a new key pair for this server to use to encrypt and sign messages to the remote server
     */
    public $createKeyPair = true;

    public function options($actionID)
    {
        return array_merge(
            [
                'force',
                'keyPairId',
                'createKeyPair',
            ],
            parent::options($actionID)
        );
    }

    public function optionAliases()
    {
        return array_merge(
            [
                'f' => 'force',
            ],
            parent::optionAliases()
        );
    }

    /**
     * @param array $config
     * @return ProviderInterface
     */
    protected function newProviderRecord(array $config): ProviderInterface
    {
        return new ProviderRecord($config);
    }

}