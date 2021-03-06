<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        $vars = [
            'name' => $rd->query['name'] ?? '&lt; kein Name &gt;',
        ];
        return view('examples.m4_6a_queryparameter', $vars);
    }
    public function m4_6b_kategorie(RequestData $rd) {
        $data = db_kategorie_select_all();
        return view('examples.m4_6b_kategorie', [
            'title' => 'Kategorien',
            'kategorien'=> $data
        ]);
    }
    public function m4_6c_gerichte(RequestData $rd) {
        $data = db_gericht_select_all_ar();
        return view('examples.m4_6c_gerichte', [
            'title' => 'Gerichte',
            'gerichte'=> $data
        ]);
    }
    public function m4_6d_layout(RequestData $rd)
    {
        $vars = [
            'no' => $rd->query['no'] ?? '1',
            'titel' => $rd->query['titel'] ?? 'default'
        ];

        if ($vars['no'] == '1') {
            return view('examples.pages.m4_6d_page_1', $vars);
        }
        else {
            return view ('examples.pages.m4_6d_page_2', $vars);
        }
    }
    public function m4_6d_page_1(RequestData $rd) {
        $data = db_gericht_select_all_ar();
        return view('examples.pages.m4_6d_page_1', [
            'title' => 'Gerichte',
            'gerichte'=> $data
        ]);
    }
    public function m4_6d_page_2(RequestData $rd) {
        $data = db_gericht_select_all_ar();
        return view('examples.pages.m4_6d_page_2', [
            'title' => 'Gerichte',
            'gerichte'=> $data
        ]);
    }
}
