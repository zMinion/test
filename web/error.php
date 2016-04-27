<?php

include 'functions.php';
$id = 0;
if (isset($_GET['id']))
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$error = showError($id);
?>
<html>
<head>
    <title>DealFactory - Errors</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/theme-bootstrap.min.css">
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="well-lg">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Error</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="logo-errors" class="center-block" style="display:none"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        
                                        <div class="col-md-10 text-center col-md-offset-1">
                                            <div class="panel panel-default text-center">
                                                <div class="panel-heading"><?php print $error[0]; ?></div>
                                                <div class="panel-body">
                                                <?php print $error[1]; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</body></html>
