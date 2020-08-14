<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                width: 100%;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                width: 80%;
                height: 80%;
                
            }

            .title {
                font-size: 50px;
                
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
              
            }

            

        </style>
    </head>


    
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Dashboard
                </div>

                <div class="links">
               <!-- <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2213_RC01/embed_loader.js"></script>-->



  <?php  
      //acces api + variables               
  use Codenixsv\CoinGeckoApi\CoinGeckoClient;
  $client = new CoinGeckoClient();
  
  $data = $client->simple()->getPrice('0x,bitcoin', 'usd,rub');
  $bitcoinPrice = $data['bitcoin']['usd'];
  $lite = $client->simple()->getPrice('0x,litecoin', 'usd,rub')['litecoin']['usd'];
  $dogecoin = $client->simple()->getPrice('0x,dogecoin', 'usd,rub')['dogecoin']['usd'];
  $result = $client->coins()->getMarketChart('bitcoin', 'usd', 'max');
  $bitcoinHistory = $result['prices'];
  $countArrayLength = count($bitcoinHistory);
  $liteChart = $client->coins()->getMarketChart('litecoin', 'usd', 'max')['prices'];
  $dogeChart = $client->coins()->getMarketChart('dogecoin', 'usd', 'max')['prices'];
  $countArrayLengthDoge = count($dogeChart);
  
?>
  
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
//graph Bitcoin
function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn('number', '24h Volume');
    data.addColumn('number', 'Price');

    data.addRows([

    <?php
    for($i=0;$i<$countArrayLength;$i++){
        echo "[" . $bitcoinHistory[$i][0] . "," . $bitcoinHistory[$i][1] . "],";
    } 
    ?>
    ]);

    var options = {
        title: 'Bitcoin volume/price',
        curveType: 'function',
        legend: { position: 'bottom' } 
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart_0'));
    chart.draw(data, options);
     
}



google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);
//graph LiteCoin
function drawChart1() {

    var data = new google.visualization.DataTable();
    data.addColumn('number', '24h Volume');
    data.addColumn('number', 'Price');

    data.addRows([

    <?php
    for($i=0;$i<$countArrayLength;$i++){
        echo "[" . $liteChart[$i][0] . "," . $liteChart[$i][1] . "],";
    } 
    ?>
    ]);

    var options = {
        title: 'Litecoin volume/price',
        curveType: 'function',
        legend: { position: 'bottom' } 
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart_1'));
    chart.draw(data, options);
}



google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);
//graph DogeCoin
function drawChart2() {

    var data = new google.visualization.DataTable();
    data.addColumn('number', '24h Volume');
    data.addColumn('number', 'Price');

    data.addRows([

    <?php
    for($i=0;$i<$countArrayLengthDoge;$i++){
        echo "[" . $dogeChart[$i][0] . "," . $dogeChart[$i][1] . "],";
    } 
    ?>
    ]);

    var options = {
        title: 'DogeCoin volume/price',
        curveType: 'function',
        legend: { position: 'bottom' } 
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart_2'));
    chart.draw(data, options);
   
}


</script>

<div class="grid-container"> 
  <div>  Bitcoin price is : <?php echo $bitcoinPrice . ' $'; ?></div>
  <div>  Litecoin price is : <?php echo $lite . ' $'; ?></div>
  <div>  Dogecoin price is : <?php echo $dogecoin . ' $'; ?></div>
   
  <div id="curve_chart_0" style="width: 100%; height: auto ; "></div>
    <div id="curve_chart_1" style="width: 100%; height: auto ; "></div>
    <div id="curve_chart_2" style="width: 100%; height: auto ; "></div>
    <div class="grid-100 grid-parent" >
</div>  
 <br>
 <br>
 
</div>                  
                    <a href=""; class="litecoin">Bitcoin</a>
                    <a href=""; class="litecoin">Litecoin</a>
                    <a href="" class="dogecoin">Dogecoin</a>
                    
                </div>
            </div>
        </div>
        
    </body>
 

</html>
