<!DOCTYPE html>
<html>
<head>
<title>DealFactory Stats</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script type="text/javascript" src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
<meta charset=utf-8 />


</head>
<body>
  <div id="line-example"></div>
<script>
Morris.Line({
  element: 'line-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Travel', 'Goods']
});
</script>  
</body>
</html>
