<?php
/*
 -------------------------------------------------------------------------
 Archimap plugin for GLPI
 Copyright (C) 2009-2018 by Eric Feron.
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
define('PLUGIN_ARCHIMAP_VERSION', '3.3.14.1');

// Minimal GLPI version, inclusive
define('PLUGIN_ARCHIMAP_MIN_GLPI', '10.0.0');
// Maximum GLPI version, exclusive
define('PLUGIN_ARCHIMAP_MAX_GLPI', '11.0.99');

function plugin_archimapplus_legacy_autoload($classname) {
   if (!preg_match('/^PluginArchimap([A-Z]\\w+)$/', $classname, $matches)) {
      return;
   }

   $legacy_path = __DIR__.'/inc/'.strtolower($matches[1]).'.class.php';
   if (file_exists($legacy_path)) {
      include_once $legacy_path;
   }
}

$autoloaders = spl_autoload_functions();
if ($autoloaders === false || !in_array('plugin_archimapplus_legacy_autoload', $autoloaders, true)) {
   spl_autoload_register('plugin_archimapplus_legacy_autoload');
}

// Init the hooks of the plugins -Needed
function plugin_init_archimapplus() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['archimapplus'] = true;
   $PLUGIN_HOOKS['change_profile']['archimapplus'] = array('PluginArchimapProfile', 'initProfile');
   $PLUGIN_HOOKS['assign_to_ticket']['archimapplus'] = true;
   
   //$PLUGIN_HOOKS['assign_to_ticket_dropdown']['archimapplus'] = true;
   //$PLUGIN_HOOKS['assign_to_ticket_itemtype']['archimapplus'] = array('PluginArchimapGraph_Item');
   
   Plugin::registerClass('PluginArchimapGraph', array(
//         'linkgroup_tech_types'   => true,
//         'linkuser_tech_types'    => true,
         'document_types'         => true,
         'ticket_types'           => true,
         'helpdesk_visible_types' => true//,
//         'addtabon'               => 'Supplier'
   ));
   Plugin::registerClass('PluginArchimapProfile',
                         array('addtabon' => 'Profile'));
                         
   //if glpi is loaded
   if (Session::getLoginUserID()) {

      $plugin = new Plugin();
      // link to fields plugin
      if ($plugin->isActivated('fields')
      && Session::haveRight("plugin_archimap", READ))
      {
         $PLUGIN_HOOKS['plugin_fields']['archimapplus'] = 'PluginArchimapGraph';
      }

      if (Session::haveRight("plugin_archimap", READ)
          || Session::haveRight("config", UPDATE)) {
         $PLUGIN_HOOKS['config_page']['archimapplus']        = 'front/config.php';
      }
   }

   // Add other plugin associations
   if (class_exists('PluginWebapplicationsWebapplication')
	   && class_exists('PluginArchiswSwcomponent'))
		PluginArchiswSwcomponent::registerType('PluginWebapplicationsWebapplication');

   if (Session::getLoginUserID()) {

      $plugin = new Plugin();
      if (Session::haveRight("plugin_archimap", READ)) {

         $PLUGIN_HOOKS['menu_toadd']['archimapplus']['assets'] = 'PluginArchimapMenu';
      }

      if (Session::haveRight("plugin_archimap_configuration", READ)) {

         $PLUGIN_HOOKS['menu_toadd']['archimapplus']['config'] = 'PluginArchimapConfigMenu';
      }

      if (Session::haveRight("plugin_archimap", UPDATE)) {
         $PLUGIN_HOOKS['use_massive_action']['archimapplus']=1;
      }

      if (class_exists('PluginArchimapGraph_Item')) { // only if plugin activated
         $PLUGIN_HOOKS['plugin_datainjection_populate']['archimapplus'] = 'plugin_datainjection_populate_graphs';
      }

      // End init, when all types are registered
      $PLUGIN_HOOKS['post_init']['archimapplus'] = 'plugin_archimapplus_postinit';

      // Import from Data_Injection plugin
      $PLUGIN_HOOKS['migratetypes']['archimapplus'] = 'plugin_datainjection_migratetypes_archimapplus';
   }
}

// Get the name and the version of the plugin - Needed
function plugin_version_archimapplus() {

   return array (
      'name' => 'Archimap Plus',
      'version' => PLUGIN_ARCHIMAP_VERSION,
      'author'  => "Eric Feron",
      'license' => 'GPLv2+',
      'homepage'=>'https://github.com/ericferon/glpi-archimap',
      'requirements' => [
         'glpi' => [
            'min' => PLUGIN_ARCHIMAP_MIN_GLPI,
            'max' => PLUGIN_ARCHIMAP_MAX_GLPI,
//            'dev' => false
         ]
      ]
   );

}

// Optional : check prerequisites before install : may print errors or add to message after redirect
function plugin_archimapplus_check_prerequisites() {
   return true;
}

// Uninstall process for plugin : need to return true if succeeded : may display messages or add to message after redirect
function plugin_archimapplus_check_config() {
   return true;
}

function plugin_datainjection_migratetypes_archimapplus($types) {
   $types[2400] = 'PluginArchimapGraph';
   return $types;
}

?>
