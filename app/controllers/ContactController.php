<?php

class ContactController extends Controller {
    public function index() {
        $this->view('contact/index', ['page_title' => "Contacts — Darrel & Ayien's Five Star Hotel"]);
    }
}
