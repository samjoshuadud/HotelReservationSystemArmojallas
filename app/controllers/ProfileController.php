<?php

class ProfileController extends Controller {
    public function index() {
        $this->view('profile/index', ['page_title' => "Company's Profile — Darrel & Ayien's Five Star Hotel"]);
    }
}
