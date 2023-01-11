$(document).ready(function () {
    // listFiles();
    // var table = $('#filesListing').dataTable({
    //     "bPaginate": false,
    //     "bInfo": false,
    //     "bFilter": false,
    //     "bLengthChange": false,
    //     "pageLength": 5
    // });
    // list all files in datatable
    // function listFiles() {
    //     $.ajax({
    //         type: 'ajax',
    //         url: 'admin/getfiles',
    //         async: false,
    //         dataType: 'json',
    //         success: function (data) {
    //             var html = '';
    //             var i;
    //             for (i = 0; i < data.length; i++) {
    //                 html += '<tr id="' + data[i].file_id + '">' +
    //                     '<td>' + data[i].file_name + '</td>' +
    //                     '<td>' + data[i].date_uploaded + '</td>' +
    //                     '<td>' + data[i].first_name + '</td>' +
    //                     '<td style="text-align:right;">' +
    //                     '<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-file-id="' + data[i].file_id + '" data-file-name="' + data[i].file_name + '" data-date-uploaded="' + data[i].date_uploaded + '" data-first-name="' + data[i].first_name + '">Edit</a>' + ' ' +
    //                     '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-file_id="' + data[i].file_id + '">Delete</a>' +
    //                     '</td>' +
    //                     '</tr>';
    //             }
    //             $('#listFiles').html(html);
    //         }

    //     });
    // }


//     // save new employee record
//     $('#saveEmpForm').submit('click', function () {
//         var empName = $('#name').val();
//         var empAge = $('#age').val();
//         var empDesignation = $('#designation').val();
//         var empSkills = $('#skills').val();
//         var empAddress = $('#address').val();
//         $.ajax({
//             type: "POST",
//             url: "emp/save",
//             dataType: "JSON",
//             data: { name: empName, age: empAge, designation: empDesignation, skills: empSkills, address: empAddress },
//             success: function (data) {
//                 $('#name').val("");
//                 $('#skills').val("");
//                 $('#address').val("");
//                 $('#addEmpModal').modal('hide');
//                 listEmployee();
//             }
//         });
//         return false;
//     });
    // show edit modal form with emp data
    $('#listFiles').on('click', '.editFile', function () {
        $('#editFileModal').modal('show');
        $("#file_id").val($(this).data('file_id'));
        $("#file_name").val($(this).data('file_name'));
        $("#date_uploaded").val($(this).data('date_uploaded'));
    });
//     // save edit record
//     $('#editEmpForm').on('submit', function () {
//         var empId = $('#empId').val();
//         var empName = $('#empName').val();
//         var empAge = $('#empAge').val();
//         var empDesignation = $('#empDesignation').val();
//         var empSkills = $('#empSkills').val();
//         var empAddress = $('#empAddress').val();
//         $.ajax({
//             type: "POST",
//             url: "emp/update",
//             dataType: "JSON",
//             data: { id: empId, name: empName, age: empAge, designation: empDesignation, skills: empSkills, address: empAddress },
//             success: function (data) {
//                 $("#empId").val("");
//                 $("#empName").val("");
//                 $('#empAge').val("");
//                 $("#empSkills").val("");
//                 $('#empDesignation').val("");
//                 $("#empAddress").val("");
//                 $('#editEmpModal').modal('hide');
//                 listEmployee();
//             }
//         });
//         return false;
//     });
//     // show delete form
//     $('#listRecords').on('click', '.deleteRecord', function () {
//         var empId = $(this).data('id');
//         $('#deleteEmpModal').modal('show');
//         $('#deleteEmpId').val(empId);
//     });
//     // delete emp record
//     $('#deleteEmpForm').on('submit', function () {
//         var empId = $('#deleteEmpId').val();
//         $.ajax({
//             type: "POST",
//             url: "emp/delete",
//             dataType: "JSON",
//             data: { id: empId },
//             success: function (data) {
//                 $("#" + empId).remove();
//                 $('#deleteEmpId').val("");
//                 $('#deleteEmpModal').modal('hide');
//                 listEmployee();
//             }
//         });
//         return false;
//     });
});