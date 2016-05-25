
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "ajaxcall",
        "pagingType": "full_numbers",
        "columns": [
            {"data": "Id"},
            {"data": "ConName"},
            {"data": "Name"},
            {"data": "Code"},
            {"data": "Alias"},
            {"data": "DialCode"},
            {"data": "CreatedAt"},
            {"data": "IsActive"},
            {
                "bSortable": false, "aTargets": [0],
                "targets": -1,
                "data": null,
                "render": function (data, type, full, meta) {
                    return "<a href='edit/" + data.Id + "'><button class='one'><i class='fa fa-fw fa-edit'></i></button></a>" + " " + "<button class='del' value='" + data.Id + "'><i class='fa fa-fw fa-trash'></i></button>"+" "+"<button class='view' value='"+JSON.stringify(data)+"'><i class='fa fa-fw fa-clipboard'></li></button>"
               
                }
            }
    ],
    });



$('#example1 tbody').on('click','.view', function(){
  var data=  $(this).val();
// alert(data);
    var row=JSON.parse(data);
 
var text = "<p> Id: "+row.Id+"</p><p> Continent: "+row.ConName+"</p><p>Country: "+row.Name+"</p><p> Code: "+row.Code+"</p>";
text+="<p> Alias: "+row.Alias+"</p><p> DialCode: "+row.DialCode+"</p><p>CreatedAt: "+row.CreatedAt+"</p>";
if(row.IsActive==1){
    text+="<p>Is Active: Active</p>";
}else{
    text+="<p>Is Active: InActive</p>";
}
    $("#popup").modal();
    $("#para").html(text);
});


    $('#example1 tbody').on('click', '.del', function () {
        //var data = table.row( $(this).parents('tr') ).data();
        var word = $(this).val();
        $.ajax({
            url: 'deleteRow',
            type: 'post',
            data: {word: word},
            success: function (data) {
                alert(data + " Row Deleted successfully");
            }
        });

    });

//------------------------------------------------------------------------
//------------------------------------------------------------------------



    var Table = $('#continenttable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "continentcall",
        "pagingType": "full_numbers",
        "columns": [
            {"data": "Id"},
            {"data": "ConName"},
            {"data": "Code"},
            {"data": "IsActive"},
            {
                "bSortable": false, "aTargets": [0],
                "targets": -1,
                "data": null,
                "render": function (data, type, full, meta) {
                    return "<a href='editcontinent/" + data.Id + "'><button class='one'><i class='fa fa-fw fa-edit'></i></button></a>"+ " " + "<button class='delete' value='" + data.Id + "'><i class='fa fa-fw fa-trash'></i></button>" +" "+"<button class='continentview' value='"+JSON.stringify(data)+"'><i class='fa fa-fw fa-clipboard'></li></button>"
               
                }
            }
    ],
    });



$('#continenttable tbody').on('click','.continentview', function(){
  var data=  $(this).val();
// alert(data);
    var row=JSON.parse(data);
 
var text = "<p> Id: "+row.Id+"</p><p> Continent: "+row.ConName+"</p><p> Code: "+row.Code+"</p>";
if(row.IsActive==1){
    text+="<p> IsActive: Active</p>";
}
else{
    
    text+="<p> IsActive: InActive</p>";
}
    $("#pop").modal();
    $("#paratwo").html(text);
});


    $('#continenttable tbody').on('click', '.delete', function () {
        //var data = table.row( $(this).parents('tr') ).data();
        var word = $(this).val();
        $.ajax({
            url: 'deletecontinent',
            type: 'post',
            data: {word: word},
            success: function (data) {
                alert(data + " Row Deleted successfully");
            }
        });

    });




});
