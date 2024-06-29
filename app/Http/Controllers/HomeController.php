<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Payment;
use App\Models\Client;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role==3)
        return redirect('/sale');

        $totalproducts=count(DB::select("SELECT DISTINCT product_id FROM `product_stock`"));
       $sales=Sale::whereDate("created_at",date("Y-m-d"))->get();
       $todaysale=0;
       foreach($sales as $sale) $todaysale+=$sale->products->sum("pivot.amount");
       $totalexpense=Payment::whereDate("created_at",date("Y-m-d"))->where("client_id",2)->sum("credit");


       $goutput1="data: [";
       $goutput2="labels: [";

        $sales=DB::select("select DATE_FORMAT(a.created_at,'%d-%m-%Y') as date,sum(b.amount) as amount
        from sales as a , product_sale as b
        where a.id=b.sale_id  group by date order by a.created_at DESC limit 5 ");
      foreach($sales as $sale)
      {
        $goutput1.=$sale->amount.",";
        $goutput2.="'".$sale->date."',";
      }

      $data=rtrim($goutput1,",")."]";
      $labels=rtrim($goutput2,",")."]";

     $collection=collect();
    Client::where("id","<>",1)->withSum("payments","debit")->withSum("payments","credit")->where("ctype",0)->each(function($data) use($collection) {
        $b=$data->payments_sum_debit-$data->payments_sum_credit;
        if($b<0) {
            $collection->push([
                "name"=>$data->name,
                "amount"=>$b,
            ]);
        }
    });
    $defaulters=json_decode($collection);

    $top_products=Product::withSum("sales","product_sale.quantity")->orderBy("sales_sum_product_salequantity","DESC")->take(5)->get();

    $labels1="labels: [";
    $data1="series: [";


    foreach($top_products as $product)
    {
        $labels1.="'".$product->name."',";
        $data1.=$product->sales_sum_product_salequantity.",";

    }

    $labels1=rtrim($labels1,",")."]";
    $data1=rtrim($data1,",")."]";


        $products=Product::all();
        $collection=collect();
        foreach($products as $product)
        {
            $pname=$product->name;
            $in=$product->stocks->sum("pivot.quantity");
            $out=$product->sales->sum("pivot.quantity");
            $inhand=$in-$out;
            if($inhand<300)
            $collection->push([
                "product"=>$pname,
                "purchase"=>$in,
                "sale"=>$out,
                "inhand"=>$inhand,
            ]);
        }
        $collection1=$collection->sortBy("inhand");
        $stockalerts=json_decode($collection1);




        return view('home',compact("totalproducts","todaysale","totalexpense","data","labels","defaulters","labels1","data1","stockalerts"));
    }

    public function print($saleid)
    {

        $sale=Sale::find($saleid);
        $total=$sale->payment->credit;
        $cash=$sale->payment->debit;
        if($total!=$cash)
        $credit=$sale->payment->credit-$sale->payment->debit;
        else $credit=0;
        return view("print",compact("sale","total","cash","credit"));

    }


}
