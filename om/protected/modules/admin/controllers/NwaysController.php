<?php

class NwaysController extends Controller
{

    public function actionPatch ()
    {
        header('Content-Type: text/html; charset=utf-8');
        $np = new NwaysPatch();
        $np->actionPatch(false);
    }

}