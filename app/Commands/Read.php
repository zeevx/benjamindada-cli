<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Http;

class Read extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'Read';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'See Latest headlines';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'https://api.rss2json.com/v1/api.json?rss_url=https://www.benjamindada.com/rss';
        $data = Http::get($url);
        // Parses the response and build a table.
        $this->info("Hello Techie! Trending In Tech:");
        $response = json_decode($data);
        foreach ($response->items as $item) {
            echo "{$item->title} by {$item->author}\n - ({$item->link}) ";
            $this->newLine(2);
        }
        // Notify the user on the Operating System that the weather arrived.
        $this->notify('News Alert!', 'BenjaminDada News just arrived!', 'icon.png');
    }



}
