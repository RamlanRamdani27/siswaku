$(document).ready(function(){
//Alert Sliding
$('div.alert').not('.alert-important').delay(5000).slideUp(300);

    $("#form-pencarian").submit(function(){
        $("#id_kelas option[value='']").attr("disabled","disabled");
        $("#jenis_kelamin option[value='']").attr("disabled","disabled");

        //Pastikan proses sub,it ,asih di teruskan
        return true;
    });
});
