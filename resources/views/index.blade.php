<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cascaded Category</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>


    <header class="text-center p-4 bg-dark text-white" style="font-size: 40px;">Dependent Select Box In Laravel</header>
    <div class="container mt-4">
        <div class="row">

            <div class="col-md-4">
                <h3>Category </h3>
                <select class="form-control" placeholder="Select Category"
                    id="sub_category_name">
                    <option value="0" disabled selected>Select
                        Main Category*</option>
                    @foreach($data as $categories)
                    <option  value="{{ $categories->id }}">
                        {{ ucfirst($categories->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <h3>Sub Category*</h3>
                <select class="form-control" placeholder="Select Sub Category" id="sub_category"></select>
            </div>


            <div class="col-md-4">
                <h3>Caleroies*</h3>
                <select class="form-control formselect" placeholder="Select caleroies" id="calories"></select>
            </div>

        </div>
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        
             <script>
                $(document).ready(function () {
                $('#sub_category_name').on('change', function () {
                let id = $(this).val();
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: 'GET',
                url: 'GetSubCatAgainstMainCatEdit/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);   
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
                response.forEach(element => {
                    $('#sub_category').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                }
            });
        });


        $('#sub_category').on('change', function () {
        $('#calories').empty();
        $('#calories').append(`<option value="0" selected disabled>Processing...</option>`);
        var id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/GetCaloriesAgainstSubCategory/' + id,
            // data: {
            //     _token: '{!! csrf_token() !!}',
            //     id: id
            // },
            success: function(response) {
                var response = JSON.parse(response);
                custs_for_complains = response;
                $('#calories').empty();
                $('#calories').append(`<option value="0" selected disabled>Select Calories</option>`);
                response.forEach(element => {
                    $('#calories').append(`<option value="${element['id']}">${element['name']}</option>`);
                });
            }
        });
    });
    });
    </script>









<script>

    
    //Complains
    $(document).on('change', '.select_team_complaint', function(){
        $('.select_zone_complaint').empty();
        $('.select_zone_complaint').append(`<option value="0" selected disabled>Processing...</option>`);
        //Empty Customers
        $('.select_cust_complaint').empty();
        $('.select_cust_complaint').append(`<option value="0" selected disabled>Select Customer</option>`);
        var team_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/GetZonesAgainstTeam',
            data: {
                _token: '{!! csrf_token() !!}',
                team_id: team_id
            },
            success: function(response) {
                var response = JSON.parse(response);
                $('.select_zone_complaint').empty();
                $('.select_zone_complaint').append(`<option value="0" selected disabled>Select Zone</option>`);
                response.forEach(element => {
                    $('.select_zone_complaint').append(`<option value="${element['id']}">${element['zone_name']}</option>`);
                });
            }
        });
    });


    var custs_for_complains = [];
    $(document).on('change', '.select_zone_complaint', function(){
        $('.select_cust_complaint').empty();
        $('.select_cust_complaint').append(`<option value="0" selected disabled>Processing...</option>`);
        var team_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/GetCustomersAgainstZones',
            data: {
                _token: '{!! csrf_token() !!}',
                team_id: team_id
            },
            success: function(response) {
                var response = JSON.parse(response);
                custs_for_complains = response;
                $('.select_cust_complaint').empty();
                $('.select_cust_complaint').append(`<option value="0" selected disabled>Select Customer</option>`);
                response.forEach(element => {
                    $('.select_cust_complaint').append(`<option brb="${element['blue_bottles_remaining']}" wrb="${element['white_bottles_remaining']}" rate="${element['rates']}" wb="${element['white_bottle']}" bb="${element['blue_bottle']}" bal="${element['balance']}" opp_bal="${element['opening_bal']}" name="${element['custom_id']}" value="${element['id']}">${(element['company_name'] ? element['company_name'] : (element['organization_name'] ? element['organization_name'] : element['merchant_name']))} (${element['custom_id']})</option>`);
                });
            }
        });
    });
</script>
</body>

</html>
