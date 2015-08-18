/*
 * author : Chanaka 
 * Handles the dataTable events 
 * modified: Lahiru - Changed addNewContainer control-group class to form-group cass since container has form-group
 *           Lahiru - addField and updateField functions were modified not to update if validation fails
 */

/*
 * selected_row_nodes stores the nodes of currently selected row
 */
var selected_row_nodes;


function getData(){
    
    var headers = getHeaders();
    
    /*
     * find number of rows in the table and get table data into a, 2D array 
     * fnGetNodes gives an 1D array of tr elements / use to get number of rows in the table
     * dnGetData gives an 1D array of table data relevent to given index
     */
    
    var nodeArray = x.fnGetNodes();
    var rowCount = nodeArray.length;
    var dataArray = new Array();
    for(var i=0;i<rowCount;i++){
        dataArray[i]= x.fnGetData()[i];
    }
    
    /*
     * create json string from table data step by step
     * 
     * (1) append table data of dataTable to json string
     */
    var jString = "{\""+document.getElementById("itemtag").value+"\":[";
    for(var r=0;r<rowCount;r++){
        jString += "{";
        for(var c=0;c<headers.length;c++){
            if(c===headers.length-1)
                jString +="\""+headers[c]+"\":\""+dataArray[r][c]+"\"";
            else  
                jString +="\""+headers[c]+"\":\""+dataArray[r][c]+"\",";
        }
        if(r===rowCount-1)
            jString+="}";
        else
            jString+="},";
    }
    jString+="],";
    
    /*
     * (2) create comment field 
     */
    
    var comment="\"Comment\": \"\",";
    
    /*
     * (3) create author field
     */

    var author = "\"Author\": [\""+document.getElementById("author").value+"\",\""+document.getElementById("authorid").value+"\"],";
    
    /*
     * (4) get current editing time and create the  for json string
     */
    
    var d = new Date(),
    tme = (d.getHours()<10?'0':'') + d.getHours()+ " : " +(d.getMinutes()<10?'0':'') + d.getMinutes();
    var dat = d.getFullYear()+"/"+(d.getMonth()+1)+"/"+d.getDate();   
    var time = "\"Time\": [\""+dat+"\",\""+tme+"\"]";    
    jString +=comment+author+time+"}";
    document.getElementById("hiddentxt").value=jString;


}

/*
 * viewEditor 
 *  - creates the modal body for update a record
 *  - active when clicks the update button
 */
function viewEditor(){
    
    var headers = getHeaders();    
    /*
     * if there is any record selected
     * update the selected_row_nodes variable
     * get selected row td values into a array ( td->innerHTML values)
     * get the modal body container
     * 
     */
    if(x.fnGetData('.selected') !== null){
        
       selected_row_nodes=x.fnGetNodes('.selected');
       var selected_row_data = x.fnGetData('.selected');
       var container = document.getElementById("container");
       
       /*
        * clear all the child nodes in modal body
        */
       while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
       }
       //container.innerHTML+='<input type="hidden" id="vData" modalid="" errflag="" pendingReq="0"/>';
       /*
        * append child nodes to modal-body
        * set each of node values according to selected rows
        */
       for(var i=0;i<headers.length;i++){
             var div1 = document.createElement("div");
             div1.className="form-group";
             
             
             
             var label = document.createElement("label");
             label.style.font="bold";
             label.innerHTML=headers[i];
             label.style.font= "bold 16px arial,serif";
             label.className="control-label";
             label.for="data"+i;


             div1.appendChild(label);


             var input = document.createElement("input");
             input.type="text";
             input.className="input-xlarge focused";
             input.id="data"+i;
             input.value=selected_row_data[i];

             div1.appendChild(input);
             
             container.appendChild(div1);
             
       }
    /*
     * set hyperlink of Edit button to editor modal
     */
    var a = document.getElementById('btnEdit');
    a.href = "#editorModal";  
    
   }
    else{
        /*
         * set hyperlink of Edit button to info modal
         */
        var a = document.getElementById('btnEdit');
        a.href = "#infoModal"; 
    }
    
      
}

/*
 * update the field that was edited
 * active when click update button in update record modal
 */
function updateField(){
    if(!validateModal('#container','editorModal')){
        return;
    }
    var tdElement = selected_row_nodes.getElementsByTagName('td');

    for(var i=0;i<tdElement.length;i++){
        var inputid="data"+i;
        tdElement[i].innerHTML=document.getElementById(inputid).value;
        x.fnGetData('.selected')[i]=document.getElementById(inputid).value;
    }
}

/*
 * addNew
 *  - create add new modal body for a new record
 *  - active when clicks the add new button
 * 
 */
function addNew(){
      var headers = getHeaders();
      var container = document.getElementById("addNewContainer");
       
       /*
        * clear all the child nodes in modal body
        */
       while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
       }
       //container.innerHTML+='<input type="hidden" id="vData" modalid="" errflag="" pendingReq="0"/>';
       for(var i=0;i<headers.length;i++){
            var divmain = document.createElement("div");
            divmain.className="form-group";                     //lahiru prev divmain.className="control-group";

            var label =document.createElement("label");
            label.className="control-label";
            label.innerHTML=headers[i];


            var divin = document.createElement("div");
            divin.className="controls";

            var input=document.createElement("input");
            input.type="text";
            input.id="val"+i;
            input.className="input-xlarge focused";

            //divin.appendChild(input);         lahiru
            divmain.appendChild(label);
            divmain.appendChild(input);
            container.appendChild(divmain);
        
        }
        /*
         * set hyperlink of add new button to add new modal
         */
        var a = document.getElementById('btnAddRow');
        a.href = "#addNewModal"; 
    
}

function addField(){
    /*
     * Add a new row to the table after click add new in modal
     */
    if(!validateModal('#addNewContainer','addNewModal')){
        return;
    }
    var valueArray= new Array();
    var headers=getHeaders();
    for(var i=0;i<headers.length;i++){
        valueArray[i]=document.getElementById("val"+i).value;
    } 
    x.fnAddData(valueArray,true);
}

function getHeaders(){
    /*
    * get table header values into an array and return the array
    */    
    var cols = $("#datatable thead tr th").map(function () {
        return $(this).text();
    });
    var headers = cols.splice(0, cols.length); 
    return headers;
}

