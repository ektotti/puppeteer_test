<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

class TestScrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $puppeteer = new Puppeteer;
        $browser = $puppeteer->launch(['args' => ['--no-sandbox', '--disable-setuid-sandbox'], 'executablePath' => 'google-chrome-stable']);

        $page = $browser->newPage();
        $page->goto('https://www.jleague.jp/');
        $page->screenshot(['path' => 'example.png']);

        $browser->close();
    }
}
