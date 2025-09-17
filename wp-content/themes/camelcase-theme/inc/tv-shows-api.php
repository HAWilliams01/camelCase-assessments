<?php

/**
 * TV Shows API Service
 * Handles fetching TV show data from TVMaze API
 *
 * @package Camelcase_Theme
 */

class TV_Shows_API {
    
    private $api_base_url = 'https://api.tvmaze.com';
    private $cache_duration = 24 * 60 * 60; // 24 hours in seconds
    
    /**
     * Get the 6 most recent TV shows for today
     *
     * @return array|false Array of TV shows or false on error
     */
    public function getRecentShows($limit = 6) {
        $cache_key = 'tv_shows_recent_' . date('Y-m-d');
        $cached_data = get_transient($cache_key);
        
        // Return cached data if available
        if ($cached_data !== false) {
            return array_slice($cached_data, 0, $limit);
        }
        
        // Fetch fresh data from API
        $shows = $this->fetchShows();
        
        if ($shows === false) {
            return false;
        }
        
        // Cache the data for 24 hours
        set_transient($cache_key, $shows, $this->cache_duration);
        
        return array_slice($shows, 0, $limit);
    }
    
    /**
     * Fetch today's TV shows from API
     *
     * @return array|false Array of shows or false on error
     */
    private function fetchShows() {
        $today = date('Y-m-d');
        $url = $this->api_base_url . '/schedule/web?date=' . $today . '&country=US';
        
        $response = wp_remote_get($url, array(
            'timeout' => 30,
            'headers' => array(
                'Accept' => 'application/json',
            ),
        ));
        
        // Check for errors
        if (is_wp_error($response)) {
            error_log('TV Shows API Error: ' . $response->get_error_message());
            return false;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            error_log('TV Shows API Error: HTTP ' . $response_code);
            return false;
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('TV Shows API Error: Invalid JSON response');
            return false;
        }
        
        return $this->processData($data);
    }
    
    /**
     * Process and clean the shows data from API
     *
     * @param array $raw_data Raw data from API
     * @return array Processed shows data
     */
    private function processData($raw_data) {
        $processed_shows = array();
        
        foreach ($raw_data as $episode) {
            if (!isset($episode['_embedded']['show'])) {
                continue;
            }
            
            $show = $episode['_embedded']['show'];
            
            // Create a unique key for each show to avoid duplicates
            $show_key = $show['id'];
            
            // Only add if we haven't seen this show yet
            if (!isset($processed_shows[$show_key])) {
                $processed_shows[$show_key] = array(
                    'id' => $show['id'],
                    'name' => $show['name'],
                    'type' => $show['type'] ?? 'Unknown',
                    'language' => $show['language'] ?? 'Unknown',
                    'genres' => $show['genres'] ?? array(),
                    'status' => $show['status'] ?? 'Unknown',
                    'runtime' => $show['runtime'] ?? $show['averageRuntime'] ?? null,
                    'premiered' => $show['premiered'] ?? null,
                    'ended' => $show['ended'] ?? null,
                    'rating' => $show['rating']['average'] ?? null,
                    'summary' => $this->cleanseSummary($show['summary'] ?? ''),
                    'image' => $show['image']['medium'] ?? $show['image']['original'] ?? null,
                    'network' => $show['network']['name'] ?? $show['webChannel']['name'] ?? 'Unknown',
                    'url' => $show['url'] ?? null,
                    'episode' => array(
                        'name' => $episode['name'],
                        'season' => $episode['season'],
                        'number' => $episode['number'],
                        'airdate' => $episode['airdate'],
                        'airtime' => $episode['airtime'],
                        'summary' => $this->cleanseSummary($episode['summary'] ?? ''),
                    ),
                );
            }
        }        
        
        return array_values($processed_shows);
    }
    
    /**
     * Clean HTML tags and entities from summary text
     *
     * @param string $summary Raw summary text
     * @return string Cleaned summary text
     */
    private function cleanseSummary($summary) {
        $summary = wp_strip_all_tags($summary);
        $summary = html_entity_decode($summary, ENT_QUOTES, 'UTF-8');
        return trim($summary);
    }
    
    /**
     * Clear the cache (useful for manual refresh)
     */
    public function clearCache() {
        $cache_key = 'tv_shows_recent_' . date('Y-m-d');
        delete_transient($cache_key);
    }
}

// Initialize the API service
function getTVShows() {
    static $api = null;
    if ($api === null) {
        $api = new TV_Shows_API();
    }
    return $api;
}
