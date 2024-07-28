<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {

        return view('frontend.index');
    }
    public function preprationCourses()
    {


        return view('frontend.pages.prepration-courses');
    }
    public function practiceMarterial()
    {


        return view('frontend.pages.practice-marterial');
    }


    public function privacyPolicy()
    {


        return view('frontend.pages.privacy-policy');
    }

    public function faqs()
    {


        return view('frontend.pages.faqs');
    }
}
