<?php 

// release on Kloxo 6.1.7
// by mustafa.ramadhan@lxcenter.org
//
// Fixed PHP Fatal error on failing objects
// Fixed missing image directory
// DT01032014
//
include_once "htmllib/lib/include.php";

// Need this for loading objects outside a class
initProgram('admin');

$list = parse_opt($argv);

$select = (isset($list['select'])) ? $list['select'] : 'all';

setFixUserlogo($select);

/* ****** BEGIN - setFixUserlogo ***** */

function setFixUserlogo($select)
{
	global $gbl, $sgbl, $login, $ghtml;

	log_cleanup("Fix user logo");

	if (file_exists("/usr/local/lxlabs/kloxo/file/user-logo.png")) {
		system("cp -rf /usr/local/lxlabs/kloxo/file/user-logo.png /home/kloxo/httpd/user-logo.png");
		log_cleanup("- User logo moved from -> /usr/local/lxlabs/kloxo/file/user-logo.png");
		log_cleanup("- User logo moved to -> /home/kloxo/httpd/user-logo.png");
	}
	else {
		log_cleanup("- Cleaned user logo source at /usr/local/lxlabs/kloxo/file/user-logo.png");
		exit;
	}

	if ($select === 'defaults') {
		setFixUserlogoDefaultPages();
	}
	else if ($select === 'domains') {
		setFixUserlogoDomainPages();
	}
	else if ($select === 'all') {
		setFixUserlogoDefaultPages();
		setFixUserlogoDomainPages();
	}
	else {
		log_cleanup("- Wrong --select= entry");
	}
}

function setFixUserlogoDefaultPages()
{
	$list = array('cp', 'default', 'disable', 'webmail');
	
	foreach($list as $k => $l) {
		system("cp -rf /home/kloxo/httpd/user-logo.png /home/kloxo/httpd/{$l}/images/logo.png");
		log_cleanup("- User logo for default pages moved to -> /home/kloxo/httpd/{$l}/images/logo.png");
	}
	
	system("cp -rf /home/kloxo/httpd/user-logo.png /usr/local/lxlabs/kloxo/httpdocs/login/images/logo.png");
	log_cleanup("- User logo moved to -> /usr/local/lxlabs/kloxo/httpdocs/login/images/logo.png");
}

function setFixUserlogoDomainPages()
{
	global $gbl, $sgbl, $login, $ghtml;
	
	$login->loadAllObjects('client');
	$list = $login->getList('client');
	
	foreach($list as $c) {
		$clname = $c->getPathFromName('nname');
		$cdir = "/home/{$clname}";
		$dlist = $c->getList('domaina');

		foreach((array) $dlist as $l) {
			$web = $l->nname;

            // If there is no images directory so need to create that first
            if (!lxfile_exists("{$cdir}/{$web}/images"))
            {
                lxfile_mkdir("{$cdir}/{$web}/images");
            }

			system("cp -rf /home/kloxo/httpd/user-logo.png {$cdir}/{$web}/images/logo.png");
			log_cleanup("- User logo for domain pages moved to -> {$cdir}/{$web}/images/logo.png");
		}
	}
}

/* ****** END - setFixUserlogo ***** */

