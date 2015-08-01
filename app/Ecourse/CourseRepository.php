<?php

namespace App\Ecourse;

use Cache;
use Yangqi\Htmldom\Htmldom;

class CourseRepository extends Core
{
    /**
     * Send request to ecourse server to change server session data.
     *
     * @param string $courseId
     */
    public static function changeSession($courseId)
    {
        getRequest(Core::LOGIN_S . $courseId);
    }

    /**
     * Check the course id is valid or not.
     *
     * @param string $courseId
     * @return bool
     */
    public static function checkCoursePermission($courseId)
    {
        return in_array($courseId, session('courseLists', []));
    }

    /**
     * Get the course list.
     *
     * @return \Yangqi\Htmldom\Htmldomnode
     */
    public static function getCourseList()
    {
        $content = session('courseListsContent');

        $html = (new Htmldom())->load($content);

        return $html->find('table table tr');
    }

    /**
     * Get course news.
     *
     * @param string $courseId
     * @return array
     */
    public static function getCourseNews($courseId)
    {
        if ( ! self::checkCoursePermission($courseId))
        {
            return [];
        }

        $content = Cache::remember("courseNews_{$courseId}", 30, function() use ($courseId)
        {
            self::changeSession($courseId);

            return getRequest(Core::NEWS);
        });

        $html = (new Htmldom())->load($content);

        return array_slice($html->find('table', 4)->find('tr'), 1, 5);
    }

    /**
     * Get course news content.
     *
     * @param string $courseId
     * @param string $newsId
     * @return mixed|string
     */
    public static function getCourseNewsContent($courseId, $newsId)
    {
        if ( ! self::checkCoursePermission($courseId))
        {
            return '';
        }

        $content = Cache::remember("courseNewsContent_{$courseId}_{$newsId}", 30, function() use ($newsId)
        {
            return getRequest(Core::NEWS_CONTENT . $newsId);
        });

        $html = (new Htmldom())->load($content);

        return str_replace(["\r\n", "\n"], '<br>', e($html->find('table', 1)->find('tr', 2)->find('td', 1)->plaintext));
    }

    /**
     * Get course grades.
     *
     * @param string $courseId
     * @return array
     */
    public static function getCourseGrades($courseId)
    {
        if ( ! self::checkCoursePermission($courseId))
        {
            return [];
        }

        self::changeSession($courseId);

        $content = getRequest(Core::COURSE_GRADES);

        $html = (new Htmldom())->load($content);

        return array_slice($html->find('table', 1)->find('tr'), 1);
    }

    /**
     * Get course teaching materials.
     *
     * @param string $courseId
     * @return array
     */
    public static function getCourseFiles($courseId)
    {
        if ( ! self::checkCoursePermission($courseId))
        {
            return [];
        }

        self::changeSession($courseId);

        $content = getRequest(Core::COURSE_FILES);

        $links = (new Htmldom())->load($content)->find('a[href*=php]');

        return Cache::remember("courseFiles_{$courseId}", 30, function() use ($links)
        {
            $files = [];

            foreach ($links as $link)
            {
                $content = getRequest(Core::COURSE_TEXTBOOK . $link->href, false);

                $files = array_merge($files, (new Htmldom())->load($content)->find('a[href*=textbook]'));
            }

            return $files;
        });
    }
}