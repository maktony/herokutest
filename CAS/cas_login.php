<?php
	// Load the CAS lib
	require_once './CAS.php';

	// Uncomment to enable debugging
	phpCAS::setDebug();

	// Enable verbose error messages. Disable in production!
	phpCAS::setVerbose(true);

	// Initialize phpCAS
	phpCAS::client(CAS_VERSION_3_0, 'cas.ust.hk', 443, 'cas');

	// For production use set the CA certificate that is the issuer of the cert
	// on the CAS server and uncomment the line below
	// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

	// For quick testing you can disable SSL validation of the CAS server.
	// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
	// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
	//phpCAS::setNoCasServerValidation();
	
	phpCAS::setCasServerCACert('./ca-bundle.crt');

	// force CAS authentication
	$auth = phpCAS::forceAuthentication();

	// at this step, the user has been authenticated by the CAS server
	// and the user's login name can be read with phpCAS::getUser().

	// logout if desired
	if (isset($_REQUEST['logout'])) {
		phpCAS::logout();
	}

	if(isset($_GET['services'])){
		header("Location: " . $_GET['services']);
	}
	else{
		header("Location: https://facultyprofiles.ust.hk/facultylisting.php");
	}
	
?>