<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dimension Store</title>
  <meta name="description" content="Een overzicht van al onze store items voor NL/BE Jail server">

  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <script src="assets/js/modernizr-2.6.2.min.js"></script>
</head>
<body class="gridlock" id="top">
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-44216392-1', 'dimension-gaming.com');
    ga('send', 'pageview');

  </script>
  <div class="loading-container">
    <div class="loading"></div>
    <div class="loadingb"></div>
  </div>
  <div class="indicator">
    <div class="loading"></div>
  </div>

  <a href="#top" id="totop" class="totop fixed smooth">Top</a>
  
  <header>
    <div class="row">
      <div class="float-left">
        <a href="#top" id="logo" class="logo smooth"><img src="assets/images/logo.svg" width="46" height="46" alt="Dimension Gaming logo"><h2>Store</h2></a>
      </div>
      <div class="float-right">
        <a class="menulink" href="http://forum.dimension-gaming.com/">Forum</a>
        <span id="buybutton" class="button ">Koop credits</span>
      </div>
    </div>
  </header>

  <section id="buyoverlay" class="buyoverlay hidden remove">
    <div id="buy-header" class="buy-header align-center">
      <h3 class="buy-titel">Selecteer een credit pack <img src="assets/images/arrow-down.svg" alt=""></h3>
    </div>
    <div class="buy-extrainfo align-center">
      Momenteel zijn er <strong>121</strong> items die samen <strong>70.000</strong> credits waard zijn. In totaal hebben we al <strong>72 packs</strong> verkocht
    </div>
    <div class="buy-contentcontainer">
      <div class="buy-content row">
        <div id="packages" class="desktop-12 buy-packages contained table">
          <a href="#buyoverlay" class="align-center buy-item smooth" data-packagename="Koop alles" data-price="€50" data-id="p50">
            <span>Koop alles</span>
            <div class="price">
              €50
            </div>
          </a>
          <a href="#buyoverlay" class="align-center buy-item smooth" data-packagename="45.000 credits" data-price="€25" data-id="p40">
            <span>45.000 credits</span>
            <div class="price">
              €25
            </div>
          </a>
          <a href="#buyoverlay" class="align-center buy-item smooth" data-packagename="25.000 credits" data-price="€15" data-id="p30">
            <span>25.000 credits</span>
            <div class="price">
              €15
            </div>
          </a>
          <a href="#buyoverlay" class="align-center buy-item smooth" data-packagename="16.000 credits" data-price="€10" data-id="p20">
            <span>16.000 credits</span>
            <div class="price">
              €10
            </div>
          </a>
          <a href="#buyoverlay" class="align-center buy-item smooth" data-packagename="7.000 credits" data-price="€5" data-id="p10">
            <span>7.000 credits</span>
            <div class="price">
              €5
            </div>
          </a>
        </div>
        <div id="buy-indication" class="buy-indication desktop-12 align-center">
          <hr>
          <div class="tophr"></div>
          <div>Kies een package</div>
        </div>
        <div id="buy-innercontent" class="buy-innercontent desktop-12 contained hidden remove">
          <form id="buy-form" action="{{ url('payment/process') }}" method="post" class="buy-form">
            
            <div class="desktop-4 equal">
              <label for="steamID">SteamID</label>
              <input class="input" type="text" id="steamID" name="steamID" placeholder="STEAM_0:X:XXXXXX" value="">
              <label for="Nickname">Nickname</label>
              <input class="input" type="text" id="nickname" name="nickname" placeholder="Ingame nickname" value="">
              <label for="E-Mail">E-Mail</label>
              <input class="input" type="email" id="e-mail" name="e-mail" placeholder="forum e-mail verplicht" value="">
            </div>
            <div class="desktop-1 equal seperator">
              
            </div>
            <div class="desktop-7 equal">
              <label for="payProvider">Betaal methode</label>
              <select name="payProvider" id="payProvider" class="select">
                <option value="">Kies een betaal methode</option>
                @foreach($payment_providers as $payment_provider)
                 <option value="{{$payment_provider->id}}">{{$payment_provider->name_long}}</option>
                @endforeach
                <option value="test">Test</option>
                <option value="test2">Test2</option>
                <option value="test3">Test3</option>
                <option value="test4">Test4</option>
                <option value="test5">Test5</option>
              </select>
              <div class="buy-overview">
                <div class="buy-overview-info">
                  <div class="header">
                    U heeft <strong><span id="packageName">alles kopen</span></strong> geselecteerd t.w.v. <strong><span id="packagePrice">€50</span></strong>
                  </div>
                  <span class="check">(kijk alles nog eens na)</span>
                </div>
                <input id="buy-submit" type="submit" class="buy-submit align-center" value="Ga naar de betaling">
              </div>
            </div>
            <input name="package_id" id="buy-value" type="input" value="p50" hidden>
          </form>
        </div>
      </div>
    </div>
  </section>

  

  
  
  <!-- <div class="scroll">
    <div>
      <div id="scrollUp" class="scroll-item"></div>
      <div id="scrollUpbig" class="scroll-item"></div>
    </div>
    <div>
      <div id="scrollDown" class="scroll-item"></div>
      <div id="scrollDownbig" class="scroll-item"></div>
    </div>
  </div> -->

  <div id="lightboxclose" class="close user-select fixed">X</div>
  <div id="lightboxcontrols" class="lightboxcontrols fixed">
    <div id="lightboxnext" class="next user-select absolute"><img src="assets/images/next.svg" alt=""></div>
    <div id="lightboxprev" class="prev user-select absolute"><img src="assets/images/prev.svg" alt=""></div>
    
  </div>

  <div id="itemviewer">
    <div class="slogan">
      <h1>Een handig overzicht van al onze store items</h1>
    </div>
    
    
    <div class="row" role="main">
      <div class="desktop-12">
        <ul id="filter" class="sort align-right">
          <li class="sort active" data-sort="default" data-order="desc">Normaal</li>
          <li class="sort" data-sort="data-price" data-order="asc">Duurste</li>
          <li class="sort" data-sort="data-price" data-order="desc">Goedkoopste</li>
        </ul>
      </div>
      <div class="desktop-2 tablet-1 relative sort-container">
        <h2 class="heading">Categories</h2>
        <ul id="filter">
          <li id="alles" class="filter active" data-filter="hats brillen snorren pets skin">Alles</li>
          <li class="filter" data-filter="hats">Hats</li>
          <li class="filter" data-filter="brillen">Brillen</li>
          <li class="filter" data-filter="snorren">Snorren</li>
          <li class="filter" data-filter="pets">Pets</li>
          <li class="filter" data-filter="skin">Skins</li>
          <li class="filter" data-filter="piemol jetpack vogel">Overige</li>
        </ul>
      </div>
    
      <div id="grid" class="desktop-10 tablet-5 item-container">
        @foreach ($items as $item)
        <a id="item" data-price="{{ $item->price }}" class="item equal desktop-3 tablet-3 mobile-half contained mix lightbox {{ $item->loadout_slot }}" href="assets/images/items/groot/{{ $item->name }}.jpg" title="{{ $item->price }} credits - {{ $item->display_name }}">
            <div class="overlay">
                <div class="name align-center">{{ $item->display_name }}</div>
                <div class="price align-right"><div class="credits">{{ $item->price }}</div>credits</div>
            </div>
            <img class="item-image" src="assets/images/items/{{ $item->name }}.jpg" data-src="assets/images/items/{{ $item->name }}.jpg" alt="{{ $item->web_description }}">
       
        </a>
        @endforeach
      </div>
    </div>
    <footer>
    
    </footer>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="assets/js/min/plugins.js" type="text/javascript"></script>
  <script src="assets/js/min/js.min.js" type="text/javascript"></script>



</body>
</html>