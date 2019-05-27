--TEST--
Test for bug #1388: Resolved Breakpoint with conditional
--SKIPIF--
<?php if (getenv("SKIP_DBGP_TESTS")) { exit("skip Excluding DBGp tests"); } ?>
--INI--
xdebug.collect_params=4
xdebug.collect_return=1
xdebug.collect_assignments=0
--FILE--
<?php
require 'dbgp/dbgpclient.php';
$filename = realpath( dirname(__FILE__) . '/bug01388-13.inc' );

$commands = array(
	'feature_set -n resolved_breakpoints -v 1',
	"breakpoint_set -n 7 -f file://{$filename} -t conditional -- JG1vZHVsZSA9PSB2aWV3cw==",
	'run',
	'context_get',
	'detach'
);

dbgpRunFile( $filename, $commands, [ 'track_errors' => 'Off' ] );
?>
--EXPECT--
<?xml version="1.0" encoding="iso-8859-1"?>
<init xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" fileuri="file://bug01388-13.inc" language="PHP" xdebug:language_version="" protocol_version="1.0" appid="" idekey=""><engine version=""><![CDATA[Xdebug]]></engine><author><![CDATA[Derick Rethans]]></author><url><![CDATA[https://xdebug.org]]></url><copyright><![CDATA[Copyright (c) 2002-2099 by Derick Rethans]]></copyright></init>

-> feature_set -i 1 -n resolved_breakpoints -v 1
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="feature_set" transaction_id="1" feature="resolved_breakpoints" success="1"></response>

-> breakpoint_set -i 2 -n 7 -f file://bug01388-13.inc -t conditional -- JG1vZHVsZSA9PSB2aWV3cw==
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="2" id="" resolved="unresolved"></response>

-> run -i 3
<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="conditional" resolved="resolved" filename="file://bug01388-13.inc" lineno="10" state="enabled" hit_count="0" hit_value="0" id=""><expression encoding="base64"><![CDATA[JG1vZHVsZSA9PSB2aWV3cw==]]></expression></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<notify xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" name="breakpoint_resolved"><breakpoint type="conditional" resolved="resolved" filename="file://bug01388-13.inc" lineno="7" state="enabled" hit_count="0" hit_value="0" id=""><expression encoding="base64"><![CDATA[JG1vZHVsZSA9PSB2aWV3cw==]]></expression></breakpoint></notify>

<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="run" transaction_id="3" status="break" reason="ok"><xdebug:message filename="file://bug01388-13.inc" lineno="7"></xdebug:message></response>

-> context_get -i 4
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="context_get" transaction_id="4" context="0"><property name="$module" fullname="$module" type="string" size="5" encoding="base64"><![CDATA[dmlld3M=]]></property></response>

-> detach -i 5
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="detach" transaction_id="5" status="stopping" reason="ok"></response>
