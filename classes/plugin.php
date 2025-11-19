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
 * Main class for plugin "media_pandavideo"
 *
 * @package   media_pandavideo
 * @copyright 2025 Panda Video {@link https://pandavideo.com.br}
 * @author    2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use repository_pandavideo\pandarepository;

/**
 * Class media_pandavideo_plugin
 */
class media_pandavideo_plugin extends core_media_player_external {
    /**
     * List supported urls.
     *
     * @param array $urls
     * @param array $options
     * @return array
     */
    public function list_supported_urls(array $urls, array $options = []) {
        $result = [];
        foreach ($urls as $url) {
            // If pandavideo support is enabled, URL is supported.
            if ($url->get_host() === "dashboard.pandavideo.com.br") {
                $result[] = $url;
            }
            if (str_ends_with($url->get_host(), "tv.pandavideo.com.br")) {
                $result[] = $url;
            }
        }

        return $result;
    }

    /**
     * Embed external.
     *
     * @param moodle_url $url
     * @param string $name
     * @param int $width
     * @param int $height
     * @param array $options
     * @return string
     * @throws Exception
     */
    protected function embed_external(moodle_url $url, $name, $width, $height, $options) {
        return pandarepository::getplayer($options["originaltext"]);
    }

    /**
     * Supports Text.
     *
     * @param array $usedextensions
     * @return string
     * @throws Exception
     */
    public function supports($usedextensions = []) {
        return get_string("support_pandavideo", "media_pandavideo");
    }

    /**
     * Get embeddable markers.
     *
     * @return array
     */
    public function get_embeddable_markers() {
        $markers = [
            "dashboard.pandavideo.com.br",
            "player-vz.*.tv.pandavideo.com.br",
        ];
        return $markers;
    }


    /**
     * Default rank
     *
     * @return int
     */
    public function get_rank() {
        return 2007;
    }

    /**
     * Checks if player is enabled.
     *
     * @return bool True if player is enabled
     */
    public function is_enabled() {
        return true;
    }
}
