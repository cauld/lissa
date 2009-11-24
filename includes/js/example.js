YAHOO.util.Event.on(window, "load", function() {
    var i,
        tmpLi,
        sampleList = YAHOO.util.Dom.get("sample-list"),
        JSONObject = YAHOO.lang.JSON.parse(JSONString),
        itemCount  = JSONObject.length;
        
    //Look over the JSON data and output a new li for each record
    for(i = 0; i < itemCount; i++) {
        tmpLi = document.createElement("li");
        
        //We'll highlight the last item red using a class from our custom css module
        if (i === itemCount - 1) {
            YAHOO.util.Dom.addClass(tmpLi, "last");
        }
        
        tmpLi.innerHTML = JSONObject[i].itemText;
        sampleList.appendChild(tmpLi);
    }
});