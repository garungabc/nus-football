@extends('layouts.master')

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">User - Create new</h5>
        <form class="needs-validation" novalidate action="{{ route('user.store') }}">
            @method('post')
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="name-inp">Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="name-inp" name="name" placeholder="Dau DQ" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone-inp">Phone</label>
                    <input type="text" class="form-control" id="phone-inp" name="phone" placeholder="0123456789">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email-inp">Email</label>
                    <input type="email" class="form-control" id="email-inp" name="email" placeholder="abc@domain.com">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="validationCustom03">Index</label>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="default 1.5" value="1.5" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="select-status-inp">Status</label>
                    <select class="form-control form-control" id="select-status-inp">
                        <option value="1" selected>Active</option>
                        <option value="0">In Active</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </div>
</div>
@endsection
