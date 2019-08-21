<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ConnectCql;
class DemoController extends Controller
{
      public function Index(Request $request){


          $objtest = new ConnectCql();
          $objtest->pagination = 2;
//          $rows = $objtest->QueryCQL('SELECT * FROM content');

          $firstPageRows = $objtest->QueryCQL('SELECT * FROM content');
          echo "Page 1: " . ($firstPageRows->isLastPage() ? "last" : "not last") . PHP_EOL;

          $secondPageRows = $firstPageRows->nextPage();
          echo $firstPageRows->isLastPage() ? "1: last\n" : "1: not last\n";
          echo $secondPageRows->isLastPage() ? "2: last\n" : "2: not last\n";

          echo "entries in page 1: " . $firstPageRows->count() . "\n";
          echo "entries in page 2: " . $secondPageRows->count() . "\n";
      }
}
