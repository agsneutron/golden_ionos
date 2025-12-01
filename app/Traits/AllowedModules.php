<?php

namespace App\Traits;

use App\Group;
use App\Module;
use Illuminate\Support\Facades\Auth;

trait AllowedModules{
  public function getAllowedModules($activeModule = "none"){
      $user = Auth::user();

      $menu = array();

      $groups = \GroupsQuery::create()
          ->find();
      foreach ($groups as $group){
          $modules = \ProfilePermissionsQuery::create()
              ->filterByIdUserType(Auth::user()->id_user_type)
              ->useModulesQuery('Module')
                ->filterByActive(1)
                ->filterByIdGroup($group->getId())
                ->withColumn('Module.Name', 'NameModule')
                ->withColumn('Module.Icon', 'IconModule')
                ->withColumn('Module.Url', 'UrlModule')
              ->endUse()
              ->find();
          $modsCat = array();
          $classGrp = "";
          $classUl = "";
          if(count($modules)){
              foreach ($modules as $module){
                  $class="";
                  if($activeModule == $module->getVirtualColumn('UrlModule')){
                      $class = "active";
                      $classGrp = "active";
                      $classUl = "in";
                  }
                  array_push($modsCat, array(
                      "url"=>$module->getVirtualColumn('UrlModule'),
                      "name"=>$module->getVirtualColumn('NameModule'),
                      "icon"=>$module->getVirtualColumn('IconModule'),
                      "class"=>$class
                  ));
              }
              array_push($menu, array(
                  "icon" => $group->getIcon(),
                  "name" => $group->getName(),
                  "modules" => $modsCat,
                  "classGrp" => $classGrp,
                  "classUl" => $classUl,
              ));
          }
      }
      //dd($menu);
      return $menu;
  }


}
