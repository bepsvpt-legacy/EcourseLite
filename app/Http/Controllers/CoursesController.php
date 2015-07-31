<?php

namespace App\Http\Controllers;

use App\Ecourse\CourseRepository;

class CoursesController extends Controller
{
    public function getCourseLists()
    {
        $lists = CourseRepository::getCourseList();

        array_shift($lists);

        $courseLists = [];

        foreach ($lists as $list)
        {
            $courseLists[] = substr($list->children(3)->children(0)->children(0)->href, strpos($list->children(3)->children(0)->children(0)->href, '=') + 1);
        }

        session()->put('courseLists', $courseLists);

        return view('courses', compact('lists'));
    }

    public function getCourseNews($courseId)
    {
        $news = CourseRepository::getCourseNews($courseId);

        return view('news', compact('courseId', 'news'));
    }

    public function getCourseNewsContent($courseId, $newsId)
    {
        return CourseRepository::getCourseNewsContent($courseId, $newsId);
    }

    public function getCourseGrades($courseId)
    {
        $grades = CourseRepository::getCourseGrades($courseId);

        return view('grades', compact('grades'));
    }

    public function getCourseFiles($courseId)
    {
        $files = CourseRepository::getCourseFiles($courseId);

        return view('files', compact('files'));
    }
}