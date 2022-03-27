<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

class TestController extends Controller
{
    public function test(){
        $puppeteer = new Puppeteer([ 'read_timeout' => 120, 'idle_timeout' => 120, 'debug' => true ,]);
        $browser = $puppeteer->launch(['args' => ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage',],
                                       'timeout' => 300000,]);
        $page = $browser->newPage();
        $page->goto('http://192.168.0.1:8888/form/');

        // Pタグの中身を取得 
        foreach ($page->querySelectorAll('p') as $el) {
        var_dump($el->getProperty('textContent')->jsonValue());
        }
        $browser->close();
    }
}
