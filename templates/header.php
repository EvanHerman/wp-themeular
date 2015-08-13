

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" ng-controller="navCtrl">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <a class="navbar-brand" href="#/">ACME</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right" ng-repeat="menu_item in menu_items | reverseOrder" ng-switch on="menu_item.object">
				
				<li ng-switch-when='custom'><a href="{{menu_item.url}}" title="{{menu_item.attr}}"}><i class="{{menu_item.icon_class}}"></i> {{menu_item.title}}</a></li>
				<li ng-switch-when='page'><a href="#/{{menu_item.object}}/{{menu_item.object_id}}" title="{{menu_item.attr}}"><i class="{{menu_item.icon_class}}"></i> {{menu_item.title}}</a></li>
                
				<!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#/blog">List of Posts</a>
                        </li>
                        <li><a href="#/blog/post">View One Post</a>
                        </li>
                    </ul>
                </li> -->
				
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
