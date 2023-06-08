<!DOCTYPE html>
<html>
<head>
	<title>Visual Programming Interface</title>
	<style>
	
		body {
  margin: 0;
  padding: 0;
  height: 100%;
  font-family: Arial, sans-serif;
  background-color: #baa4e2; /* light purple background */
}

#sidebar {
    position: absolute;
  top: 0;
  left: 0;
  bottom: 0; /* extend to the bottom of the page */
  width: 14%;
  height: 1000px;
  background-color:rgb(219, 160, 198);
  padding: 10px;
  box-sizing: border-box;
  border: 1px solid  black;
  padding-top: 50px;
  
}

#main {
  position: absolute;
  top: 0;
  left: 15%; /* adjusted left position */
  height: 100%;
  width: 85%; /* adjusted width */
  background-color: #fff;
  padding: 10px;
  box-sizing: border-box;
  border-left: 1px solid #ccc;
}

.block {
    position: relative;
  background-color: #fff;
  color: #333;
  border: 2px solid #ccc;
margin-top: 20px;
  padding: 10px;
  margin-bottom: 10px;
  cursor: move;
  height: 50px;
  width: 130px;
  box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3); /* added box shadow */
  transition: box-shadow 0.2s;
}

.block:hover {
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5); /* added hover effect */
}

.programmable-area {
    position: relative;
  height: 380px;
  width:400px;
  border: 5px solid black;
  padding: 10px;
  margin-left: 250px;
  margin-top:50px;
   box-sizing: border-box; 
  overflow-y: auto; 
  margin-bottom: 20px;
  background-color: rgb(255, 250, 250);
}
#output{ height: 380px;
  width:1100px;
  border: 5px solid black;
  padding: 10px;
  margin-left: 250px;
  margin-top:50px;
   box-sizing: border-box; 
  overflow: auto; 
  margin-bottom: 20px;
  background-color: rgb(255, 250, 250);
  margin-top:150px;
}

#run-button {
  display: block;
  margin: auto;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  background-color: #2ecc71;
  color: #fff;
  border: none;
  margin-left: 800px;
  height:60px;
  width:100px;
  border-radius: 5px;
  box-shadow: 5px 5px 5px 5px rgba(0,0,0,0.2);
  transition: background-color 0.2s;
}
#heading{
    /* position: absolute; */
    background-color:rgb(117, 187, 192);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3); /added box shadow/
    height:50px;
    width: 400px;
    border:2px solid;
    border-color: rgba(122, 125, 125, 0.815);
    margin-left:250px;
    margin-top:80px;
    
	
}
#heading3{
    position: absolute;
    background-color:rgb(117, 187, 192);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3); /added box shadow/
    height:50px;
    width: 150px;
    border:2px solid;
    border-color: rgba(122, 125, 125, 0.815);
    margin-left:250px;
    margin-top:80px;
}
#heading2{
    position: absolute;
    background-color:rgb(117, 187, 192);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3); /added box shadow/
    height:50px;
    width: 170px;
    
    border-bottom:2px solid;
    border-color: rgba(122, 125, 125, 0.815);
    top: -10px;
}
#run-button:hover {
  background-color: #27ae60;
}
#code{
    background-color:rgb(117, 187, 192);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.3); /added box shadow/
    height:50px;
    width: 150px;
    border:2px solid;
    border-color: rgba(122, 125, 125, 0.815);
    margin-left:250px;
    margin-top:80px;
} 

/* .execute{
    display:flex;
} */
	
	</style>
</head>

	
<body>
	<div class="execute">
        <h1 id="heading">PROGRAMMABLE AREA:</h1>
    <div class="programmable-area" id="programmable-area" ></div>
    <h1 id="code">CODE:</h1>
    <form method="post">
    <textarea id="code-area" name="code" rows="20" cols="50" style="margin-top :10px; margin-left:250px; border: 5px solid;font-size: 28px;
    border-color: black;">
    </textarea>
    <br>
             
    <button type="submit" id="run-button" name="submit" >Run</button>
</form>
    <h1 id="heading3">OUTPUT:</h1>
<div class="output" id="output"></div>
</div>
    <div id="sidebar"> <h2 id="heading2">Components:</h2>
    
        <div class="block" id="variable" draggable="true" >
            <p>Variable Creation</p>
        </div>
        <div class="block" id="arithmetic" draggable="true" >
            <p>Arithmetic Operations</p>
        </div>
        <div class="block" id="function" draggable="true" >
            <p>Function Creation</p>
        </div>
        <div class="block" id="for" draggable="true" >
            <p>For Loop</p>
        </div>
        <div class="block" id="while" draggable="true" >
            <p>While Loop</p>
        </div>
        <div class="block" id="if" draggable="true" >
            <p>If Statement</p>
        </div>
        <div class="block" id="write" draggable="true" >
            <p>File Write</p>
        </div>
        <div class="block" id="read" draggable="true" >
            <p>File Read</p>
        </div>
        <div class="block" id="echo" draggable="true" >
            <p>Output</p>
        </div>
    
        
    </div>
</div>

    


	<script >
        const blocks = document.querySelectorAll('.block');
const programmableArea = document.querySelector('#programmable-area');
const code = document.querySelector('#code-area');

const outputArea = document.querySelector('.output');

blocks.forEach(block => {
    block.addEventListener('dragstart', e => {
        e.dataTransfer.setData('text/plain', block.id);
    });
});

programmableArea.addEventListener('dragover', e => {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
});

programmableArea.addEventListener('drop', e => {
    e.preventDefault();
    const blockId = e.dataTransfer.getData('text/plain');
    console.log(blockId);
    const block = document.querySelector('#'+blockId);
    const blockClone = block.cloneNode(true);
    // programmableArea.innerHTML = ''; // remove existing child nodes
    console.log(blockClone);
    programmableArea.appendChild(blockClone);
    // programmableArea.appendChild
    //send a POST request to the PHP script to get the template code for the dropped block
    
var codeBlock;

    switch(blockId) {
    case "for":
        
    var initial = prompt("Enter initial value:");
var condition = prompt("Enter condition:");
var increment = prompt("Enter increment value:");
        var codeBlock = "for(\$i=" + initial+",\$i"   +  condition + "; \$i+=" + increment + ") {\n\n}"+ ";";
        break;

        case "if":
    var condition = prompt("Enter condition:");
    var codeBlock = "if (\$i =" + condition + ") {\n\n}"+";";
    break;

  case "while":
    var condition = prompt("Enter condition:");
    var codeBlock = "while (\$i " + condition + ") {\n\n}"+ ";";
    break;

  case "function":
    var functionName = prompt("Enter function name:");
    var codeBlock = "function " + functionName + "() {\n\n}"+ ";";
    break;

    case "variable":
    var varName = prompt("Enter variable name:");
    var varValue = prompt("Enter variable value:");
    var codeBlock = "\$" + varName + "=" + varValue + ";";
    break;

  case "echo":
    var outputValue = prompt("Enter output value:");
    var codeBlock = "echo  " + outputValue + ";";
    break;

  case "arithmetic":
    var condition=prompt("Enter operation:");
    var initial_1 = prompt("Enter first value:");
    var initial_2 = prompt("Enter second value:");
    switch(condition){
        case "+":
            var codeBlock = "$SUM="+"(\$i="+initial_1 + ")+(" + "\$j=" +initial_2+ ");";
        break;
        case "-":
        var codeBlock = "$DIFF="+"(\$i="+initial_1 + ")-(" + "\$j=" +initial_2+ ");";
         break;
        case "*":
        var codeBlock = "$MUL="+"(\$i="+initial_1 + ")*(" + "\$j=" +initial_2+ ");";
        break;
        case "/":
        var codeBlock = "$DIV="+"(\$i="+initial_1 + ")/(" + "\$j=" +initial_2+ ");";
        break;

    }
    break;
  

  case "read":
      
    var readValue = prompt("Enter file name to read:");

    var codeBlock ="\$myfile= fopen('" + readValue +'", "r");\n\necho fread($myfile,filesize("myfile.txt"));\n\nfclose($myfile);';


    break;

  case "write":
    var writeValue = prompt("Enter file name to write:");
    var codeBlock = "console.log(" + writeValue + ");";
    var codeBlock ="\$myfile = fopen('" + writeValue + '",w");\n\n $txt = "Hello World";\n\nfwrite($myfile, $txt);\n\nfclose($myfile);';

    break;

  default:
    var codeBlock = "";
    break;

 }


// programmableArea.innerHTML = ''; // remove existing child nodes
console.log("hii")

code.value += codeBlock;
console.log(typeof codeBlock);
code.value+="\n\n ";



});
const runBtn = document.getElementById('run-button');

runBtn.addEventListener("click", function() {
  event.preventDefault();
  const phpcode = document.getElementById("code-area").value;
    // Sending the PHP code to the server
    fetch('assignment2.php', {
        method: 'POST',
        body: JSON.stringify({ phpcode: phpcode }),
        headers: {
            'Content-Type': 'application/json'
        }
        
    })
    .then(response => response.text())
            .then(output => {
                // Displaying the output to the user
                console.log(output);
                document.getElementById('output').innerHTML = output;
            })
    .catch(error => alert(error));
});
console.log("hi");
	</script>
</body>
</html>