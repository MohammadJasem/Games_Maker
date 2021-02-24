	<div class="ui inverted huge borderless fixed fluid menu" style="background-color: #38729d;border-bottom-left-radius: 30% !important;border-bottom-right-radius: 30% !important;">
	    <div class="header item" href="#">
	      <a href="{{route('home')}}"><img class="logo" width="200px" src="{{url('img/banner.png')}}" /></a>
	    </div>
      <div class="ui simple item">
        <div class="ui red image label" style="font-size: 20px;padding: 8px;">
          <i class="icon gift"></i>
          <a href="{{route('buildGame')}}">{{$gameName}}</a>
        </div>
      </div>

	    <div class="right menu" style="margin-right: 25px">
        <div class="ui simple dropdown item">
          {{$_COOKIE['fullname']}}<i class="dropdown icon"></i>
          <div class="menu">
            <a id="play_game_btn" class="item" href="#">Play Game <i class="game icon green"></i></a>
            <a class="item" href="{{route('logout')}}">Log Out <i class="lock icon red"></i></a>
          </div>
        </div>
	    </div>
	</div>