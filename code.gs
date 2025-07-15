function doGet(e) {
 var htmlOutput = HtmlService.createTemplateFromFile('index');
  htmlOutput.result = 'الرئيسية';
 return htmlOutput.evaluate();
}

function doPost(e) {
  Logger.log(JSON.stringify(e));
  if (e.parameter.Submit == 'عرض') {
    var cls = e.parameter.cl;
    var roll = e.parameter.rl;
    var ss = SpreadsheetApp.openById('1ejl7BMZmsEIyWhwcYGC0ffWxbUMbJ2dox6AB51wEFxU');
    var ws = ss.getSheetByName(cls)
    var lr = ws.getLastRow();
    for (var i = 1; i <= lr; i++) {
      var val = ws.getRange(i, 1).getValue();
      if (val == roll) {
        var v1 = ws.getRange(i, 2).getValue();
        var v2 = ws.getRange(i, 3).getValue();
        var v3 = ws.getRange(i, 4).getValue();
        var v4 = ws.getRange(i, 5).getValue();
        var v5 = ws.getRange(i, 6).getValue();
        var v6 = ws.getRange(i, 7).getValue();
        var v7 = ws.getRange(i, 8).getValue();
        var v8 = ws.getRange(i, 9).getValue();
        var v9 = ws.getRange(i, 10).getValue();
        var v10 = ws.getRange(i, 11).getValue();
        var v11 = ws.getRange(i, 12).getValue();
        var v12 = ws.getRange(i, 13).getValue();
        var v13 = ws.getRange(i, 14).getValue();
        var v14 = ws.getRange(i, 15).getValue();
        var v15 = ws.getRange(i, 16).getValue();
        var v16 = ws.getRange(i, 17).getValue();
        var v17 = ws.getRange(i, 18).getValue();
         var v18 = ws.getRange(i, 19).getValue();
         var v19 = ws.getRange(i, 20).getValue();
         var v20 = ws.getRange(i, 21).getValue();
         var v21 = ws.getRange(i, 22).getValue();
         var v22 = ws.getRange(i, 23).getValue();
         var v23 = ws.getRange(i, 24).getValue();
         var v24 = ws.getRange(i, 25).getValue();
         var v25 = ws.getRange(i, 26).getValue();
         var cor1 = ws.getRange(1, 1).getValue();
          var cor2 = ws.getRange(1, 2).getValue();
          var cor3 = ws.getRange(1, 3).getValue();
          var cor4 = ws.getRange(1, 4).getValue();
          var cor5 = ws.getRange(1, 5).getValue();
          var cor6 = ws.getRange(1, 6).getValue();
          var cor7 = ws.getRange(1, 7).getValue();
          var cor8 = ws.getRange(1, 8).getValue();
          var cor9 = ws.getRange(1, 9).getValue();
          var cor10 = ws.getRange(1, 10).getValue();
          var cor11 = ws.getRange(1, 11).getValue();
          var cor12 = ws.getRange(1, 12).getValue();
          var cor13 = ws.getRange(1, 13).getValue();
          var cor14 = ws.getRange(1, 14).getValue();
          var cor15 = ws.getRange(1, 15).getValue();
          var cor16 = ws.getRange(1, 16).getValue();
          var cor17 = ws.getRange(1, 17).getValue();
          var cor18 = ws.getRange(1, 18).getValue();
          var cor19 = ws.getRange(1, 19).getValue();
          var cor20 = ws.getRange(1, 20).getValue();
          var cor21 = ws.getRange(1, 21).getValue();
          var cor22 = ws.getRange(1, 22).getValue();
           var cor23 = ws.getRange(1, 23).getValue();
          var cor24 = ws.getRange(1, 24).getValue();
          var cor25 = ws.getRange(1, 25).getValue();
         
         
  
      }
    }
    var htmlOutput = HtmlService.createTemplateFromFile('result');
    htmlOutput.cl = cls;
    htmlOutput.id = roll;
    htmlOutput.stn = v1;
    htmlOutput.c = v2;
    htmlOutput.d = v3;
    htmlOutput.e = v4;
    htmlOutput.f = v5;
    htmlOutput.g = v6;
    htmlOutput.h= v7;
    htmlOutput.i= v8;
    htmlOutput.j = v9;
    htmlOutput.k = v10;
    htmlOutput.l= v11;
    htmlOutput.m = v12;
    htmlOutput.n = v13;
    htmlOutput.o = v14;
    htmlOutput.p = v15;
    htmlOutput.q = v16;
    htmlOutput.r = v17;
    htmlOutput.s = v18;
    htmlOutput.t = v19;
    htmlOutput.u = v20;
    htmlOutput.v = v21;
    htmlOutput.w = v22;
    htmlOutput.x = v23;
    htmlOutput.y = v24;
    htmlOutput.z = v25;
    htmlOutput.column1 = cor1;
    htmlOutput.column2 = cor2;
    htmlOutput.column3 = cor3;
    htmlOutput.column4 = cor4;
    htmlOutput.column5 = cor5;
    htmlOutput.column6 = cor6;
    htmlOutput.column7 = cor7;
    htmlOutput.column8 = cor8;
    htmlOutput.column9 = cor9;
    htmlOutput.column10 = cor10;
    htmlOutput.column11 = cor11;
    htmlOutput.column12 = cor12;
    htmlOutput.column13 = cor13;
    htmlOutput.column14 = cor14;
    htmlOutput.column15 = cor15;
    htmlOutput.column16 = cor16;
    htmlOutput.column17 = cor17;
    htmlOutput.column18 = cor18;
    htmlOutput.column19 = cor19;
    htmlOutput.column20 = cor20;
    htmlOutput.column21 = cor21;
    htmlOutput.column22 = cor22;
    htmlOutput.column23 = cor23;
    htmlOutput.column24 = cor24;
    htmlOutput.column25 = cor25;
   
       return htmlOutput.evaluate();
  } else {
    var htmlOutput = HtmlService.createTemplateFromFile('index');
    htmlOutput.result = '';
    return htmlOutput.evaluate();
  }
};


function getUrl() {
  var url = ScriptApp.getService().getUrl();
  return url;
}
