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

// Back to Base
chdir("..");

init_language();

$cgi_clientname = $ghtml->frm_clientname; 
$cgi_class = $ghtml->frm_class; 
$cgi_password = $ghtml->frm_password;
$cgi_forgotpwd = $ghtml->frm_forgotpwd; 
$cgi_email = $ghtml->frm_email;

$cgi_classname = 'client';
if ($cgi_class) {
	$cgi_classname = $cgi_classname;
}
ob_start();

// Load the required javascripts
$ghtml->print_jscript_source('/htmllib/js/login.js');
$ghtml->print_jscript_source('/htmllib/js/preop.js');
$ghtml->print_jscript_source('/htmllib/js/lxa.js');

// Load the Login Dialog
include_once('login/login_block.php');
