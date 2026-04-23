<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $fillable = ['title', 'youtube_url', 'description', 'active', 'display_order'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function getYoutubeEmbedUrlAttribute(): string
    {
        $url = $this->youtube_url;
        // Handle various YouTube URL formats
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        $videoId = $matches[1] ?? '';
        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : '';
    }

    public function getYoutubeWatchUrlAttribute(): string
    {
        $url = $this->youtube_url;
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        $videoId = $matches[1] ?? '';
        return $videoId ? "https://www.youtube.com/watch?v={$videoId}" : $url;
    }
}
