<?php 

include_once "htmllib/lib/include.php"; 

log_cleanup("Fixing Web server config files (Can take a long time to finish)");

initProgram('admin');

$list = parse_opt($argv);

$server = (isset($list['server'])) ? $list['server'] : 'localhost';
$client = (isset($list['client'])) ? $list['client'] : null;

log_cleanup("- Load Client Objects");
$login->loadAllObjects('client');

log_cleanup("- Load Client List");
$list = $login->getList('client'); // Lot of clients means a long loading time!


$prevsyncserver = '';
$currsyncserver = '';

$ClientCount = count($list);
log_cleanup("Number of clients to process: $ClientCount");

log_cleanup("- Start...");
foreach($list as $c) {

	if ($client) {
		$ca = explode(",", $client);
		if (!in_array($c->nname, $ca)) { continue; }
		$server = 'all';
	}

	if ($server !== 'all') {
		$sa = explode(",", $server);
		if (!in_array($c->syncserver, $sa)) { continue; }
	}

	$dlist = $c->getList('domaina');

	foreach((array) $dlist as $l) {
		$web = $l->getObject('web');

		$currsyncserver = $web->syncserver;

		if ($prevsyncserver !== $currsyncserver) {
			$web->setUpdateSubaction('static_config_update');

// This kind of info nobody will understand what it is.. so disable this.
//			log_cleanup("- inside static (defaults/webmail) directory at '{$currsyncserver}'");

			$prevsyncserver = $currsyncserver;
		}

        // Do the action
		$web->setUpdateSubaction('full_update');
		$web->was();

		log_cleanup("- $ClientCount - '{$web->nname}' ('{$c->nname}') at '{$web->syncserver}'");
        $ClientCount = $ClientCount - 1;
	}
}

log_cleanup("- Ready...");