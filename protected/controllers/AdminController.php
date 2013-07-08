<?php
 class adminController extends SBaseController{
     public function actionIndex(){
         $this->render('index');
     }
     
     public function actionUser(){
         $this->render('user');
     }
     
     public function actionSetting(){
         $this->render('setting');
     }
 }
 ?>