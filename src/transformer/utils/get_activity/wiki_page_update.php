<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Transformer utility for retrieving (course discussion) activities.
 *
 * @package   logstore_xapi
 * @copyright Jerret Fowler <jerrett.fowler@gmail.com>
 *            Ryan Smith <https://www.linkedin.com/in/ryan-smith-uk/>
 *            David Pesce <david.pesce@exputo.com>
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace src\transformer\utils\get_activity;

use src\transformer\utils as utils;

/**
 * Transformer utility for retrieving (wiki page) activities.
 *
 * @param array $config The transformer config settings.
 * @param \stdClass $course The course object.
 * @param \stdClass $discussion The discussion object.
 * @return array
 */
function wiki_page_update(array $config, \stdClass $course, \stdClass $page, \stdClass $subwiki) {
    $courselang = utils\get_course_lang($course);
    $pageurl = $config['app_url'].'/mod/wiki/view.php?id='.$page->id.'&group='.$subwiki->id;
    $pagetitle = property_exists($page, 'title') ? $page->title : 'Title';


    return [
        'id' => $pageurl,
        'definition' => [
            'type' => 'http://activitystrea.ms/schema/1.0/page',
            'name' => [
                $courselang => $pagetitle,
            ],
        ],
    ];
}
