<?php

class HomeController extends Controller {
    public function index() {
        $this->view('home/index', ['page_title' => "Home — Darrel & Ayien's Five Star Hotel"]);
    }
}
