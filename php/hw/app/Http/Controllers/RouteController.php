<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Http\Controllers\Controller;

// use Log;
 // Log::info('This is some useful information.'); //may be useful

class RouteController extends Controller
{
	// Active navbar buttons,see layouts/master.blade.php
/*	var $nav_act =
	[
	  'main_class'=>'',
	  'about_class'=>'',
	  'prod_class'=>'',
	  'case_class'=>'',
	  'cont_class'=>'',
	];
*/

    public function RootRequest()
    {
      return redirect('/main');
    }

    public function MainRequest()
    {
      return view('main');
    }
/*
    public function AboutRequest()
    {
      $this->nav_act['about_class']='active';
      return view('about',$this->nav_act);
      $this->nav_act['about_class']='';
    }

    public function ProdRequest()
    {
      $this->nav_act['prod_class']='active';
      return view('products',$this->nav_act);
      $this->nav_act['prod_class']='';
    }
*/
    public function CaseRequest()
    {
      $subjectarray=Subject::All();
      return view('case',['htmldata'=>$subjectarray]);
    }
/*
    public function ContactRequest()
    {
      $this->nav_act['cont_class']='active';
      return view('contact',$this->nav_act);
      // Почему-то хэш не сохраняется между переходами.
      // Не сильно мешает,но неужели объект пересоздается при каждом вызове?
    }
*/
}