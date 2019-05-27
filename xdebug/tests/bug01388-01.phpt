--TEST--
Test for bug #1388: Resolved Breakpoint: attributes shown
--SKIPIF--
<?php if (getenv("SKIP_DBGP_TESTS")) { exit("skip Excluding DBGp tests"); } ?>
--FILE--
<?php
require 'dbgp/dbgpclient.php';
$filename = dirname(__FILE__) . '/bug01388-01.inc';

$commands = array(
	'step_into',
	'feature_get -n resolved_breakpoints',
	'breakpoint_set -t line -n 4',
	'breakpoint_list',
	'feature_set -n resolved_breakpoints -v 1',
	'feature_get -n resolved_breakpoints',
	'breakpoint_list',
	'breakpoint_set -t line -n 4',
	'breakpoint_list',
	'detach',
);

dbgpRunFile( $filename, $commands );
?>
--EXPECT--
<?xml version="1.0" encoding="iso-8859-1"?>
<init xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" fileuri="file://bug01388-01.inc" language="PHP" xdebug:language_version="" protocol_version="1.0" appid="" idekey=""><engine version=""><![CDATA[Xdebug]]></engine><author><![CDATA[Derick Rethans]]></author><url><![CDATA[https://xdebug.org]]></url><copyright><![CDATA[Copyright (c) 2002-2099 by Derick Rethans]]></copyright></init>

-> step_into -i 1
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="step_into" transaction_id="1" status="break" reason="ok"><xdebug:message filename="file://bug01388-01.inc" lineno="2"></xdebug:message></response>

-> feature_get -i 2 -n resolved_breakpoints
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="feature_get" transaction_id="2" feature_name="resolved_breakpoints" supported="1"><![CDATA[0]]></response>

-> breakpoint_set -i 3 -t line -n 4
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="3" id=""></response>

-> breakpoint_list -i 4
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_list" transaction_id="4"><breakpoint type="line" filename="file://bug01388-01.inc" lineno="4" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></response>

-> feature_set -i 5 -n resolved_breakpoints -v 1
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="feature_set" transaction_id="5" feature="resolved_breakpoints" success="1"></response>

-> feature_get -i 6 -n resolved_breakpoints
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="feature_get" transaction_id="6" feature_name="resolved_breakpoints" supported="1"><![CDATA[1]]></response>

-> breakpoint_list -i 7
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_list" transaction_id="7"><breakpoint type="line" resolved="unresolved" filename="file://bug01388-01.inc" lineno="4" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></response>

-> breakpoint_set -i 8 -t line -n 4
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_set" transaction_id="8" id="" resolved="unresolved"></response>

-> breakpoint_list -i 9
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="breakpoint_list" transaction_id="9"><breakpoint type="line" resolved="unresolved" filename="file://bug01388-01.inc" lineno="4" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint><breakpoint type="line" resolved="unresolved" filename="file://bug01388-01.inc" lineno="4" state="enabled" hit_count="0" hit_value="0" id=""></breakpoint></response>

-> detach -i 10
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="https://xdebug.org/dbgp/xdebug" command="detach" transaction_id="10" status="stopping" reason="ok"></response>
