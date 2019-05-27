<?php
$m = new \MongoDB\Driver\Manager( "mongodb+srv://ci-writer:{$_ENV['CIWRITEPASSWORD']}@xdebugci-qftmo.mongodb.net/test?retryWrites=true" );

/* Create RUN ID */
$runId =     (new \DateTimeImmutable())->format( "Y-m-d-H-i-s" );
$timeStamp = time();
$abbrev =    trim( `git describe --tags` );

echo $abbrev, "\n";

/* Read all JUNIT logs */
foreach ( glob( '/tmp/ptester/junit/*.xml' ) as $file )
{
	preg_match( '@junit/((.*?)(-32bit)?(-zts)?)\.xml@', $file, $matches );

	$config = $matches[1];
	$version = $matches[2];
	$_32bit = $matches[3] == '-32bit';
	$zts = $matches[4] == '-zts';

	$xml = SimpleXML_load_string( file_get_contents( $file ) );
	
	$status = [
		'run' => $runId,
		'ts' => $timeStamp,
		'ref' => trim( `git rev-parse --short --verify HEAD` ),
		'abbrev' => $abbrev,
		'cfg' => [
			'config' => $config,
			'version' => $version,
			'zts' => $zts,
			'32bit' => $_32bit,
		],
	];

	echo "Running for: _id' => {$runId}@{$config}\n";

	if ( isset( $xml['buildFailed'] ) )
	{
		$status['buildSuccess'] = false;
		$status['buildLog'] = file_get_contents( (string) $xml['buildLogFile' ] );
	}
	else
	{
		$status['buildSuccess'] = true;
		$status['stats'] = [
			'tests' => (int) $xml['tests'],
			'failures' => (int) $xml['failures'],
			'errors' => (int) $xml['errors'],
			'skip' => (int) $xml['skip'],
			'time' => (double) $xml['time'],
		];
	}

	if ( (int) $xml['failures'] != 0 )
	{
		foreach ( $xml as $testsuite )
		{
			foreach ( $testsuite->testcase as $testcase )
			{
				if ( isset ( $testcase->failure['type'] ) )
				{
					preg_match( "@PHP\.tests\.(.*)\.phpt@", (string) $testcase['classname'], $matches );
					$status['failures'][] = [
						'file' => $matches[1],
						'desc' => (string) $testcase['name'],
						'reason' => (string) $testcase->failure,
					];
				}
			}
		}
	}

	$bulk = new \MongoDB\Driver\BulkWrite;
	$bulk->update(
		[ '_id' => $runId . '@' . $config ],
		$status,
		[ 'upsert' => true ]
	);

	$m->executeBulkWrite( 'ci.run', $bulk );
}
