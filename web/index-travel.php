<html>
<head>
    <title>DealFactory - Design Tools</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/theme-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dropdown.css">
    <link rel="stylesheet" type="text/css" href="/css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" type="text/css" href="/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-simple.css">
    <link rel="stylesheet" type="text/css" href="/css/animate.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="/js/fileinput.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="/js/animatedModal.min.js"></script>
</head>

<body>
    <div class="buttons-left">
    <div style="height:0px;overflow:hidden"><form action="/process-mockup.php" id="formMockup" name="formMockup" method="post" enctype="multipart/form-data"><input type="file" id="fileMockup" name="fileMockup" /></form></div>
    <a id="rules" class="btn btn-block btn-info" href="#design-rules">Design Rules</a>
    <a id="arguments" class="btn btn-block btn-info" href="#design-arguments">Design Arguments</a>
    <a id="mockup" class="btn btn-block btn-info" href="#" onclick="chooseMockup();">Design Mockup</a>    
    </div>


    <div id="design-rules" class="text-center">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
        <div class="close-design-rules"> 
            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
        </div>
            
        <div class="modal-content text-center">
                  <iframe src="https://drive.google.com/a/groupon.com/file/d/0B7-WQbgD22zCYWxDVmIzdlQ4eTA/preview" width="100%px" height="96%px"></iframe>
        </div>
    </div>
 
    <div id="design-arguments" class="text-center">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
        <div class="close-design-arguments"> 
            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
        </div>
            
        <div class="modal-content text-center">
                  <iframe src="https://docs.google.com/a/groupon.com/spreadsheets/d/1tB-8IjzN6fGBaerrwK872bkMJN9cZrPMr0Z8BWFUXRs/pubhtml" width="100%px" height="96%px"></iframe>
        </div>
    </div>

  <div class="row">
        <form id="logoform" name="file" action="/process.php" method="post" enctype="multipart/form-data">
            <div class="col-md-5 col-md-offset-2">
                <div class="well-lg">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Logo</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div id="logo-errors" class="center-block" style="display:none"></div>

									
                                    <div class="row">
                                        <div class="col-md-12">
										<div class="input-group-lg">
                                            <input id="input-logo" name="file" class="file" type="file" accept="image/jpeg" data-show-upload="false" required="required" />	
										</div>
										
                                        </div>
                                    </div>
									<br>

									
                                    <div class="row">
                                        <div class="col-md-4 text-center">								
									
											<div class="panel panel-default">
												<div class="panel-heading">Settings</div>
												<div class="panel-body">
													<label class="checkbox">  <input type='checkbox' id='source' name='source' value="stock" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Source:<br> Stock  " data-off="<i class='fa fa-pause'></i> Source:<br> MPI"></label>
													<label class="checkbox">  <input type='checkbox' id='flip' name='flip' value="flip" data-toggle="toggle" data-on="<i class='fa fa-play'></i> Flip: On  " data-off="<i class='fa fa-pause'></i> Flip: Off"></label>
												</div>
											</div>		
						
			                            </div>	
									
                                        <div class="col-md-8 text-center">
											<div class="panel panel-default text-center">
												<div class="panel-heading">Select a logo</div>
												<div class="panel-body">											
											<select id="chooselogo" name="chooselogo">
                                                <option value="02.png" data-description="<span><span style='font-weight:bold;'>bold</span> <span style='color:red;'>red</span> normal</span>" value="02.png" data-image="/logo/02.jpg" selected>TMC - Best of Groupon</option>
                                                <option value="01.png" data-image="/logo/01.jpg">xFly - Booking</option>
                                                <option value="21.png" data-image="/logo/21.jpg">AIRC</option>
                                                <option value="22.png" data-image="/logo/22.jpg">Citotel</option>
                                                <option value="23.png" data-image="/logo/23.jpg">Camping No 1</option>                                                
                                                <option value="03.png" data-image="/logo/03.jpg">SEH - Inter Hotel</option>
                                                <option value="04.png" data-image="/logo/04.jpg">SEH - Qualys Hotel</option>
                                                <option value="05.png" data-image="/logo/05.jpg">SEH - Relais du Silence</option>
                                                <option value="06.png" data-image="/logo/06.jpg">Balladins Hotel</option>
                                                <option value="17.png" data-image="/logo/17.jpg">Telethon</option>
                                                <option value="07.png" data-image="/logo/07.jpg">P'tit Dej Hotel</option>
                                                <option value="08.png" data-image="/logo/08.jpg">MSC Cruise</option>
                                                <option value="13.png" data-image="/logo/13.jpg">Local Star</option>
                                                <option value="19.png" data-image="/logo/19.jpg">Best of DACH</option>                                                
                                                <option value="15.png" data-image="/logo/15.jpg">Relais Heritage</option>
                                                <option value="20.png" data-image="/logo/20.jpg">BedyCasa</option>
                                                <option value="16.png" data-image="/logo/16.jpg">Renouveau Vacances</option>
                                                <option value="09.png" data-image="/logo/09.jpg">Escale Oceania</option>
                                                <option value="14.png" data-image="/logo/14.jpg">Costa Cruises</option>
                                                <option value="10.png" data-image="/logo/10.jpg">Phantasia LAND</option>
                                                <option value="11.png" data-image="/logo/11.jpg">PlopsaCoo</option>
                                                <option value="12.png" data-image="/logo/12.jpg">Easter logo</option>
                                            </select>
												</div>										

											</div>											
			                            </div>
                                    </div>									
								
									
									
									
									<div class="row">
                                        <div class="col-md-4 col-md-offset-4">
											<input type="hidden" name="departament" value="1">										
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Start" />
                                        </div>
                                    </div>									
									










                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
                <div class="col-md-2"><div id="logo-preview"></div></div>
			</form>
			
			
			
			




<form action="/process-text2.php" id="textform" method="post" enctype="multipart/form-data">
            <div class="col-md-5 col-md-offset-2">
                <div class="well-lg">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Copyright text</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="copy-errors" class="center-block" style="display:none"></div>
									
                                    <div class="row">
                                        <div class="col-md-12">
										<div class="input-group input-group-lg">
											<span class="input-group-addon" id="sizing-addon1">&copy;</span>
											<input id="text" name="text" type="text" class="form-control input-lg" placeholder="Type copyright informations" aria-describedby="sizing-addon1" required = "required"/>
										</div>
										
                                        </div>
                                    </div>
<br>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
											<div class="panel panel-default">
												<div class="panel-heading">Font Color</div>
												<div class="panel-body">

													<input id='color' name='color' type="checkbox" checked  value="white" data-toggle="toggle" data-on="<i class='fa fa-play'></i> White" data-off="<i class='fa fa-pause'></i> Black">


												</div>
											</div>											
                                            										</div>
                                        <div class="col-md-8 text-center">
											<div class="panel panel-default">
												<div class="panel-heading">Pick your files</div>
													<div class="panel-body">
														<input id="input-copy" name="files[]" class="file" type="file" accept="image/jpeg" multiple="multiple" data-show-upload="false" required="required" />    
													</div>
											</div>										

											
										</div>										
                                    </div>

									<div class="row">
                                        <div class="col-md-4 col-md-offset-4">
											<input type="hidden" name="departament" value="1">										
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Start" />
                                        </div>
                                    </div>

                                    </div>
                                    </div>											
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4"><div id="copy-preview"></div></div>
                </div>
				</div>
			</form>
			
			
			
            </div>

<script type="text/javascript" src="/js/scripts.js"></script>
<script> 
        $("#rules").animatedModal({
                modalTarget:'design-rules',
                animatedIn:'zoomIn',
                animatedOut:'bounceOutDown',
                color:'#3498db',
        });
        $("#arguments").animatedModal({
                modalTarget:'design-arguments',
                animatedIn:'zoomIn',
                animatedOut:'bounceOutDown',
                color:'#3498db',
        }); 
        function chooseMockup() {
        	$("#fileMockup").click();
        }
        $("#fileMockup").change(function() {
    		$("form#formMockup").submit();
	});
 	
</script>
<?php

// Script start
$rustart = getrusage();

	include "connect.php";
	$maximages = $mysqli->query("SELECT max(id) as id FROM images")->fetch_object()->id; 
	$mysqli->close();

// Script end
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

$ru = getrusage();
echo "This process used " . rutime($ru, $rustart, "utime") .
    " ms for its computations\n";
echo "It spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls\n";

?>
<div id=footer><div class="label"> Total images: <div id="number1" class="count"><?php print $maximages; ?></div> </div></div></body></html>
