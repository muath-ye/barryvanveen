<?php

class AdminDashboardController extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        Head::title('Dashboard');

        return View::make('pages.admin.dashboard');
    }
}