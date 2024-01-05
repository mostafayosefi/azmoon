

@extends('user.layoutuser')

@section('title')
<title>پرداخت ارزی </title>
@stop

 
@section('superadmin')



				
 <table width="80%" border="0">
  <tr>
    <th>Box 1</th>
    <th>Box 2</th>
    <th>Result</th>
    <th>sum</th>
  </tr>
  <tr>
    <td><input id="box1" type="text" oninput="calculate();" /></td>
    <td><input id="box2" type="text" oninput="calculate();" /></td>
    <td><input id="result" /></td>
    <td><input id="resultt" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script> 
    function calculate() {
        var myBox1 = document.getElementById('box1').value; 
        var myBox2 = document.getElementById('box2').value;
        var result = document.getElementById('result'); 
        var resultt = document.getElementById('resultt'); 
        var myResult = myBox1 * myBox2;
          document.getElementById('result').value = myResult;
        var myResultt = parseFloat(document.getElementById('box1').value) + parseFloat(document.getElementById('box2').value); 
          document.getElementById('resultt').value = myResultt; 
    } 
    
</script>
		
		
		 
		


@stop

  
