<?php
/**
 * @copyright DomainNameApi (https://www.domainnameapi.com)
 * @version 1.0.0
 * @author    Bünyamin AKÇAY <bunyamin@bunyam.in>
 * @license   GPL-3.0
 *
 * This source file is subject to the GPL-3.0 License that is bundled
 * with this source code in the file LICENSE
 * 
 * Module documentation is available at https://www.domainnameapi.com
 * Support at support@domainnameapi.com
 */

require_once __DIR__ . "/DomainNameApi/lib/dna.php";

use DomainNameApi\DomainNameAPI_PHPLibrary;

class Registrar_Adapter_DomainNameApi extends Registrar_AdapterAbstract
{
    private $config = array(
        'Username'   => null,
        'Password' => null,
    );

    private const MODULE_VERSION = "1.0.0";
    private const DIR_LOG = "logs";
    private const FILE_LOG = "domainnameapi.log";

    public function __construct($options)
    {
        if (!class_exists('SoapClient')) {
            throw new Registrar_Exception('SOAP functions are not available<br>Please install "php-soap" and check PHP pre-requisites');
        }

        if (isset($options['Username']) && !empty($options['Username'])) {
            $this->config['Username'] = $options['Username'];
            unset($options['Username']);
        } else {
            throw new Registrar_Exception('DomainNameApi Registrar module error.<br>Please update configuration parameter "Username" at "Configuration -> Domain registration"');
        }

        if (isset($options['Password']) && !empty($options['Password'])) {
            $this->config['Password'] = $options['Password'];
            unset($options['Password']);
        } else {
            throw new Registrar_Exception('DomainNameApi Registrar module error.<br>Please update configuration parameter "Password" at "Configuration -> Domain registration"');
        }
        if(isset($options['TestMode']) && !empty($options['TestMode'])) {
            $this->config['TestMode'] = $options['TestMode'];
            unset($options['TestMode']);
        }

        if(isset($options['logAPI']) && !empty($options['logAPI'])) {
            $this->config['logAPI'] = $options['logAPI'];
            unset($options['logAPI']);
        }

        if(isset($options['logFunction']) && !empty($options['logFunction'])) {
            $this->config['logFunction'] = $options['logFunction'];
            unset($options['logFunction']);
        }
    }
    
    /**
     * Return array with configuration
     */
    public static function getConfig()
    {
        return array(
            'label'     =>  'DomainNameApi is an ICANN Accredited Domain Registrar from TURKEY. You will need to open a reseller account in order to use our registrar services. To do so please start the signup process here (https://www.domainnameapi.com/become-a-reseller) or contact our sales team (sales@domainnameapi.com).
            Please note that production and testing platforms are different. If you want to use the test mode, you will need an additional test account for the Operational Testing Environment. Your production account will not work on that environment.',
            'form'  => array(
                'Username' => array('text', array(
                            'label' => 'Username',
                            'description'=> '',
                            'required' => true,
                        ),
                     ),
                'Password' => array('password', array(
                            'label' => 'Password',
                            'description'=> '',
                            'required' => true,
                        ),
                    ),
                'logAPI' => array('radio', array(
                            'label' => 'log API Function',
                            'Description' => '',
                            'required' => true,
                            'multiOptions' => array(
                                true => 'Yes',
                                false => 'No',
                            ),
                        ),
                    ),
                'logFunction' => array('radio', array(
                            'label' => 'log Function',
                            'Description' => '',
                            'required' => true,
                            'multiOptions' => array(
                                true => 'Yes',
                                false => 'No',
                            ),
                        ),
                    ),
            ),
        );
    }


    /**
     * Checks if a domain is available for registration.
     */
    public function isDomainAvailable(Registrar_Domain $domain)
    {        
        $dom = $domain->getSld() . $domain->getTld();
        
        # Request domain availability check
        $api = $this->getDna();
        try {
            $result = $api->CheckAvailability([$domain->getSld()], [ltrim($domain->getTld(), '.')], "1", "create");
        }
        catch(Exception $exception) {
            $this->_log("API call failed", 'ERROR', ['method' => 'CheckAvailability', 'function' => __FUNCTION__, 'domain' => $dom, 'error' => $exception->getMessage()]);
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'CheckAvailability', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if (!empty($result) && isset($result[0])) {
            $response = $result[0];
            
            if($response['Status'] == 'available') {
                return true;
            }
            
            if($response['Status'] == 'available' && isset($response['IsFee']) && $response['IsFee'] == '1') {
                throw new Registrar_Exception("Premium domains cannot be registered.");
            }
        }

        return false;
    }

    /**
     * Checks if a domain can be transferred to the registrar.
     */
    public function isDomaincanBeTransferred(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();

        # Request domain availability check
        $api = $this->getDna();
        try {
            $result = $api->CheckAvailability([$domain->getSld()], [ltrim($domain->getTld(), '.')], "1", "create");
        }
        catch(Exception $exception) {
            $this->_log("API call failed", 'ERROR', ['method' => 'CheckAvailability', 'function' => __FUNCTION__, 'domain' => $dom, 'error' => $exception->getMessage()]);
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'CheckAvailability', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if (!empty($result) && isset($result[0])) {
            $response = $result[0];
            
            if($response['Status'] == 'not available') {
                return true;
            }
        }

        return false;
    }

    /**
     * Modifies the name servers for a domain.
     */
    public function modifyNs(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Prepare nameservers
        $nsList = [];
        if ($domain->getNs1()) $nsList[] = $domain->getNs1();
        if ($domain->getNs2()) $nsList[] = $domain->getNs2();
        if ($domain->getNs3()) $nsList[] = $domain->getNs3();
        if ($domain->getNs4()) $nsList[] = $domain->getNs4();
        
        # Request domain update
        $api = $this->getDna();
        try {
            $response = $api->ModifyNameServer($dom, $nsList);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'ModifyNameServer', 'function' => __FUNCTION__, 'domain' => $dom, 'nameservers' => $nsList]);
        }

        # Process result
        if ($response["result"] != "OK") {
            throw new Registrar_Exception($response["error"]["Message"] . " - " . $response["error"]["Details"]);
        }

        return true;
    }

    /**
     * Modifies the contact information for a domain.
     */
    public function modifyContact(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);
        
        # Prepare contact information
        $contacts = [
            "Administrative" => $this->_prepareContactInfo($domain),
            "Billing" => $this->_prepareContactInfo($domain),
            "Technical" => $this->_prepareContactInfo($domain),
            "Registrant" => $this->_prepareContactInfo($domain),
        ];

        # Request contact updates
        $api = $this->getDna();
        try {
            $response = $api->SaveContacts($dom, $contacts);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'SaveContacts', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if ($response["result"] != "OK") {
            throw new Registrar_Exception($response["error"]["Message"] . " - " . $response["error"]["Details"]);
        }

        return true;
    }

    /**
     * Transfers a domain to the registrar.
     */
    public function transferDomain(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Check transfer status   
        if(!$this->isDomaincanBeTransferred($domain)){
            $this->_log("Transfer failed", 'ERROR', ['function' => __FUNCTION__, 'domain' => $dom, 'reason' => 'Domain is not transferrable']);
            throw new Registrar_Exception('Domain is not transferrable');
        }

        # Request domain transfer
        $epp = $domain->getEpp() ?? "";
        $period = $domain->getRegistrationPeriod() ?? 1;
        
        $api = $this->getDna();
        try {
            $response = $api->Transfer($dom, $epp, $period);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'Transfer', 'function' => __FUNCTION__, 'domain' => $dom, 'period' => $period]);
        }

        # Process result
        if ($response["result"] != "OK") {
            throw new Registrar_Exception($response["error"]["Message"] . " - " . $response["error"]["Details"]);
        }

        return true;
    }

    /**
     * Returns the details of a registered domain.
     */
    public function getDomainDetails(Registrar_Domain $d)
    {   
        $dom = $d->getSld() . $d->getTld();

        # Get domain info
        $api = $this->getDna();
        try {
            $domainInfo = $api->GetDetails($dom);
        }
        catch(Exception $exception) {
            $this->_log("API call failed", 'ERROR', ['method' => 'GetDetails', 'function' => __FUNCTION__, 'domain' => $dom, 'error' => $exception->getMessage()]);
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'GetDetails', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if ($domainInfo["result"] != "OK") {
            throw new Registrar_Exception($domainInfo["error"]["Message"] . " - " . $domainInfo["error"]["Details"]);
        }

        $data = $domainInfo["data"];

        # Set domain details
        if (isset($data["AuthCode"])) {
            $d->setEpp($data["AuthCode"]);
        }

        if (isset($data["LockStatus"])) {
            $d->setLocked($data["LockStatus"] == "true");
        }

        if (isset($data["NameServers"])) {
            $ns = $data["NameServers"];
            if (is_array($ns)) {
                foreach($ns as $key => $nameserver) {
                    $fct = "setNs".($key+1);
                    if (method_exists($d, $fct)) {
                        $d->$fct($nameserver);
                    }
                }
            } else {
                $d->setNs1($ns);
            }
        }

        # Set contact information
        $c = $d->getContactRegistrar();
        if (isset($data["Contacts"]["Registrant"])) {
            $contact = $data["Contacts"]["Registrant"];
            $c->setFirstName($contact["FirstName"] ?? "")
              ->setLastName($contact["LastName"] ?? "")
              ->setEmail($contact["EMail"] ?? "")
              ->setCity($contact["City"] ?? "")
              ->setZip($contact["ZipCode"] ?? "")
              ->setCountry($contact["Country"] ?? "")
              ->setState($contact["State"] ?? "")
              ->setTel($contact["Phone"] ?? "")
              ->setTelCc($contact["PhoneCountryCode"] ?? "")
              ->setAddress1($contact["AddressLine1"] ?? "")
              ->setAddress2($contact["AddressLine2"] ?? "");
        }

        $d->setContactRegistrar($c);
        
        $this->_log("Function completed", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);
        return $d;
    }

    /**
     * Returns the domain transfer code (also known as the EPP code or auth code) for a domain.
     */
    public function getEpp(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Get domain details to retrieve EPP code
        $api = $this->getDna();
        try {
            $result = $api->GetDetails($dom);
        }
        catch(Exception $exception) {
            $this->_log("API call failed", 'ERROR', ['method' => 'GetDetails', 'function' => __FUNCTION__, 'domain' => $dom, 'error' => $exception->getMessage()]);
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'GetDetails', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        if ($result["result"] == "OK" && isset($result["data"]["AuthCode"])) {
            return $result["data"]["AuthCode"];
        }

        throw new Registrar_Exception("EPP code could not be retrieved from registrar");
    }

    /**
     * Registers a domain with the registrar.
     */
    public function registerDomain(Registrar_Domain $domain)
    {   
        $dom = $domain->getSld() . $domain->getTld();

        # Check domain availability   
        if(!$this->isDomainAvailable($domain)){
            $this->_log("Registration failed", 'ERROR', ['function' => __FUNCTION__, 'domain' => $dom, 'reason' => 'Domain is not available for registration']);
            throw new Registrar_Exception('Domain is not available for registration');
        }

        # Prepare contact information
        $contacts = [
            "Administrative" => $this->_prepareContactInfo($domain),
            "Billing" => $this->_prepareContactInfo($domain),
            "Technical" => $this->_prepareContactInfo($domain),
            "Registrant" => $this->_prepareContactInfo($domain),
        ];

        # Prepare nameservers
        $nameServers = [];
        if ($domain->getNs1()) $nameServers[] = $domain->getNs1();
        if ($domain->getNs2()) $nameServers[] = $domain->getNs2();
        if ($domain->getNs3()) $nameServers[] = $domain->getNs3();
        if ($domain->getNs4()) $nameServers[] = $domain->getNs4();

        # Prepare additional attributes for .tr domains
        $additionalAttributes = [];
        if ($this->_isTrTLD($dom)) {
            $additionalAttributes = $this->_prepareTrContact($domain);
        }

        # Request domain registration
        $period = $domain->getRegistrationPeriod() ?? 1;
        $privacyProtection = $domain->getPrivacyEnabled() ?? false;
        
        $api = $this->getDna();
        try {
            $response = $api->RegisterWithContactInfo(
                $dom,
                $period,
                $contacts,
                $nameServers,
                false, // theft protection lock
                $privacyProtection,
                $additionalAttributes
            );
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'RegisterWithContactInfo', 'function' => __FUNCTION__, 'domain' => $dom, 'period' => $period]);
        }

        # Process result
        if ($response["result"] != "OK") {
            throw new Registrar_Exception($response["error"]["Message"] . " - " . $response["error"]["Details"]);
        }

        return true;
    }

    /**
     * Renews a domain registration with the registrar.
     */
    public function renewDomain(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Request domain renewal
        $years = $domain->getRegistrationPeriod() ?? 1;
        $api = $this->getDna();
        try {
            $result = $api->Renew($dom, $years);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'Renew', 'function' => __FUNCTION__, 'domain' => $dom, 'duration' => $years]);
        }

        # Process result
        if ($result["result"] != "OK") {
            throw new Registrar_Exception($result["error"]["Message"] . " - " . $result["error"]["Details"]);
        }

        return true;
    }

    /**
     * Deletes a domain from the registrar.
     */
    public function deleteDomain(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Domain deletion is not supported by DomainNameApi
        throw new Registrar_Exception("Domain deletion is not supported by DomainNameApi");
    }

    /**
     * Enables privacy protection for a domain.
     */
    public function enablePrivacyProtection(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Request domain update
        $api = $this->getDna();
        try {
            $result = $api->ModifyPrivacyProtectionStatus($dom, true, "Owner's request");
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'ModifyPrivacyProtectionStatus', 'function' => __FUNCTION__, 'domain' => $dom, 'status' => true]);
        }

        # Process result
        if ($result["result"] != "OK") {
            throw new Registrar_Exception($result["error"]["Message"] . " - " . $result["error"]["Details"]);
        }

        return true;
    }

    /**
     * Disables privacy protection for a domain.
     */
    public function disablePrivacyProtection(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Request domain update
        $api = $this->getDna();
        try {
            $result = $api->ModifyPrivacyProtectionStatus($dom, false, "Owner's request");
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'ModifyPrivacyProtectionStatus', 'function' => __FUNCTION__, 'domain' => $dom, 'status' => false]);
        }

        # Process result
        if ($result["result"] != "OK") {
            throw new Registrar_Exception($result["error"]["Message"] . " - " . $result["error"]["Details"]);
        }

        return true;
    }

    /**
     * Locks a domain to prevent transfer to another registrar.
     */
    public function lock(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Request domain update
        $api = $this->getDna();
        try {
            $result = $api->EnableTheftProtectionLock($dom);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'EnableTheftProtectionLock', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if ($result["result"] != "OK") {
            throw new Registrar_Exception($result["error"]["Message"] . " - " . $result["error"]["Details"]);
        }

        return true;
    }

    /**
     * Unlocks a domain to allow transfer to another registrar.
     */
    public function unlock(Registrar_Domain $domain)
    {
        $dom = $domain->getSld() . $domain->getTld();
        $this->_log("Function called", 'FUNCTION', ['function' => __FUNCTION__, 'domain' => $dom]);

        # Request domain update
        $api = $this->getDna();
        try {
            $result = $api->DisableTheftProtectionLock($dom);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }
        finally {
            $this->_log("API call completed", 'API', ['method' => 'DisableTheftProtectionLock', 'function' => __FUNCTION__, 'domain' => $dom]);
        }

        # Process result
        if ($result["result"] != "OK") {
            throw new Registrar_Exception($result["error"]["Message"] . " - " . $result["error"]["Details"]);
        }

        return true;
    }

    /**
     * Get the registrar API
     */
    /**
     * Get the registrar API
     */
    private function getDna()
    {
        $username = $this->config["Username"];
        $password = $this->config["Password"];
        $testmode = $this->_testMode ?? false;

        try {
            $api = new DomainNameAPI_PHPLibrary($username, $password, $testmode);
        }
        catch(Exception $exception) {
            throw new Registrar_Exception($exception->getMessage());
        }

        return $api;
    }

    /**
     * Create a contact object for the Registrar API
     */
    private function _prepareContactInfo(Registrar_Domain $domain)
    {
        $c = $domain->getContactRegistrar();
        
        return [
            "FirstName"        => mb_convert_encoding($c->getFirstName(), "UTF-8", "auto"),
            "LastName"         => mb_convert_encoding($c->getLastName(), "UTF-8", "auto"),
            "Company"          => mb_convert_encoding($c->getCompany(), "UTF-8", "auto"),
            "EMail"            => mb_convert_encoding($c->getEmail(), "UTF-8", "auto"),
            "AddressLine1"     => mb_convert_encoding($c->getAddress1(), "UTF-8", "auto"),
            "AddressLine2"     => mb_convert_encoding($c->getAddress2(), "UTF-8", "auto"),
            "State"            => mb_convert_encoding($c->getState(), "UTF-8", "auto"),
            "City"             => mb_convert_encoding($c->getCity(), "UTF-8", "auto"),
            "Country"          => mb_convert_encoding($c->getCountry(), "UTF-8", "auto"),
            "Phone"            => mb_convert_encoding($c->getTel(), "UTF-8", "auto"),
            "PhoneCountryCode" => mb_convert_encoding($c->getTelCc(), "UTF-8", "auto"),
            "Type"             => mb_convert_encoding("Contact", "UTF-8", "auto"),
            "ZipCode"          => mb_convert_encoding($c->getZip(), "UTF-8", "auto"),
        ];
    }

    /**
     * Prepare Turkish domain contact information
     */
    private function _prepareTrContact(Registrar_Domain $domain)
    {
        $c = $domain->getContactRegistrar();
        
        $tr_domain_fields = [
            'TRABISDOMAINCATEGORY' => strlen($c->getCompany()) > 0 ? '0' : '1',
            'TRABISNAMESURNAME'    => $c->getFirstName() . ' ' . $c->getLastName(),
            'TRABISCOUNTRYID'      => 215,
            'TRABISCITYID'        => 34,
            'TRABISCOUNTRYNAME'    => $c->getCountry(),
            'TRABISCITYNAME'       => $c->getCity(),
        ];

        if (strlen($c->getCompany()) > 0) {
            $tr_domain_fields['TRABISORGANIZATION'] = $c->getCompany();
            $tr_domain_fields['TRABISTAXOFFICE']    = 'Kadikoy V.D.';
            $tr_domain_fields['TRABISTAXNUMBER']    = '1111111111';
        } else {
            $tr_domain_fields['TRABISCITIZIENID']   = '11111111111';
        }

        return $tr_domain_fields;
    }

    /**
     * Check if domain is Turkish TLD
     */
    private function _isTrTLD($domain)
    {
        return strpos($domain, '.tr') !== false;
    }

    /**
     * Comprehensive logging function
     */
    private function _log($message, $type = 'INFO', $data = [])
    {
        // Check if logging is enabled
        if (!$this->config['logAPI'] && !$this->config['logFunction']) {
            return;
        }

        $date = date('Y-m-d H:i:s');
        $logMessage = "[$date] [$type] $message";

        // Add additional data if provided
        if (!empty($data)) {
            $logMessage .= " - " . json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        $logMessage .= PHP_EOL;

        // Create log directory if it doesn't exist
        $logDir = __DIR__ . '/DomainNameApi/' . self::DIR_LOG;
        if (!file_exists($logDir)) {
            mkdir($logDir, 0755, true);
        }

        // Write to log file
        $logFile = $logDir . '/' . self::FILE_LOG;
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
}
