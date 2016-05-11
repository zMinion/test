<html>

<head>
    <title>DealFactory - Design Tools</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/theme-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" type="text/css" href="/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-simple.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ddslick.min.js"></script>
    <script type="text/javascript" src="/js/fileinput.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-toggle.min.js"></script>
</head>

<body>
    <div class="row">
        <form id="logoform" name="file" action="/process.php" method="post" enctype="multipart/form-data">
            <div class="col-md-5 col-md-offset-2">
                <div class="well-lg">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Logo</h3> </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="logo-errors" class="center-block" style="display:none"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group-lg">
                                                <input id="input-logo" name="file" class="file" type="file" accept="image/jpeg" data-show-upload="false" required="required" /> </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Settings</div>
                                                <div class="panel-body">
                                                    <label class="checkbox">
                                                        <input type='checkbox' id='source' name='source' value="stock" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Source:<br> Stock  " data-off="<i class='fa fa-pause'></i> Source:<br> MPI"> </label>
                                                    <label class="checkbox">
                                                        <input type='checkbox' id='flip' name='flip' value="flip" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Flip: On  " data-off="<i class='fa fa-pause'></i> Flip: Off"> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-center">
                                            <div class="panel panel-default text-center">
                                                <div class="panel-heading">Select a logo</div>
                                                <div class="panel-body">
                                                    <div id="picklogo"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <input type="hidden" name="departament" value="2">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Start" /> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div id="logo-preview"></div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/js/goods.logo.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
    <div id=footer>
        <div class="label"> Total images:
            <div id="number1" class="count">
				<?php
					require "functions.php"; 
					print showStats(); 
				?> 
            </div>
        </div>
    </div>
</body>