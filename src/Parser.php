<?php

namespace Aivec\Utils\UrlParser;

/**
 * Handles URL parsing
 */
class Parser
{
    /**
     * Gets the host name of the current server.
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return string
     */
    public static function getHost() {
        $possible_host_sources = ['HTTP_X_FORWARDED_HOST', 'HTTP_HOST', 'SERVER_NAME'];
        $host = '';
        foreach ($possible_host_sources as $source) {
            if (!empty($host)) {
                break;
            }
            if (empty($_SERVER[$source])) {
                continue;
            }
            $url = esc_url_raw(wp_unslash($_SERVER[$source]));
            $scheme = wp_parse_url($url, PHP_URL_SCHEME);
            if (!$scheme) {
                $url = 'http://' . $url;
            }
            $host = wp_parse_url($url, PHP_URL_HOST);
        }
        return trim($host);
    }
}
