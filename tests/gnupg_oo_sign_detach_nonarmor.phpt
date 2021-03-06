--TEST--n
sign a text with mode SIG_MODE_DETACH and without armored output
--SKIPIF--
<?php if(!class_exists("gnupg")) die("skip"); ?>
--FILE--
<?php
require_once dirname(__FILE__) . "/vars.inc";
gnupg_test_import();

$gpg = new gnupg();
$gpg->seterrormode(gnupg::ERROR_WARNING);
$gpg->setarmor(0);
$gpg->setsignmode(gnupg::SIG_MODE_DETACH);
$gpg->addsignkey($fingerprint, $passphrase);
$ret = $gpg->sign($plaintext);

$gpg = NULL;

$gpg = new gnupg();
$tmp = false;
$ret = $gpg->verify($plaintext, $ret);

var_dump($ret);
var_dump($plaintext);
?>
--EXPECTF--
array(1) {
  [0]=>
  array(5) {
    ["fingerprint"]=>
    string(40) "64DF06E42FCF2094590CDEEE2E96F141B3DD2B2E"
    ["validity"]=>
    int(0)
    ["timestamp"]=>
    int(%d)
    ["status"]=>
    int(0)
    ["summary"]=>
    int(0)
  }
}
string(7) "foo bar"
