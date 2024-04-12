@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Dashboard') }}</span>
                        <button class="btn btn-primary ml-5" id="addButton">Add New Record</button>
                        <button class="btn btn-primary ml-5" id="viewButton">View Table</button>
                    </div>
                    <div class="card-body">
                        <form id="formID" class="d-none">
                            <div class="form-group mb-4">
                                <label for="fullname">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    placeholder="Enter full name">
                            </div>
                            <div class="form-group mb-4">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter address">
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group mb-4">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Enter phone number">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <table class="table d-none" id="tableView">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Gender</th>
                                </tr>
                            </thead>
                            <tbody id="malaiDataDenuHai">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addButton').click(function(e) {
                e.preventDefault();
                if ($('#formID').hasClass('d-none')) {
                    $('#formID').removeClass('d-none');
                    $('#addButton').html("Remove Form");
                    if ($('#addButton').hasClass('btn-primary')) {
                        $('#addButton').removeClass('btn-primary');
                        $('#addButton').addClass('btn-danger');
                    }
                } else {
                    $('#formID').addClass('d-none');
                    $('#addButton').html("Add New Record");
                    if ($('#addButton').hasClass('btn-danger')) {
                        $('#addButton').removeClass('btn-danger');
                        $('#addButton').addClass('btn-primary');
                    }
                }
            });

            $('#viewButton').click(function(e) {
                e.preventDefault();
                if ($('#tableView').hasClass('d-none')) {
                    $('#tableView').removeClass('d-none');
                    $('#viewButton').html("Remove Table");
                    if ($('#viewButton').hasClass('btn-primary')) {
                        $('#viewButton').removeClass('btn-primary');
                        $('#viewButton').addClass('btn-danger');
                    }
                    getDataFromBackend();
                } else {
                    $('#tableView').addClass('d-none');
                    $('#viewButton').html("View Table");
                    if ($('#viewButton').hasClass('btn-danger')) {
                        $('#viewButton').removeClass('btn-danger');
                        $('#viewButton').addClass('btn-primary');
                    }
                }
            });

            function getDataFromBackend() {
                var content = $('#malaiDataDenuHai');
                content.empty();
                $.get("{{ route('data.get.data') }}", function(data, status) {
                    var row = "";
                    data.data.forEach((d, index) => {
                        row = `<tr>
                            <td>${++index}</td>
                            <td>${d.name}</td>
                            <td>${d.phone}</td>
                            <td>${d.email}</td>
                            <td>${d.address}</td>
                            <td>${d.gender}</td>
                            </tr>`;
                        content.append(row);
                    });
                });

            }



            $('#formID').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                $.ajax({
                    type: "POST",
                    url: "{{ route('data.submit.data') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        console.log(response.message);
                        if (response.success) {
                            $('#formID').trigger('reset');
                            getDataFromBackend();
                        }
                    }
                });
            });


        });
    </script>
@endsection
