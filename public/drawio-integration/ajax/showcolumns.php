<?php
/*
 -------------------------------------------------------------------------
 Archimap plugin for GLPI
 Copyright (C) 2009-2021 by Eric Feron.
 -------------------------------------------------------------------------

 LICENSE
      
 This file is part of Archimap.

 Archimap is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 at your option any later version.

 Archimap is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Archimap. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */
 
if (!defined('GLPI_ROOT')) 
   include_once ('../../../../../inc/includes.php');
else
   include_once (GLPI_ROOT.'/inc/includes.php');

$DB = new DB;
$tablefields = file_get_contents('php://input');
$tablefields = (is_string($tablefields) && trim($tablefields) !== '') ? json_decode($tablefields) : [];
if (!is_array($tablefields) && !is_object($tablefields)) {
   $tablefields = [];
}
$datas = [];
foreach($tablefields as $id => $criteria) {
	if (!isset($criteria->table)) {
		continue;
	}
	$table = $criteria->table;
	$where = $criteria->where ?? '';
	$query = "SHOW COLUMNS FROM $table";
	if ($where)
		$query .= " WHERE ".$where;
//Toolbox::logInFile("showcolumns", $query."\n");
//echo $query;
	if ($result=$DB->doQuery($query)) {
		while ($data=$DB->fetchAssoc($result)) {
			$datas[$id]=$data;
		}
	}
}
//var_dump($datas);
echo json_encode($datas);
?>
