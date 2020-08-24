function showAllCustomers() {
    $.ajax({
        url: '/customers/create',
        type: 'GET',
        data: {},
        dataType: 'JSON',
        success: function (response) {
            // console.log(response);
            var html = '';
            var counter = 1;
            var i;
            for (i = 0; i < response.length; i++) {
                html += '<tr>' +
                    '<td>' + counter++ + '</td>' +
                    '<td>' + response[i].fname + '</td>' +
                    '<td>' + response[i].lname + '</td>' +
                    '<td>' + response[i].email + '</td>' +
                    '<td>' + '<button class="btn btn-info btn-sm mr-2 edit-btn" id="editCustomer" data-toggle="modal" data-target="#editmodal" data-id="' + response[i].id + '" data-fname="' + response[i].fname + '" data-lname="' + response[i].lname + '" data-email="' + response[i].email + '">Edit</button>' +
                    '<button class="btn btn-danger btn-sm ml-2" id="deltCustomer" data-toggle="modal" data-target="#deltmodal" data-id="' + response[i].id + '">Delete</button>' + '</td>' +
                    '</tr>';
            }
            $('#allCustomers').html(html);
        }
    });
}
showAllCustomers();
$('#addbtn').on('click', function (e) {
    e.preventDefault();
    var error = validationForm();
    if (!error) {
        var customerData = {};
        customerData._token = $('input[type=hidden]').val();
        customerData.fname = $('#fname').val();
        customerData.lname = $('#lname').val();
        customerData.email = $('#email').val();
        console.log(customerData);
        $.ajax({
            url: '/customers',
            type: 'POST',
            data: customerData,
            dataType: 'JSON',
            success: function (response) {
                showAllCustomers();
                resetForm();
                $('#addmodal').modal('hide');
                // alert("New Customer Added Successfuly!");
            }

        })
    }
});

$('#allCustomers').on('click', '#deltCustomer', function () {
    var getId = $(this).data('id');
    $('#id').val(getId);
});

$('#yesdelt').on('click', function () {
    var _token = $('input[type=hidden]').val();
    var id = $('#id').val();
    $.ajax({
        url: 'customers/' + id,
        type: 'POST',
        data: { 'id': id, '_token': _token },
        dataType: 'JSON',
        success: function (response) {
            // alert("Customer Deleted Successfully!");
            showAllCustomers();
        }
    })
})

$('#allCustomers').on('click', '#editCustomer', function () {
    _token = $('#editmodal').find('input[type=hidden]').val();
    var id = $(this).data('id');
    $.ajax({
        url: 'customers/' + id + '/edit',
        type: 'POST',
        data: { '_token': _token, 'id': id },
        dataType: 'JSON',
        success: function (response) {
            $('#id').val(id);
            $('#editmodal').find('#fname').val(response.fname);
            $('#editmodal').find('#lname').val(response.lname);
            $('#editmodal').find('#email').val(response.email);
        }
    });
});

$('#updatebtn').on('click', function (e) {
    e.preventDefault();
    var customerUpdate = {};
    customerUpdate._token = $('input[type=hidden]').val();
    customerUpdate.id = $('#editmodal').find('#id').val();
    customerUpdate.fname = $('#editmodal').find('#fname').val();
    customerUpdate.lname = $('#editmodal').find('#lname').val();
    customerUpdate.email = $('#editmodal').find('#email').val();
    console.log(customerUpdate);
    $.ajax({
        url: '/customers/' + customerUpdate.id + '/update',
        type: 'POST',
        data: customerUpdate,
        dataType: 'JSON',
        success: function (response) {
            // alert("Customer Update Successfully!");
            showAllCustomers();
            resetForm();
            $('#editmodal').modal('hide');
        }

    })
})

function resetForm() {
    $('#fname').val('');
    $('#lname').val('');
    $('#email').val('');
}

var validationForm = function () {

    var errorFlag = false;
    var fname = $('#fname');
    var fnameHelp = $('#fnameHelp');
    var lname = $('#lname');
    var lnameHelp = $('#lnameHelp');
    var email = $('#email');
    var emailHelp = $('#emailHelp');

    // Remove Error Class First
    $('.inputerror').removeClass('inputerror');
    $('.msgerror').removeClass('msgerror');

    if (!fname.val()) {
        fname.addClass('inputerror');
        fnameHelp.addClass('msgerror');
        errorFlag = true;
    }

    if (!lname.val()) {
        lname.addClass('inputerror');
        lnameHelp.addClass('msgerror');
        errorFlag = true;
    }

    if (!email.val()) {
        email.addClass('inputerror');
        emailHelp.addClass('msgerror');
        errorFlag = true;
    }

    return errorFlag;

}
