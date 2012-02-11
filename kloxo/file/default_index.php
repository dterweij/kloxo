<?php
/*
 *  Kloxo, Hosting Control Panel
 *
 *  Copyright (C) 2000-2009	LxLabs
 *  Copyright (C) 2009-2011	LxCenter
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// This is the Login page at http(s)://domain.ext:777[7-8]/login/
// Customizing is allowed with the following files without to mess with the shipped ones:
// - custom-index.php (use a own page layout)
// - custom-inc.php (use a own Login Dialog)

// Back to Base
chdir("..");

include_once('htmllib/lib/displayinclude.php');

// Issue #397 - For Kloxo 6.2.x
require_once('l18n/l18n.php');

	// Use the default shipped index.php if the custom one does not exist
	if (!file_exists('login/custom-index.php')) {

	if (file_exists("login/custom-inc.php")) {
		// Use a custom-inc.php when exists
		$incfile = 'login/custom-inc.php';
	}
	else {
		// Use the default shipped inc.php
		$incfile = 'login/inc.php';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php print(_('Kloxo Control Panel')); ?></title>
<meta http-equiv="Content-Language" content="en-us"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href='/htmllib/css/common.css' rel='stylesheet' type='text/css'/>
<link href='/htmllib/css/login.css' rel='stylesheet' type='text/css'/>
</head>
<body>

<table class="header">
	<tr>
		<td valign="top" width="100%"><img class="logo" src="images/logo.png" height="75" alt="hosting-logo"/></td>
		<td>
			<table class="content">
				<tr>
					<td><a href="http://lxcenter.org/" title="Go to LxCenter website"><img class="logo" src="images/lxcenter.png" alt="lxcenter-logo" width="120" height="35"/></a></td>
				</tr>
				<tr>
					<td><a href="http://lxcenter.org/software/kloxo/" title="Go to Kloxo website"><img class="logo" src="images/kloxo.png" alt="kloxo-logo" width="120" height="27"/></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#000000">&nbsp;</td>
	</tr>
</table>
<table class="content">
	<tr>
		<td width="50">&nbsp;</td>
		<td valign="top">
			<?php include_once("$incfile"); ?>
		</td>
		<td width="280" valign="top"><img src="images/disableskeletonbg.gif" alt='Logo'/></td>
	</tr>
</table>

</body>

</html>

<?php
	}
	else {
		// use user-define index.php -- no override when kloxo update
		include_once('login/custom-index.php');
	}
?>
