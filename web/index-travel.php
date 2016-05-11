<html>

<head>
    <title>DealFactory - Design Tools</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/theme-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" type="text/css" href="/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-simple.css">
    <link rel="stylesheet" type="text/css" href="/css/animate.min.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ddslick.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/fileinput.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="/js/animatedModal.min.js"></script>
</head>

<body>
    <div class="buttons-left">
        <div style="height:0px;overflow:hidden">
            <form action="/process.php" id="formMockup" name="formMockup" method="post" enctype="multipart/form-data">
                <input type="hidden" id='source' name='source' value="2">
                <input type="file" id="fileMockup" name="fileMockup" /> </form>
        </div> <a id="rules" class="btn btn-block btn-info" href="#design-rules">Design Rules</a> <a id="arguments" class="btn btn-block btn-info" href="#design-arguments">Design Arguments</a> <a id="mockup" class="btn btn-block btn-info" href="#" onclick="chooseMockup();">Design Mockup</a> </div>
    <div id="design-rules" class="text-center">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
        <div class="close-design-rules"> <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> </div>
        <div class="modal-content text-center">
            <iframe src="https://drive.google.com/a/groupon.com/file/d/0B7-WQbgD22zCYWxDVmIzdlQ4eTA/preview" width="100%px" height="96%px"></iframe>
        </div>
    </div>
    <div id="design-arguments" class="text-center">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
        <div class="close-design-arguments"> <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> </div>
        <div class="modal-content text-center">
            <iframe id="ifrm-design-arguments" name="ifrm-design-arguments" src="" width="100%px" height="96%px"></iframe>
        </div>
    </div>
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
                                                        <input type='checkbox' id='source' name='source' value="1" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Source:<br> Stock  " data-off="<i class='fa fa-pause'></i> Source:<br> MPI"> </label>
                                                    <label class="checkbox">
                                                        <input type='checkbox' id='flip' name='flip' value="1" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Flip: On  " data-off="<i class='fa fa-pause'></i> Flip: Off"> </label>
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
                                            <input type="hidden" name="departament" value="1">
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
        <form action="/process.php" id="textform" method="post" enctype="multipart/form-data">
            <div class="col-md-5 col-md-offset-2">
                <div class="well-lg">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Copyright text</h3> </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="copy-errors" class="center-block" style="display:none"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group input-group-lg"> <span class="input-group-addon" id="sizing-addon1">&copy;</span>
                                                <input id="text" name="text" type="text" class="form-control input-lg" placeholder="Type copyright informations" aria-describedby="sizing-addon1" required="required" /> </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Font Color</div>
                                                <div class="panel-body">
                                                    <input id='color' name='color' type="checkbox" checked value="1" data-toggle="toggle" data-on="<i class='fa fa-play'></i> White" data-off="<i class='fa fa-pause'></i> Black"> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-center">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Pick your files</div>
                                                <div class="panel-body">
                                                    <input id="input-copy" name="files[]" class="file" type="file" accept="image/jpeg" multiple="multiple" data-show-upload="false" required="required" /> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <input type="hidden" name="departament" value="1">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Start" /> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="copy-preview"></div>
            </div>
    </div>
    </div>
    </form>
    </div>
    <script type="text/javascript" src="/js/travel.logo.js"></script>
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

</html>